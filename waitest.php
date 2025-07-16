<?php
// --- Konfigurasi Gemini API ---
$gemini_api_key = 'AIzaSyDlFjG6KMo3LMA_a2xqgGe3I13lLAasoeE'; // <<< GANTI INI
$gemini_endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $gemini_api_key;

// --- Akhir Konfigurasi ---

$analysis_result = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prompt'])) {
    $user_prompt = trim($_POST['prompt']);
    $api_request_body = json_encode([
        'contents' => [
            [
                'parts' => [
                    ['text' => $user_prompt]
                ]
            ]
        ]
    ]);

    $ch = curl_init($gemini_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $api_request_body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

    $api_response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_message = "cURL Error: " . curl_error($ch);
        $analysis_result = "Gagal memanggil API karena error cURL.";
    } else {
        $response_data = json_decode($api_response, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($response_data['candidates'][0]['content']['parts'][0]['text'])) {
            $analysis_result = $response_data['candidates'][0]['content']['parts'][0]['text'];
        } else {
            $error_message = "Gagal mendapatkan hasil dari API.";
            if (isset($response_data['error'])) {
                $error_message .= " API Error: " . ($response_data['error']['message'] ?? 'Unknown API error');
            }
            $analysis_result = "Analisis tidak tersedia karena error API.";
        }
    }
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>AI Prompt Gemini</title>
    <style>
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6; 
            margin: 0; 
            padding: 20px; 
            background-color: #f4f4f4; 
        }
        .container { 
            width: 90%; 
            max-width: 700px; 
            margin: 40px auto; 
            padding: 30px; 
            background-color: #fff; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }
        .prompt-form textarea { 
            width: 100%; 
            min-height: 100px; 
            padding: 10px; 
            font-size: 1em; 
            border-radius: 5px; 
            border: 1px solid #ccc; 
            margin-bottom: 15px; 
        }
        .prompt-form button { 
            padding: 10px 25px; 
            background: #7367f0; 
            color: #fff; 
            border: none; 
            border-radius: 5px; 
            font-size: 1em; 
            cursor: pointer;
        }

        /* AI Floating Button */
        .ai-button-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .notion-ai-button {
            user-select: none;
            transition: all 0.2s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #2d2d2d;
            width: 48px;
            height: 48px;
            border-radius: 100%;
            font-size: 20px;
            box-shadow: 0 4px 12px -2px rgba(0,0,0,0.16), 0 0 0 1px rgba(255,255,255,0.1);
            border: none;
            outline: none;
            color: white;
        }
        .notion-ai-button:hover {
            background: #3d3d3d;
            transform: scale(1.05);
        }

        /* AI Popup Menu */
        .ai-popup {
            position: fixed;
            bottom: 90px;
            right: 30px;
            width: 280px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            z-index: 999;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.2s ease;
            pointer-events: none;
        }
        .ai-popup.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        .ai-popup-header {
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
            font-weight: 500;
            color: #333;
        }
        .ai-popup-item {
            padding: 12px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background 0.1s;
        }
        .ai-popup-item:hover {
            background: #f7f7f7;
        }
        .ai-popup-item svg {
            margin-right: 12px;
            color: #666;
        }
        .ai-popup-footer {
            padding: 12px 16px;
            border-top: 1px solid #eee;
            font-size: 0.8em;
            color: #999;
        }
        .ai-popup-input {
            padding: 16px;
            border-bottom: 1px solid #eee;
        }
        .ai-popup-input input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
        }
        .ai-popup-input input:focus {
            border-color: #7367f0;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>AI Prompt Gemini</h2>
    <form class="prompt-form" method="post">
        <label for="prompt">Masukkan prompt untuk AI:</label>
        <textarea name="prompt" id="prompt" required placeholder="Tulis pertanyaan atau instruksi untuk AI di sini..."><?php echo isset($_POST['prompt']) ? htmlspecialchars($_POST['prompt']) : ''; ?></textarea>
        <button type="submit">Kirim ke AI</button>
    </form>

    <?php if (!empty($error_message)): ?>
        <div class="error-message">
            <strong>Terjadi Kesalahan:</strong> <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($analysis_result)): ?>
        <div class="analysis-box">
            <h3>Jawaban AI:</h3>
            <?php echo nl2br(htmlspecialchars($analysis_result)); ?>
        </div>
    <?php endif; ?>
</div>

<!-- AI Floating Button -->
<div class="ai-button-container">
    <button class="notion-ai-button" id="aiFloatingButton">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" fill="currentColor"/>
        </svg>
    </button>
</div>

<!-- AI Popup Menu -->
<div class="ai-popup" id="aiPopup">
    <div class="ai-popup-header">How can I help you today?</div>
    <div class="ai-popup-input">
        <input type="text" placeholder="Ask AI anything..." id="aiPromptInput">
    </div>
    <div class="ai-popup-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" fill="#666"/>
        </svg>
        Get answers from connected apps
    </div>
    <div class="ai-popup-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94.63 1.5 1.98 2.63 3.61 2.96V19H7v2h10v-2h-4v-3.1c1.63-.33 2.98-1.46 3.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z" fill="#666"/>
        </svg>
        Summarize this page
    </div>
    <div class="ai-popup-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" fill="#666"/>
        </svg>
        Find action items
    </div>
    <div class="ai-popup-item">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 7.55 12.95 5.75 14 3.69 14H1v2h2.5c1.76 0 3.22-1.3 4.6-2.8.58-.67 1.11-1.4 1.57-2.15.37.56.79 1.1 1.27 1.6l-4.96 4.96 1.42 1.42 4.95-4.95 1.42 1.42-4.95 4.95 1.42 1.42 5.66-5.66-1.41-1.42z" fill="#666"/>
        </svg>
        Translate this page
    </div>
    <div class="ai-popup-footer">All sources</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const aiButton = document.getElementById('aiFloatingButton');
    const aiPopup = document.getElementById('aiPopup');
    const promptInput = document.getElementById('aiPromptInput');
    const mainPrompt = document.getElementById('prompt');

    // Toggle popup
    aiButton.addEventListener('click', function(e) {
        e.stopPropagation();
        aiPopup.classList.toggle('show');
    });

    // Close popup when clicking outside
    document.addEventListener('click', function() {
        aiPopup.classList.remove('show');
    });

    // Prevent popup from closing when clicking inside it
    aiPopup.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    // Focus input when popup opens
    aiButton.addEventListener('click', function() {
        setTimeout(() => {
            promptInput.focus();
        }, 100);
    });

    // Submit AI prompt
    promptInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            mainPrompt.value = this.value;
            aiPopup.classList.remove('show');
            setTimeout(() => {
                mainPrompt.focus();
            }, 100);
        }
    });

    // Menu item clicks
    document.querySelectorAll('.ai-popup-item').forEach(item => {
        item.addEventListener('click', function() {
            const action = this.textContent.trim();
            mainPrompt.value = action;
            aiPopup.classList.remove('show');
            setTimeout(() => {
                mainPrompt.focus();
            }, 100);
        });
    });
});
</script>
</body>
</html>

<!-- curl "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" \
  -H 'Content-Type: application/json' \
  -X POST \
  -d '{
    "contents": [
      {
        "parts": [
          {
            "text": "Explain what is bakso"
          }
        ]
      }
    ]
  }' -->