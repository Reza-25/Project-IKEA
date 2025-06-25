<?php
session_start(); // Pastikan session_start() ada di awal

// --- Konfigurasi Gemini API ---
$gemini_api_key = 'AIzaSyC-XR77mldEzqu5cWH_UK77LHrywEO6ddM'; // <--- Ganti dengan API key kamu
$gemini_endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $gemini_api_key;
// --- Akhir Konfigurasi ---

if (!isset($_SESSION['ai_chat'])) {
    $_SESSION['ai_chat'] = [];
}

$analysis_result = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prompt'])) {
    $user_prompt = trim($_POST['prompt']);
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

    $_SESSION['ai_popup_open'] = true;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prompt'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'analysis_result' => $analysis_result,
        'error_message' => $error_message
    ]);
    exit;
}
?>

<div class="ai-tooltip" id="aiTooltip">IKEA AI Assistant, we're ready to help</div>

<!-- AI Button -->
<div class="ai-button" id="aiButton">
    <img src="../assets/img/ikeamaskot.png" />
</div>

<!-- AI Chat Popup -->
<div class="ai-popup" id="aiPopup">
    <div class="ai-header">
        <h5>AI Assistant</h5>
        <span class="ai-close-btn" id="aiCloseBtn">×</span>
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
    <form class="ai-footer" id="aiForm" method="post" action="javascript:void(0);">
        <input type="text" name="prompt" id="aiPromptInput" placeholder="Type your message..." autocomplete="off" required />
        <button type="button" class="send-btn" id="sendButton">Send</button>
    </form>
</div>

<!-- CSS -->
<style>
/* Tooltip */
.ai-tooltip {
    position: fixed;
    bottom: 90px !important;
    right: 1% !important;
    background-color: #001F3F;
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 14px;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
    z-index: 1002;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    white-space: nowrap;
    transform: none !important;
}

/* Panah tooltip */
.ai-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 85%;
    transform: translateX(-50%);
    border-width: 5px;
    border-style: solid;
    border-color: #001F3F transparent transparent transparent;
}

/* AI Button */
.ai-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background-color: #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    z-index: 1000;
    transition: transform 0.3s ease, opacity 0.3s ease;
}
.ai-button:hover {
    transform: scale(1.1);
}
.ai-button img {
    width: 40px;
    height: 40px;
}

/* Popup */
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

/* Header */
.ai-header {
    background-color: #001F3F;
    color: #fff;
    padding: 10px 15px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}
.ai-header h5 {
    margin: 0;
    font-size: 16px;
}

/* Close Button */
.ai-close-btn {
    cursor: pointer;
    font-size: 22px;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.3s;
}
.ai-close-btn:hover {
    background-color: rgba(255,255,255,0.2);
}

/* Body */
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

/* Messages */
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

/* Footer */
.ai-footer {
    padding: 10px;
    display: flex;
    gap: 10px;
    border-top: 1px solid #eee;
}
.ai-footer input {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}
.ai-footer .send-btn {
    background-color: #001F3F;
    color: #fff;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: box-shadow 0.3s ease;
}
.ai-footer .send-btn:hover {
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

/* Animasi */
.hidden {
    opacity: 0;
    pointer-events: none;
    transform: translateY(20px) scale(0.8);
}
</style>

<!-- JavaScript -->
<script>
const aiButton = document.getElementById('aiButton');
const aiTooltip = document.getElementById('aiTooltip');
const aiPopup = document.getElementById('aiPopup');
const aiCloseBtn = document.getElementById('aiCloseBtn');
const aiPromptInput = document.getElementById('aiPromptInput');
const aiChatBody = document.getElementById('aiChatBody');
const aiChatMessages = document.getElementById('aiChatMessages');

<?php if (!empty($_SESSION['ai_popup_open'])): ?>
    aiButton.classList.add('hidden');
    aiPopup.classList.add('show');
    setTimeout(() => {
        aiChatBody.scrollTop = aiChatBody.scrollHeight;
        aiPromptInput.focus();
    }, 200);
<?php unset($_SESSION['ai_popup_open']); endif; ?>

// [1] Tampilkan popup saat tombol AI diklik
aiButton.addEventListener('click', () => {
    aiButton.classList.add('hidden');
    aiPopup.classList.add('show');
    
    setTimeout(() => {
        aiChatBody.scrollTop = aiChatBody.scrollHeight;
        aiPromptInput.focus();
    }, 200);
});

// [2] Sembunyikan popup saat tombol X diklik
aiCloseBtn.addEventListener('click', () => {
    aiPopup.classList.remove('show');
    
    setTimeout(() => {
        aiButton.classList.remove('hidden');
    }, 300);
});

// [3] Sembunyikan popup saat klik di luar area
document.addEventListener('click', function(e) {
    if (
        aiPopup.classList.contains('show') &&
        !aiPopup.contains(e.target) &&
        !aiButton.contains(e.target)
    ) {
        aiPopup.classList.remove('show');
        
        setTimeout(() => {
            aiButton.classList.remove('hidden');
        }, 300);
    }
});

// [4] Kirim pesan
document.getElementById('sendButton').addEventListener('click', function() {
    const promptInput = document.getElementById('aiPromptInput');
    if (promptInput.value.trim() === '') return;

    const userMessage = promptInput.value.trim();
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'ai.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            const userBubble = document.createElement('div');
            userBubble.className = 'ai-message user';
            userBubble.textContent = userMessage;
            aiChatMessages.appendChild(userBubble);

            const response = JSON.parse(xhr.responseText);
            const aiBubble = document.createElement('div');
            aiBubble.className = 'ai-message ai';
            aiBubble.textContent = response.analysis_result || 'No response from AI.';
            aiChatMessages.appendChild(aiBubble);

            aiChatBody.scrollTop = aiChatBody.scrollHeight;
        } else {
            alert('Error: ' + xhr.statusText);
        }
    };
    xhr.send('prompt=' + encodeURIComponent(userMessage));
    promptInput.value = '';
    aiChatBody.scrollTop = aiChatBody.scrollHeight;
});

// [5] Submit form dengan Enter
aiPromptInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        document.getElementById('sendButton').click();
    }
});

// [6] Tooltip hover effect
aiButton.addEventListener('mouseenter', () => {
    aiTooltip.style.opacity = '1';
    aiTooltip.style.bottom = (aiButton.offsetTop - 40) + 'px';
    aiTooltip.style.right = (window.innerWidth - aiButton.getBoundingClientRect().right + 30) + 'px';
});

aiButton.addEventListener('mouseleave', () => {
    aiTooltip.style.opacity = '0';
});

aiPopup.addEventListener('mouseenter', () => {
    aiTooltip.style.opacity = '0';
});

// [7] Auto scroll saat ada pesan baru
function scrollToBottom() {
    aiChatBody.scrollTop = aiChatBody.scrollHeight;
}

// Inisialisasi scroll
window.addEventListener('DOMContentLoaded', function() {
    if (aiPopup.classList.contains('show')) {
        setTimeout(scrollToBottom, 100);
    }
});
</script>