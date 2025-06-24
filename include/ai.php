<?php
// --- Konfigurasi Gemini API ---
// Masukkan API Key Gemini di sini (hardcoded)
$gemini_api_key = ''; // <--- Ganti dengan API key kamu
$gemini_endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $gemini_api_key;
// --- Akhir Konfigurasi ---

session_start();

if (!isset($_SESSION['ai_chat'])) {
    $_SESSION['ai_chat'] = [];
}

$analysis_result = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prompt'])) {
    $user_prompt = trim($_POST['prompt']);
    // Simpan prompt user ke session
    $_SESSION['ai_chat'][] = ['role' => 'user', 'text' => $user_prompt];

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
        $_SESSION['ai_chat'][] = ['role' => 'ai', 'text' => $analysis_result];
    } else {
        $response_data = json_decode($api_response, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($response_data['candidates'][0]['content']['parts'][0]['text'])) {
            $analysis_result = $response_data['candidates'][0]['content']['parts'][0]['text'];
            $_SESSION['ai_chat'][] = ['role' => 'ai', 'text' => $analysis_result];
        } else {
            $error_message = "Gagal mendapatkan hasil dari API.";
            if (isset($response_data['error'])) {
                $error_message .= " API Error: " . ($response_data['error']['message'] ?? 'Unknown API error');
            }
            $analysis_result = "Analisis tidak tersedia karena error API.";
            $_SESSION['ai_chat'][] = ['role' => 'ai', 'text' => $analysis_result];
        }
    }
    curl_close($ch);

    $_SESSION['ai_popup_open'] = true; // <-- Tambahkan ini
    // Agar window tidak menutup, gunakan redirect ke diri sendiri dengan anchor agar tetap terbuka
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!-- AI Button -->
<div class="ai-button" id="aiButton">
    <img src="../assets/img/logo1.png" alt="AI Logo" />
</div>

<!-- AI Chat Popup -->
<div class="ai-popup" id="aiPopup">
    <div class="ai-header">
        <h5>AI Assistant</h5>
    </div>
    <div class="ai-body" id="aiChatBody">
        <div id="aiChatMessages" style="display: flex; flex-direction: column; gap: 10px;">
            <?php
            if (!empty($_SESSION['ai_chat'])):
                foreach ($_SESSION['ai_chat'] as $msg):
                    if ($msg['role'] === 'user'): ?>
                        <div class="ai-message user"><?php echo nl2br(htmlspecialchars($msg['text'])); ?></div>
                    <?php else: ?>
                        <div class="ai-message ai"><?php echo nl2br(htmlspecialchars($msg['text'])); ?></div>
                    <?php endif;
                endforeach;
            else: ?>
                <div class="ai-message ai">Hi! How can I assist you today?</div>
            <?php endif; ?>
        </div>
    </div>
    <form class="ai-footer" id="aiForm" method="post" action="">
        <input type="text" name="prompt" id="aiPromptInput" placeholder="Type your message..." autocomplete="off" required />
        <button type="submit" class="send-btn">Send</button>
    </form>
</div>

<!-- CSS -->
<style>
.ai-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background-color: #001F3F;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    z-index: 1000;
    transition: transform 0.3s ease;
}
.ai-button:hover {
    transform: scale(1.1);
}
.ai-button img {
    width: 40px;
    height: 40px;
}
.ai-popup {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 320px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.3s ease, transform 0.3s ease;
    z-index: 1001;
    pointer-events: none;
}
.ai-popup.show {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}
.ai-header {
    background-color: #001F3F;
    color: #fff;
    padding: 10px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.ai-header h5 {
    margin: 0;
    font-size: 16px;
}
.ai-body {
    padding: 10px;
    font-size: 14px;
    color: #333;
    min-height: 60px;
    max-height: 250px;
    overflow-y: auto;
    background: #fafbfc;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.ai-message.user {
    align-self: flex-end;
    background: #e6f0fa;
    color: #001F3F;
    padding: 8px 12px;
    border-radius: 12px 12px 0 12px;
    max-width: 85%;
    word-break: break-word;
}
.ai-message.ai {
    align-self: flex-start;
    background: #f4f4f4;
    color: #333;
    padding: 8px 12px;
    border-radius: 12px 12px 12px 0;
    max-width: 85%;
    word-break: break-word;
}
.ai-footer {
    padding: 10px;
    display: flex;
    gap: 10px;
    border-top: 1px solid #eee;
}
.ai-footer input {
    flex: 1;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.ai-footer .send-btn {
    background-color: #001F3F;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}
</style>

<!-- JavaScript -->
<script>
    const aiButton = document.getElementById('aiButton');
    const aiPopup = document.getElementById('aiPopup');
    const aiPromptInput = document.getElementById('aiPromptInput');
    const aiChatBody = document.getElementById('aiChatBody');

    // Buka popup jika session PHP menyuruh buka
    <?php if (!empty($_SESSION['ai_popup_open'])): ?>
        aiPopup.classList.add('show');
        setTimeout(() => {
            aiChatBody.scrollTop = aiChatBody.scrollHeight;
            aiPromptInput.focus();
        }, 200);
    <?php unset($_SESSION['ai_popup_open']); endif; ?>

    aiButton.addEventListener('click', () => {
        aiPopup.classList.toggle('show');
        if (aiPopup.classList.contains('show')) {
            setTimeout(() => aiPromptInput.focus(), 200);
            setTimeout(() => {
                aiChatBody.scrollTop = aiChatBody.scrollHeight;
            }, 250);
        }
    });

    // Tutup popup jika klik di luar window
    document.addEventListener('click', function(e) {
        if (
            aiPopup.classList.contains('show') &&
            !aiPopup.contains(e.target) &&
            !aiButton.contains(e.target)
        ) {
            aiPopup.classList.remove('show');
        }
    });

    // Event delegation: tutup popup jika klik bubble chat (user/ai)
    document.getElementById('aiChatMessages').addEventListener('click', function(e) {
        if (e.target.classList.contains('ai-message')) {
            aiPopup.classList.remove('show');
        }
    });

    // Prevent form submit on empty input
    document.getElementById('aiForm').addEventListener('submit', function(e) {
        if (!aiPromptInput.value.trim()) {
            e.preventDefault();
        }
    });

    // Auto-scroll to bottom after submit (for PHP reload)
    window.addEventListener('DOMContentLoaded', function() {
        if (aiPopup.classList.contains('show')) {
            aiChatBody.scrollTop = aiChatBody.scrollHeight;
        }
    });
</script>