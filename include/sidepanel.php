<?php
// Side Panel PHP File
?>

<style>
  /* CSS untuk Sidebar Kanan Atas */
  #side-panel {
    position: fixed;
    top: 50%;
    right: 0;
    width: 50px; /* Lebar normal */
    height: 290px;
    background-color: #f1f3f4;
    border-left: 1px solid #ccc;
    display: flex;
    flex-direction: column;
    align-items: center;
    transform: translateY(-50%);
    box-shadow: -2px 0 5px rgba(0,0,0,0.1);
    transition: width 0.3s ease;
    z-index: 1000;
  }

  /* Wrapper ikon */
  #icons-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
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
    margin-top: auto;
    font-size: 22px;
  }

  #side-panel.collapsed {
    transform: translateY(-50%);
    width: 0;
    overflow: visible; /* Biar tombol toggle tetap terlihat */
    padding: 10px 0;
  }

  #toggle-btn {
    position: absolute;
    top: 10px;
    left: -20px; /* 20px ke kiri dari sisi panel */
    cursor: pointer;
    font-size: 14px;
    background: #e0e0e0;
    border-radius: 3px;
    width: 20px;
    height: 20px;
    text-align: center;
    line-height: 20px;
    user-select: none;
    transition: transform 0.3s ease;
  }

  #side-panel.collapsed #icons-wrapper {
    display: none;
  }

  #side-panel.collapsed #toggle-btn {
    transform: rotate(180deg);
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
    right: -10px;
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
  <div id="toggle-btn" onclick="togglePanel()">«</div>

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