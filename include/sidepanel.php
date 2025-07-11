<?php
// Side Panel PHP File
?>

<style>
  /* CSS untuk Sidebar Kanan */
  #side-panel {
    position: fixed;
    top: 60.8px;
    right: 0;
    width: 50px; /* Lebar normal */
    height: 100vh;
    background-color: #f1f3f4;
    border-left: 1px solid #ccc;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: -2px 0 5px rgba(0,0,0,0.1);
    transition: width 0.3s ease;
    z-index: 1000;
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
  }

  /* Wrapper ikon */
  #icons-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 25px;
    padding-top: 60px; /* Memberi ruang untuk tombol toggle */
    flex-grow: 1;
  }

  .icon {
    cursor: pointer;
    font-size: 20px;
    transition: transform 0.2s;
  }

  .icon:hover {
    transform: scale(1.2);
  }

  .plus-icon {
    margin-bottom: 20px;
    font-size: 22px;
  }

  #side-panel.collapsed {
    width: 0;
    overflow: visible;
  }

  #toggle-btn {
    position: absolute;
    top: 5px;
    left: -20px;
    cursor: pointer;
    font-size: 14px;
    background:rgb(224, 224, 224);
    border-radius: 50%;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    user-select: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    z-index: 1001;
  }

  #side-panel.collapsed #icons-wrapper {
    display: none;
  }

  #side-panel.collapsed #toggle-btn {
    transform: rotate(180deg);
    left: -15px;
  }

  #popup-container {
    position: fixed;
    background: white;
    border: 1px solid #ccc;
    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    padding: 15px;
    border-radius: 8px;
    z-index: 2000;
    min-width: 200px;
  }

  #popup-container.hidden {
    display: none;
  }

  .popup-content {
    position: relative;
  }

  .popup-content .close-btn {
    position: absolute;
    top: -10px;
    right: 20px;
    background: #f44336;
    color: white;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    text-align: center;
    cursor: pointer;
    font-size: 16px;
    line-height: 22px;
  }
</style>

<div id="side-panel">
  <!-- Tombol Toggle -->
  <div id="toggle-btn" href="javascript:void(0);" onclick="togglePanel()">«</div>

  <!-- Wrapper ikon yang akan disembunyikan/ditampilkan -->
  <div id="icons-wrapper">
    <div class="icon" onclick="showPopup('calendar')">📅</div>
    <div class="icon" onclick="showPopup('note')">📝</div>
    <div class="icon" onclick="showPopup('task')">✅</div>
    <div class="icon" onclick="showPopup('chat')">💬</div>
    <div class="icon" onclick="showPopup('gmail')">✉️</div>
    <div class="icon plus-icon" onclick="showPopup('addon')">➕</div>
  </div>
</div>

<div id="popup-container" class="hidden">
  <div class="popup-content">
    <div id="popup-title"></div>
    <div class="close-btn" onclick="closePopup()">×</div>
  </div>
</div>

<script>
  function showPopup(type) {
    const popup = document.getElementById('popup-container');
    const title = document.getElementById('popup-title');
    const panel = document.getElementById('side-panel');

    const panelRect = panel.getBoundingClientRect();
    popup.style.top = `${panelRect.top + (panelRect.height / 2) - (popup.offsetHeight / 2)}px`;
    popup.style.left = `${panelRect.left - (popup.offsetWidth || 220) - 10}px`;

    title.textContent = type;
    popup.classList.remove('hidden');
  }

  function closePopup() {
    document.getElementById('popup-container').classList.add('hidden');
  }

  function togglePanel() {
    document.getElementById('side-panel').classList.toggle('collapsed');
  }
</script>