<?php
// --- Konfigurasi Gemini API ---
// GANTI DENGAN API KEY GEMINI Anda
$gemini_api_key = 'AIzaSyDlFjG6KMo3LMA_a2xqgGe3I13lLAasoeE'; // <<< GANTI INI
$gemini_endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $gemini_api_key;
// --- Akhir Konfigurasi ---

$analysis_result = "";
$error_message = "";

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['prompt'])) {
    $user_prompt = trim($_POST['prompt']);

    // Siapkan body request untuk Gemini
    $api_request_body = json_encode([
        'contents' => [
            [
                'parts' => [
                    ['text' => $user_prompt]
                ]
            ]
        ]
    ]);

    // Kirim permintaan ke Gemini API menggunakan cURL
    $ch = curl_init($gemini_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $api_request_body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

    $api_response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_message = "cURL Error: " . curl_error($ch);
        $analysis_result = "Gagal memanggil API karena error cURL.";
    } else {
        $response_data = json_decode($api_response, true);
        if (json_last_error() === JSON_ERROR_NONE &&
            isset($response_data['candidates'][0]['content']['parts'][0]['text'])) {
            $analysis_result = $response_data['candidates'][0]['content']['parts'][0]['text'];
        } else {
            $error_message = "Gagal mendapatkan hasil dari API.";
            if (isset($response_data['error'])) {
                $error_message .= " API Error: " . ($response_data['error']['message'] ?? 'Unknown API error');
            } else {
                $error_message .= " Struktur Response Tidak Sesuai atau Kosong. Response Mentah: " . htmlspecialchars($api_response);
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
        body { font-family: sans-serif; line-height: 1.6; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { width: 90%; max-width: 700px; margin: 40px auto; padding: 30px; background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.08);}
        h2 { color: #333; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 0;}
        .prompt-form textarea { width: 100%; min-height: 100px; padding: 10px; font-size: 1em; border-radius: 5px; border: 1px solid #ccc; margin-bottom: 15px; }
        .prompt-form button { padding: 10px 25px; background: #7367f0; color: #fff; border: none; border-radius: 5px; font-size: 1em; cursor: pointer;}
        .prompt-form button:hover { background: #5a50c7; }
        .analysis-box { margin-top: 25px; padding: 18px; background-color: #e9f7ef; border: 1px solid #d0e9c6; border-radius: 5px; white-space: pre-wrap; word-wrap: break-word; color: #333;}
        .error-message { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
        label { font-weight: bold; }
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
</body>
</html>