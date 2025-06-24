<!-- AI Button -->
<div class="ai-button" id="aiButton">
    <img src="../assets/img/logo1.png" alt="AI Logo" />
</div>

<!-- AI Chat Popup -->
<div class="ai-popup" id="aiPopup">
    <div class="ai-header">
        <h5>AI Assistant</h5>
    </div>
    <div class="ai-body">
        <p>Hi! How can I assist you today?</p>
        <!-- Chat content will go here -->
    </div>
    <div class="ai-footer">
        <input type="text" placeholder="Type your message..." />
        <button class="send-btn">Send</button>
    </div>
</div>

<!-- CSS -->
<style>
/* AI Button */
.ai-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background-color: #001F3F; /* Biru donker */
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    z-index: 1000;
    transition: transform 0.3s ease; /* Animasi saat diklik */
}

.ai-button:hover {
    transform: scale(1.1); /* Efek hover */
}

.ai-button img {
    width: 40px;
    height: 40px;
}

/* AI Popup */
.ai-popup {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 300px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    opacity: 0; /* Awalnya tidak terlihat */
    transform: translateY(20px); /* Awalnya sedikit turun */
    transition: opacity 0.3s ease, transform 0.3s ease; /* Animasi smooth */
    z-index: 1001;
    pointer-events: none; /* Tidak bisa diklik saat tersembunyi */
}

.ai-popup.show {
    opacity: 1; /* Tampilkan popup */
    transform: translateY(0); /* Kembali ke posisi normal */
    pointer-events: auto; /* Aktifkan interaksi */
}

.ai-header {
    background-color: #001F3F; /* Biru donker */
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
}

.ai-footer {
    padding: 10px;
    display: flex;
    gap: 10px;
}

.ai-footer input {
    flex: 1;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.ai-footer .send-btn {
    background-color: #001F3F; /* Biru donker */
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}
</style>

<!-- JavaScript -->
<script>
    // Toggle AI Popup
    const aiButton = document.getElementById('aiButton');
    const aiPopup = document.getElementById('aiPopup');

    aiButton.addEventListener('click', () => {
        if (aiPopup.classList.contains('show')) {
            aiPopup.classList.remove('show'); // Sembunyikan popup
        } else {
            aiPopup.classList.add('show'); // Tampilkan popup
        }
    });
</script>