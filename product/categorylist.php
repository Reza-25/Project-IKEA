<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>IKEA</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/animate.css">
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>
  body {
    background-color: #f8f9fa; /* Light gray background for the whole page */
  }
  a {
    text-decoration: none !important;
  }

  .ikea-select {
    background-color: #E6F0FF !important; /* Soft blue */
    border: 2px solid #ccc;
    color: #333;
    border-radius: 20px;
    padding: 6px 16px;
    font-size: 0.85rem;
    appearance: none;
    width: 140px; /* Lebar diperpanjang */
    background-image: url("data:image/svg+xml,%3Csvg fill='%230051BA' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.6rem center;
    background-size: 14px;
    transition: border-color 0.3s ease;
  }

  .ikea-select:hover {
    border-color: #0051BA;
  }

  .ikea-select:focus {
    outline: none;
    border-color: #0051BA;
    box-shadow: 0 0 0 3px rgba(230, 240, 255, 0.8); /* glow soft blue */
  }

  .card-header h5 {
    color: white;
  }

  .ikea-note-card {
    background-color: #fffbea;
    border: none;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    border-left: 8px solid #FFCC00;
    border-radius: 10px;
    margin-bottom: 20px;
  }
  
  #notesCarousel::-webkit-scrollbar {
    height: 8px;
  }

  #notesCarousel::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
  }
  .note-card p {
    margin: 0;
    color: #333;
    font-size: 14px;
  }

  .note-card strong {
    font-size: 16px;
  }

  .card-body::-webkit-scrollbar {
    width: 6px;
  }

  .card-body::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
  }

/* Reset semua background jadi putih & style dasar kolom */
.das1, .das2, .das3, .das4 {
  background: white !important;
  border-radius: 20px;
  padding: 20px;
  transition: all 0.3s ease;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

/* Struktur utama card */
.dash-count {
  padding: 24px;
  border-radius: 20px;
  background-color: white;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Efek saat hover */
.dash-count:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
  background-color: #f9f9f9;
}

/* Penyesuaian tampilan angka dan label */
.dash-counts h4 {
  font-size: 24px;
  margin-bottom: 5px;
  font-weight: bold;
}
.dash-counts h5 {
  font-size: 14px;
  margin: 0;
}
.stat-change {
  font-size: 11px;
  font-weight: normal;
  margin-top: 4px;
  color: #6c757d;
}

/* Gaya icon kanan */
.dash-imgs i {
  font-size: 32px;
}

/* Kolom 1 - Biru Laut */
.das1 {
  border-top: 6px solid #1a5ea7;
}
.das1 * {
  color: #1a5ea7 !important;
}

/* Kolom 2 - Ungu */
.das2 {
  border-top: 6px solid #751e8d;
}
.das2 * {
  color: #751e8d !important;
}

/* Kolom 3 - Kuning/Oranye */
.das3 {
  border-top: 6px solid #e78001;
}
.das3 * {
  color: #e78001 !important;
}

/* Kolom 4 - Tosca */
.das4 {
  border-top: 6px solid #018679;
}
.das4 * {
  color: #018679 !important;
}

.stat-change {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;         /* Warna teks */
    display: inline-block;
    padding: 3px 6px;
    border-radius: 12px;
    font-weight: 600;
}

/* Icon Box Style */
.icon-box {
  width: 44px;
  height: 44px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  box-shadow: 0 2px 6px rgba(33, 150, 243, 0.2);
  transition: box-shadow 0.2s, transform 0.2s;
  cursor: pointer;
}
.icon-box i {
  color: #ffffff !important;
  font-size: 16 px;
}
/* Efek hover dan active */
.icon-box:hover,
.icon-box:active {
  box-shadow: 0 4px 12px rgba(0,0,0,0.18);
  transform: scale(1.08);
}
.bg-ungu {
  background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
}
.bg-biru {
  background: linear-gradient(135deg, #a259c6 0%, #6d28d9 100%);
}
.bg-hijau {
  background: linear-gradient(135deg,rgb(89, 236, 222) 0%, #018679 100%);
}
.bg-merah {
  background: linear-gradient(135deg, #ff5858 0%, #e78001 100%);
}

/* css bar chart & notes */
.chart-notes-row {
    display: flex;
    gap: 20px;
    align-items: flex-start;
  }
  .chart-wrapper {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    padding: 20px 24px;
    flex: 0 0 55%;
    display: flex;
    flex-direction: column;
    gap: 16px;
    min-width: 300px;
  }
  .chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
  }
  .chart-title {
    font-size: 16px; /* Increased font size for titles */
    font-weight: 600;
    color: #2c3e50;
    letter-spacing: 0.3px;
    font-family: 'Segoe UI', sans-serif;
  }
  .chart-select {
    font-size: 13px;
    padding: 6px 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    font-family: 'Segoe UI', sans-serif;
  }
  .notes-container {
    flex: 0 0 40%;
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    min-width: 260px;
    max-height: 370px;      /* Tambahkan tinggi maksimum */
    overflow-y: auto;       /* Aktifkan scroll vertikal */
  }
  .note-title {
    font-size: 15px;
    color: white;
    margin-bottom: 15px;
    font-weight: 600;
    border-radius: 10px;
    padding: 10px 15px;
    background: linear-gradient(135deg, #0d6efd, #66bfff);
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .note-line {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-left: 4px solid transparent;
    border-radius: 8px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
  }
  .note-line:hover {
    background-color: #f0f4ff;
  }
  .note-line.active {
    border-left: 4px solid #0d6efd;
    background-color: #eaf3ff;
  }
  .note-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #fff;
    font-size: 14px;
    flex-shrink: 0;
  }
  .bg-blue { background-color: #0d6efd; }
  .bg-green { background-color: #28a745; }
  .bg-orange { background-color: #fd7e14; }
  .bg-purple { background-color: #6f42c1; }
  .note-text {
    display: flex;
    justify-content: space-between;
    flex: 1;
  }
  .note-label {
    color: #555;
    font-size: 14px;
  }
  .note-value {
    font-size: 15px;
    font-weight: 600;
    color: #0d6efd;
  }
  @media (max-width: 900px) {
    .chart-notes-row {
      flex-direction: column;
    }
    .chart-wrapper, .notes-container {
      max-width: 100%;
      flex: 100%;
    }
  }
  /* END - css bar chart & notes  */

  /* css tabel */
  .container-wrapper {
    background: #fff;
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    margin-top: 30px;
  }

  .d-flex-between {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
  }

  table {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    width: 100%;
    border-collapse: collapse;
    margin-top: 16px;
  }

  thead th {
    background-color:rgb(243, 250, 255) !important;
    color: #0d47a1 !important;
    font-weight: 600 !important;
    font-size: 15px !important;
    padding: 12px !important;
    text-align: center !important;
    letter-spacing: 0.5px !important;
    border-bottom: 3px solid #90caf9 !important;
    box-shadow: 0 2px 8px rgba(13, 71, 161, 0.06) !important;
  }

  tbody tr {
    transition: background-color 0.3s ease;
  }

  tbody tr:hover {
    background-color: #f1f9ff;
  }

  td {
    padding: 10px;
    text-align: center;
  }

  .btn {
    transition: all 0.3s ease;
    font-size: 13px;
    padding: 4px 10px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .btn.btn-primary {
    background-color: #0d6efd;
    color: #fff;
    border-radius: 20px;
  }

  .btn.btn-primary:hover {
    background-color: #084298;
    transform: scale(1.05);
  }

  .btn.view-detail {
    background-color: #0d6efd;
    color: #fff;
    border-radius: 20px;
    padding: 4px 10px;
  }

  .btn.view-detail:hover {
    background-color: #084298;
    transform: scale(1.05);
  }

  .export-container {
    background-color: #f1f1f1;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
  }

  @keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
  }

  .modal-popup {
    position: fixed;
    z-index: 9999;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 12px;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
    padding: 20px;
    width: 320px;
    animation: fadeInUp 0.5s ease;
  }

  .modal-popup .modal-header {
    background-color: #0d6efd;
    color: white;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 10px 15px;
  }

  .modal-popup .modal-body {
    padding: 10px 15px;
  }

  #searchInput {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    max-width: 280px;
    font-size: 14px;
  }

  .status-pill {
    padding: 4px 8px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .status-pill::before {
    content: "";
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
  }

  .status-active {
    background-color: #d4edda;
    color: #155724;
  }

  .status-active::before {
    background-color: #28a745;
  }

  .status-pending {
    background-color: #fff3cd;
    color: #856404;
  }

  .status-pending::before {
    background-color: #ffc107;
  }

  .status-ordered {
    background-color: #cce5ff;
    color: #004085;
  }

  .status-ordered::before {
    background-color: #007bff;
  }

  .status-inactive {
    background-color: #f8d7da;
    color: #721c24;
  }

  .status-inactive::before {
    background-color: #dc3545;
  }
  /* END- css tabel */

  /* Hilangkan kotak pada tombol prev, next, dan view detail */
.prev-next-btn,
.btn.view-detail,
.btn.btn-sm[style*="border:1px solid"] {
  background: none !important;
  color: #0d47a1 !important;
  border: none !important;
  border-radius: 999px !important;
  box-shadow: none !important;
  padding: 4px 16px !important;
  font-size: 13px !important;
  transition: background 0.2s, color 0.2s;
}
.prev-next-btn:hover,
.btn.view-detail:hover,
.btn.btn-sm[style*="border:1px solid"]:hover {
  background: #e3f2fd !important;
  color: #084298 !important;
}

.btn.view-detail,
.btn.btn-sm[style*="border:1px solid"] {
  padding: 4px 16px !important;
  font-size: 13px !important;
  border: none !important;
  background: none !important;
  color: #0d47a1 !important;
  border-radius: 999px !important;
  box-shadow: none !important;
}

/* MIS Log & Insight Card */
#mis-log-insight {
  align-items: stretch;
}
#mis-log-insight .mis-card {
  display: flex;
  flex-direction: column;
  height: 100%;
  min-height: 20px;
  background: linear-gradient(120deg, #f8fbff 80%, #e3f2fd 100%);
  border-radius: 18px;
  box-shadow: 0 6px 18px rgba(13,71,161,0.09);
  padding: 22px 26px 18px 26px;
  border-left: 6px solid #0d47a1;
  transition: box-shadow 0.2s, transform 0.2s;
  margin-bottom: 0;
}
#mis-log-insight .mis-card:hover {
  box-shadow: 0 14px 36px rgba(13,71,161,0.16);
  transform: translateY(-2px) scale(1.01);
}
.mis-card-header {
  font-size: 17px;
  font-weight: 700;
  color: #0d47a1;
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  letter-spacing: 0.2px;
}
.mis-log-list {
  max-height: 170px;
  overflow-y: auto !important;    /* Aktifkan scroll vertikal */
  overflow-x: hidden !important;  /* Hilangkan scroll horizontal */
  font-size: 14px;
  background: none;
  border: none;
  padding-left: 0;
  flex-grow: 1;
  scrollbar-width: thin;
  scrollbar-color: #90caf9 #f8fbff;
}
.mis-log-list::-webkit-scrollbar {
  width: 7px;
  background: #f8fbff;
}
.mis-log-list::-webkit-scrollbar-thumb {
  background: #90caf9;
  border-radius: 8px;
}
.mis-log-list li {
  background: linear-gradient(90deg, #f8fbff 80%, #e3f2fd 100%);
  border-radius: 12px;
  margin-bottom: 10px;
  border: none;
  box-shadow: 0 2px 8px rgba(13,71,161,0.06);
  padding: 13px 18px;
  color: #222;
  transition: background 0.2s, transform 0.2s;
  border-left: 5px solid #90caf9;
  position: relative;
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14px;
  animation: fadeInUp 0.5s;
}
.mis-log-list li:hover {
  background: #e3f2fd;
  transform: scale(1.01);
  border-left: 5px solid #0d47a1;
}
.mis-log-list .log-status-label {
  font-size: 12px;
  font-weight: 600;
  margin-right: 10px;
  letter-spacing: 0.5px;
  color: #fff;
  padding: 3px 14px;
  border-radius: 12px;
  vertical-align: middle;
  display: inline-block;
}
.log-status-add {
  background: #4caf50;
}
.log-status-update {
  background: #ffc107;
  color: #333 !important;
}
.log-status-delete {
  background: #f44336;
}
.mis-log-list span.log-time {
  color: #888;
  font-size: 12px;
  margin-right: 8px;
  min-width: 98px;
  display: inline-block;
}
/* ...existing styles... */
.mis-ai-insight {
  font-size: 14px;
  color: #222;
  line-height: 1.7;
  padding-left: 0;
  max-height: 170px;
  overflow-y: auto;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  gap: 0;
}
.mis-ai-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.mis-ai-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  background: #f8fbff;
  border-radius: 10px;
  margin-bottom: 10px;
  padding: 12px 14px 12px 16px;
  box-shadow: 0 2px 8px rgba(13,71,161,0.04);
  transition: background 0.2s, border-color 0.2s;
  position: relative;
  animation: fadeInUp 0.5s;
}
.mis-ai-item:last-child {
  margin-bottom: 0;
}
.mis-ai-icon {
  font-size: 18px;
  width: 32px;
  height: 32px;
  background: linear-gradient(135deg, #0d47a1 60%, #66bfff 100%);
  color: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-top: 2px;
  box-shadow: 0 2px 8px rgba(13,71,161,0.07);
}
.mis-ai-content {
  flex: 1;
  font-size: 14px;
  color: #0d47a1;
}
.mis-ai-content b {
  color: #0d47a1;
}
.mis-ai-content span {
  color: #1976d2;
  font-weight: 600;
}
.mis-ai-item:hover {
  background: #e3f2fd;
  border-left: 5px solid #1976d2;
}
@media (max-width: 900px) {
  #mis-log-insight .mis-card { margin-bottom: 18px; }
  #mis-log-insight { flex-direction: column; }
}

/* ...existing code... */

/* Tambahan: Scrollbar custom untuk notes-container & mis-ai-insight */
.notes-container,
.mis-ai-insight {
  scrollbar-width: thin;
  scrollbar-color: #90caf9 #f8fbff;
}
.notes-container::-webkit-scrollbar,
.mis-ai-insight::-webkit-scrollbar {
  width: 7px;
  background: #f8fbff;
}
.notes-container::-webkit-scrollbar-thumb {
  background: #90caf9;
  border-radius: 8px;
}

/* Hilangkan scrollbar pada notes-container */
.notes-container {
  scrollbar-width: none !important;
}
.notes-container::-webkit-scrollbar {
  display: none !important;
}

/* Scrollbar pada mis-ai-insight tetap seperti aktivitas log */
.mis-ai-insight {
  scrollbar-width: thin;
  scrollbar-color: #90caf9 #f8fbff;
}
.mis-ai-insight::-webkit-scrollbar {
  width: 7px;
  background: #f8fbff;
}
.mis-ai-insight::-webkit-scrollbar-thumb {
  background: #90caf9;
  border-radius: 8px;
}

/* area chart dan donut chart */
.card {
    border-radius: 12px;
    border: 1px solid #e0e0e0;
    background-color: #ffffff;
  }
  h6 {
    font-weight: 600;
  }

/* New styles for the dashboard layout */
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 300px; /* Main content and sidebar */
    gap: 20px;
    margin-top: 20px;
}

@media (max-width: 992px) {
    .dashboard-grid {
        grid-template-columns: 1fr; /* Stack columns on smaller screens */
    }
}

.main-dashboard-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.right-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.dashboard-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.dashboard-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.dashboard-card-title {
    font-size: 16px;
    font-weight: 600;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 8px;
}

.dashboard-card-title i {
    color: #0d47a1;
}

.insight-card {
    background-color: #fffbea;
    border-left: 8px solid #FFCC00;
    border-radius: 10px;
    padding: 15px 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    font-size: 14px;
    color: #333;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.insight-card i {
    color: #FFCC00;
    font-size: 18px;
    margin-top: 2px;
}

.insight-card p {
    margin: 0;
    line-height: 1.5;
}

.sidebar-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.sidebar-card-title {
    font-size: 16px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sidebar-card-title i {
    color: #0d47a1;
}

.prediction-card .prediction-value {
    font-size: 24px;
    font-weight: bold;
    color: #0d47a1;
    margin-bottom: 5px;
}

.prediction-card .prediction-detail {
    font-size: 13px;
    color: #555;
    line-height: 1.4;
}

.prediction-card .prediction-trend {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    font-weight: 600;
    margin-top: 10px;
}

.prediction-card .prediction-trend.up {
    color: #28a745;
}

.prediction-card .prediction-trend.down {
    color: #dc3545;
}

.notification-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.notification-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 15px;
    font-size: 14px;
    color: #333;
}

.notification-item:last-child {
    margin-bottom: 0;
}

.notification-icon {
    font-size: 18px;
    color: #0d47a1;
    flex-shrink: 0;
    margin-top: 2px;
}

.notification-text {
    flex: 1;
}

.notification-text strong {
    color: #0d47a1;
}

.notification-text .status-label {
    font-size: 12px;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 10px;
    display: inline-block;
    margin-left: 8px;
}

.status-critical {
    background-color: #f8d7da;
    color: #721c24;
}

.status-warning {
    background-color: #fff3cd;
    color: #856404;
}

.status-info {
    background-color: #d1ecf1;
    color: #0c5460;
}

.health-score-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 14px;
}

.health-score-item:last-child {
    margin-bottom: 0;
}

.health-score-item .brand-name {
    font-weight: 600;
    color: #333;
}

.health-score-item .score-bar {
    flex-grow: 1;
    height: 8px;
    background-color: #e0e0e0;
    border-radius: 4px;
    margin: 0 10px;
    overflow: hidden;
}

.health-score-item .score-fill {
    height: 100%;
    border-radius: 4px;
}

.score-fill.high {
    background-color: #28a745;
}

.score-fill.medium {
    background-color: #ffc107;
}

.score-fill.low {
    background-color: #dc3545;
}

.brand-readiness-card {
    text-align: center;
    padding: 20px;
}

.brand-readiness-card .percentage {
    font-size: 48px;
    font-weight: bold;
    color: #0d47a1;
    margin-bottom: 10px;
}

.brand-readiness-card .brand-name {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.brand-readiness-card .score-text {
    font-size: 14px;
    color: #555;
    margin-bottom: 20px;
}

.brand-readiness-metrics {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

.metric-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}

.metric-value {
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.metric-label {
    font-size: 12px;
    color: #777;
}

.metric-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 4px;
}

.indicator-green { background-color: #28a745; }
.indicator-orange { background-color: #ffc107; }
.indicator-blue { background-color: #0d6efd; }

.promo-checkbox {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 14px;
    color: #555;
}

.promo-checkbox input[type="checkbox"] {
    width: 18px;
    height: 18px;
    border-radius: 4px;
    border: 1px solid #ccc;
    appearance: none;
    -webkit-appearance: none;
    cursor: pointer;
    position: relative;
}

.promo-checkbox input[type="checkbox"]:checked {
    background-color: #0d47a1;
    border-color: #0d47a1;
}

.promo-checkbox input[type="checkbox"]:checked::after {
    content: '\2713'; /* Checkmark character */
    color: white;
    font-size: 14px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

</style>


</head>
<body>
<div id="global-loader">

<div class="whirly-loader"> </div>
</div>


<div class="main-wrapper">
<!-- Include sidebar -->
<?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
<!-- /Include sidebar -->


<!-- BAGIAN ATAS -->
<div class="page-wrapper">
  <div class="content" style="background-color: #f0f2f5; padding: 20px; border-radius: 12px;"> <!-- Added light background to content area -->
    <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
  
    <!-- Main Dashboard Content -->
    <div class="dashboard-grid">
        <div class="main-dashboard-content">
            <!-- Top 5 Categories with Highest Sales (Bar Chart) -->
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h6 class="dashboard-card-title"><i class="fas fa-chart-bar"></i> Top 5 Categories with Highest Sales</h6>
                    <select id="barChartYear" class="chart-select">
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025" selected>2025</option>
                    </select>
                </div>
                <div style="position: relative; height: 280px;">
                    <canvas id="barChartTopCategories"></canvas>
                </div>
                <div class="insight-card mt-3">
                    <i class="fas fa-lightbulb"></i>
                    <p><strong>Insight: Dominasi Kategori Furniture</strong><br/>Kategori Furniture mendominasi penjualan dengan kontribusi terbesar. Penjualan tertinggi di Q2 karena program promo "Summer Refresh".</p>
                </div>
            </div>

            <!-- Category Contribution to Total Sales (Donut Chart) -->
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h6 class="dashboard-card-title"><i class="fas fa-chart-pie"></i> Category Contribution to Total Sales</h6>
                </div>
                <div style="display:flex;justify-content:center; position: relative; height: 250px;">
                    <canvas id="donutChartCategoryContribution"></canvas>
                </div>
                <div class="insight-card mt-3">
                    <i class="fas fa-lightbulb"></i>
                    <p><strong>Insight: Distribusi Merata</strong><br/>Top 5 kategori menyumbang 72% total penjualan. Kategori Storage menunjukkan peningkatan kontribusi terbesar (+5% YoY).</p>
                </div>
            </div>

            <!-- Category Growth Trend (Top 5 Categories) - Line Chart -->
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h6 class="dashboard-card-title"><i class="fas fa-chart-line"></i> Category Growth Trend (Top 5 Categories)</h6>
                    <select id="lineChartYear" class="chart-select">
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025" selected>2025</option>
                    </select>
                </div>
                <div style="position: relative; height: 300px;">
                    <canvas id="lineChartCategoryGrowth"></canvas>
                </div>
                <div class="insight-card mt-3">
                    <i class="fas fa-lightbulb"></i>
                    <p><strong>Insight: Tren Kategori Furniture</strong><br/>Kategori Furniture menunjukkan pertumbuhan stabil dengan peningkatan 8% QoQ. Penurunan kecil di bulan Juni karena masalah stok.</p>
                </div>
            </div>

            <!-- Insight "Produk Bersaing" Antar Brand (Static HTML to match image) -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="dashboard-card h-100">
                        <h6 class="dashboard-card-title"><i class="fas fa-lightbulb"></i> Insight "Produk Bersaing" Antar Brand</h6>
                        <div class="d-flex align-items-center justify-content-around flex-grow-1">
                            <div class="text-center">
                                <img src="/placeholder.svg?height=60&width=60" alt="SKÅDIS" class="rounded-circle mb-2">
                                <h5 class="mb-1">SKÅDIS</h5>
                                <p class="text-muted" style="font-size:12px;">4.6 | Rp 299K | 240/bln</p>
                                <span class="badge bg-primary">Organizer</span>
                            </div>
                            <div class="text-center mx-3">
                                <span class="badge bg-danger rounded-circle p-2" style="font-size:1.2rem;">VS</span>
                            </div>
                            <div class="text-center">
                                <img src="/placeholder.svg?height=60&width=60" alt="VARIERA" class="rounded-circle mb-2">
                                <h5 class="mb-1">VARIERA</h5>
                                <p class="text-muted" style="font-size:12px;">4.3 | Rp 249K | 0.850/bln</p>
                                <span class="badge bg-info">Storage</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dashboard-card h-100">
                        <h6 class="dashboard-card-title"><i class="fas fa-lightbulb"></i> Insight "Produk Bersaing" Antar Brand</h6>
                        <div class="d-flex align-items-center justify-content-around flex-grow-1">
                            <div class="text-center">
                                <img src="/placeholder.svg?height=60&width=60" alt="LACK" class="rounded-circle mb-2">
                                <h5 class="mb-1">LACK</h5>
                                <p class="text-muted" style="font-size:12px;">4.5 | Rp 199K | 0.950/bln</p>
                                <span class="badge bg-success">Furniture</span>
                            </div>
                            <div class="text-center mx-3">
                                <span class="badge bg-danger rounded-circle p-2" style="font-size:1.2rem;">VS</span>
                            </div>
                            <div class="text-center">
                                <img src="/placeholder.svg?height=60&width=60" alt="HEMNES" class="rounded-circle mb-2">
                                <h5 class="mb-1">HEMNES</h5>
                                <p class="text-muted" style="font-size:12px;">4.7 | Rp 599K | 1.403/bln</p>
                                <span class="badge bg-warning">Bedroom</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Sidebar -->
        <div class="right-sidebar">
            <!-- Prediksi Penjualan Kategori per Bulan -->
            <div class="sidebar-card prediction-card">
                <h6 class="sidebar-card-title"><i class="fas fa-chart-line"></i> Prediksi Penjualan Kategori per Bulan</h6>
                <select id="predictionCategorySelect" class="chart-select mb-3">
                    <!-- Options will be populated by JS from kategoriList -->
                </select>
                <div id="predictionContent">
                    <!-- Content will be loaded by JS -->
                </div>
            </div>

            <!-- Notifikasi Kritis Otomatis -->
            <div class="sidebar-card">
                <h6 class="sidebar-card-title"><i class="fas fa-bell"></i> Notifikasi Kritis Otomatis</h6>
                <ul class="notification-list" id="notificationList">
                    <!-- Notifications will be generated by JS -->
                </ul>
            </div>

            <!-- Health Score untuk Kategori -->
            <div class="sidebar-card">
                <h6 class="sidebar-card-title"><i class="fas fa-heartbeat"></i> Health Score untuk Kategori</h6>
                <div id="healthScoreContent">
                    <!-- Health scores will be generated by JS -->
                </div>
            </div>

            <!-- Category Readiness Index -->
            <div class="sidebar-card brand-readiness-card">
                <h6 class="sidebar-card-title"><i class="fas fa-chart-line"></i> Category Readiness Index</h6>
                <select id="readinessCategorySelect" class="chart-select mb-3">
                    <!-- Options will be populated by JS from kategoriList -->
                </select>
                <div id="readinessContent">
                    <!-- Content will be loaded by JS -->
                </div>
            </div>

            <!-- Distribusi Lokasi Penjualan Terbanyak per Kategori -->
            <div class="sidebar-card">
                <h6 class="sidebar-card-title"><i class="fas fa-map-marker-alt"></i> Distribusi Lokasi Penjualan Terbanyak</h6>
                <div id="locationDistributionContent">
                    <!-- Content will be loaded by JS -->
                </div>
            </div>

            <!-- AI Suggestion: Produk Baru yang Potensial -->
            <div class="sidebar-card">
                <h6 class="sidebar-card-title"><i class="fas fa-robot"></i> AI Suggestion: Produk Baru yang Potensial</h6>
                <p id="aiSuggestionText" style="font-size:14px; color:#333;">
                    <!-- AI Suggestion will be loaded by JS -->
                </p>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // --- ORIGINAL DATA FROM YOUR FILE (KEPT AS IS) ---
  const kategoriList = [
    "Furniture", "Lighting", "Storage", "Bedroom", "Living Room",
    "Kitchen", "Dining", "Office", "Outdoor", "Textiles",
    "Decoration", "Bathroom", "Children", "Appliances", "Rugs",
    "Curtains", "Tableware", "Cookware", "Laundry", "Cleaning", "Pet"
  ];

  const bulanShort = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

  const dataTahun = {};
  for (let tahun = 2023; tahun <= 2025; tahun++) {
    dataTahun[tahun] = {};
    kategoriList.forEach(kategori => {
      dataTahun[tahun][kategori] = bulanShort.map((bulan, i) => {
        const total = Math.floor(Math.random() * 1000) + 100;
        const topProduct = `${kategori} Product ${i + 1}`;
        const topCategory = kategori;
        const avg = Math.floor(total / 3);
        return {
          bulan,
          totalSold: total,
          topProduct,
          topCategory,
          avgSold: avg
        };
      });
    });
  }

  const notesMap = {
    "Furniture": { totalProduk: 2100, kontribusi: "18% dari seluruh penjualan IKEA", produkKurangLaku: "5 produk < 10 unit", lowStock: "8 produk < 10 stok", insight: "Promo + restok Rak KALLAX", toko: "IKEA Alam Sutera" },
    "Lighting": { totalProduk: 900, kontribusi: "7% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "5 produk", insight: "Perbanyak stok LED Hemat Energi", toko: "IKEA Sentul" },
    "Storage": { totalProduk: 1100, kontribusi: "9% dari seluruh penjualan IKEA", produkKurangLaku: "2 produk", lowStock: "4 produk", insight: "Push marketing Lemari Serbaguna", toko: "IKEA Kota Baru" },
    "Bedroom": { totalProduk: 1400, kontribusi: "11% dari seluruh penjualan IKEA", produkKurangLaku: "4 produk", lowStock: "7 produk", insight: "Diskon Paket Kasur + Lemari", toko: "IKEA Alam Sutera" },
    "Living Room": { totalProduk: 1300, kontribusi: "10% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "2 produk", insight: "Tampilkan Sofa Premium", toko: "IKEA Surabaya" },
    "Kitchen": { totalProduk: 1200, kontribusi: "9% dari seluruh penjualan IKEA", produkKurangLaku: "5 produk", lowStock: "6 produk", insight: "Campaign dapur modular", toko: "IKEA Bali" },
    "Dining": { totalProduk: 800, kontribusi: "6% dari seluruh penjualan IKEA", produkKurangLaku: "4 produk", lowStock: "3 produk", insight: "Gabungkan bundling Meja + Kursi", toko: "IKEA Bandung" },
    "Office": { totalProduk: 750, kontribusi: "5% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "2 produk", insight: "Naikkan ads ergonomic chair", toko: "IKEA Surabaya" },
    "Outdoor": { totalProduk: 670, kontribusi: "4.5% dari seluruh penjualan IKEA", produkKurangLaku: "5 produk", lowStock: "2 produk", insight: "Highlight produk tahan cuaca", toko: "IKEA Bali" },
    "Textiles": { totalProduk: 720, kontribusi: "5.2% dari seluruh penjualan IKEA", produkKurangLaku: "6 produk", lowStock: "3 produk", insight: "Tambah varian warna gorden", toko: "IKEA Jakarta Garden City" },
    "Decoration": { totalProduk: 680, kontribusi: "5% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "4 produk", insight: "Bundle dekorasi minimalis", toko: "IKEA Sentul" },
    "Bathroom": { totalProduk: 610, kontribusi: "4% dari seluruh penjualan IKEA", produkKurangLaku: "4 produk", lowStock: "5 produk", insight: "Restok rak mandi gantung", toko: "IKEA Surabaya" },
    "Children": { totalProduk: 550, kontribusi: "3.7% dari seluruh penjualan IKEA", produkKurangLaku: "6 produk", lowStock: "4 produk", insight: "Tambah kursi anak multifungsi", toko: "IKEA Bali" },
    "Appliances": { totalProduk: 490, kontribusi: "3.2% dari seluruh penjualan IKEA", produkKurangLaku: "2 produk", lowStock: "1 produk", insight: "Highlight hemat energi", toko: "IKEA Sentul" },
    "Rugs": { totalProduk: 430, kontribusi: "2.9% dari seluruh penjualan IKEA", produkKurangLaku: "1 produk", lowStock: "3 produk", insight: "Diskon karpet rajut", toko: "IKEA Bandung" },
    "Curtains": { totalProduk: 390, kontribusi: "2.7% dari seluruh penjualan IKEA", produkKurangLaku: "2 produk", lowStock: "2 produk", insight: "Tingkatkan stok sheer curtain", toko: "IKEA Kota Baru" },
    "Tableware": { totalProduk: 320, kontribusi: "2.3% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "1 produk", insight: "Promo piring set", toko: "IKEA Alam Sutera" },
    "Cookware": { totalProduk: 280, kontribusi: "2.1% dari seluruh penjualan IKEA", produkKurangLaku: "2 produk", lowStock: "1 produk", insight: "Kolaborasi chef influencer", toko: "IKEA Jakarta Garden City" },
    "Laundry": { totalProduk: 240, kontribusi: "1.8% dari seluruh penjualan IKEA", produkKurangLaku: "3 produk", lowStock: "2 produk", insight: "Pasarkan keranjang lipat", toko: "IKEA Bandung" },
    "Cleaning": { totalProduk: 200, kontribusi: "1.5% dari seluruh penjualan IKEA", produkKurangLaku: "1 produk", lowStock: "1 produk", insight: "Gabung produk bundling pembersih", toko: "IKEA Surabaya" },
    "Pet": { totalProduk: 180, kontribusi: "1.2% dari seluruh penjualan IKEA", produkKurangLaku: "1 produk", lowStock: "1 produk", insight: "Tampilkan sofa hewan peliharaan", toko: "IKEA Kota Baru" }
  };

  const categoryData = [
    ["CAT-01", "Furniture", "Furnitur rumah", 1200, "01 Jan 2022", "Admin A", "19 Nov 2022", "Active", "product1.jpg", "-", 89],
    ["CAT-02", "Lighting", "Pencahayaan rumah modern", 800, "10 Jan 2022", "Admin B", "15 Nov 2022", "Inactive", "product2.jpg", "Furniture", 78],
    ["CAT-03", "Storage", "Lemari dan rak serbaguna", 950, "20 Jan 2022", "Admin C", "10 Nov 2022", "Pending", "product3.jpg", "Furniture", 70],
    ["CAT-04", "Bedroom", "Perlengkapan kamar tidur", 1000, "01 Feb 2022", "Admin D", "12 Nov 2022", "Active", "product4.jpg", "Furniture", 82],
    ["CAT-05", "Living Room", "Dekorasi dan sofa ruang tamu", 1100, "05 Feb 2022", "Admin E", "19 Nov 2022", "Pending", "product5.jpg", "Furniture", 85],
    ["CAT-06", "Kitchen", "Peralatan dapur modern", 700, "10 Feb 2022", "Admin F", "22 Nov 2022", "Active", "product6.jpg", "Dining", 68],
    ["CAT-07", "Dining", "Meja makan dan aksesoris", 600, "15 Feb 2022", "Admin G", "25 Nov 2022", "Ordered", "product7.jpg", "Kitchen", 62],
    ["CAT-08", "Office", "Furniture kantor fungsional", 550, "20 Feb 2022", "Admin H", "28 Nov 2022", "Active", "product1.jpg", "Furniture", 60],
    ["CAT-09", "Outdoor", "Furniture dan dekorasi luar ruangan", 400, "01 Mar 2022", "Admin I", "02 Dec 2022", "Pending", "product2.jpg", "Furniture", 58],
    ["CAT-10", "Textiles", "Tekstil dan karpet rumah", 650, "05 Mar 2022", "Admin J", "05 Dec 2022", "Pending", "product3.jpg", "Living Room", 66],
    ["CAT-11", "Decoration", "Hiasan dan ornamen", 300, "10 Mar 2022", "Admin K", "10 Dec 2022", "Active", "product4.jpg", "Living Room", 52],
    ["CAT-12", "Bathroom", "Perlengkapan kamar mandi", 480, "15 Mar 2022", "Admin L", "13 Dec 2022", "Pending", "product5.jpg", "-", 57],
    ["CAT-13", "Children", "Produk anak-anak", 500, "20 Mar 2022", "Admin M", "15 Dec 2022", "Active", "product6.jpg", "-", 59],
    ["CAT-14", "Appliances", "Peralatan rumah tangga", 320, "25 Mar 2022", "Admin N", "18 Dec 2022", "Ordered", "product7.jpg", "Kitchen", 49],
    ["CAT-15", "Rugs", "Karpet berbagai ukuran", 430, "01 Apr 2022", "Admin O", "20 Dec 2022", "Active", "product2.jpg", "Textiles", 53],
    ["CAT-16", "Curtains", "Gorden dan tirai rumah", 290, "05 Apr 2022", "Admin P", "23 Dec 2022", "Ordered", "product7.jpg", "Textiles", 47],
    ["CAT-17", "Tableware", "Peralatan makan", 510, "10 Apr 2022", "Admin Q", "26 Dec 2022", "Active", "product6.jpg", "Kitchen", 60],
    ["CAT-18", "Cookware", "Peralatan masak", 620, "15 Apr 2022", "Admin R", "29 Dec 2022", "Active", "product5.jpg", "Kitchen", 63],
    ["CAT-19", "Laundry", "Alat bantu cuci", 230, "20 Apr 2022", "Admin S", "02 Jan 2023", "Ordered", "product4.jpg", "Bathroom", 40],
    ["CAT-20", "Cleaning", "Produk kebersihan", 190, "25 Apr 2022", "Admin T", "04 Jan 2023", "Active", "product3.jpg", "Bathroom", 38],
    ["CAT-21", "Pet", "Produk untuk hewan peliharaan", 100, "30 Apr 2022", "Admin U", "07 Jan 2023", "Ordered", "product2.jpg", "-", 36]
  ];

  // --- NEW/ADAPTED JAVASCRIPT FOR DASHBOARD COMPONENTS ---

  // 1. Top 5 Categories with Highest Sales (Bar Chart)
  let barChartTopCategories;
  const barCtxTopCategories = document.getElementById('barChartTopCategories').getContext('2d');

  function calculateTopCategoriesSales(year) {
    const categorySales = {};
    kategoriList.forEach(kategori => {
      let totalSales = 0;
      if (dataTahun[year] && dataTahun[year][kategori]) {
        dataTahun[year][kategori].forEach(monthData => {
          totalSales += monthData.totalSold;
        });
      }
      categorySales[kategori] = totalSales;
    });

    const sortedCategories = Object.entries(categorySales)
      .sort(([, a], [, b]) => b - a)
      .slice(0, 5); // Get top 5

    return {
      labels: sortedCategories.map(item => item[0]),
      data: sortedCategories.map(item => item[1])
    };
  }

  function renderBarChartTopCategories(year) {
    const { labels, data } = calculateTopCategoriesSales(year);
    if (barChartTopCategories) barChartTopCategories.destroy();

    barChartTopCategories = new Chart(barCtxTopCategories, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Total Sales',
          data: data,
          backgroundColor: "#0d6efd"
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 1000,
          easing: 'easeOutQuart'
        },
        plugins: {
          legend: { display: false },
          tooltip: { mode: 'index', intersect: false,
            callbacks: {
                label: function(context) {
                    let label = context.dataset.label || '';
                    if (label) {
                        label += ': ';
                    }
                    if (context.parsed.y !== null) {
                        label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                    }
                    return label;
                }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: false,
            },
            ticks: {
                callback: function(value) {
                    if (value === 0) return 'Rp 0';
                    if (value >= 1000) return 'Rp ' + (value / 1000) + 'K';
                    return 'Rp ' + value;
                },
                color: "#666",
                font: { size: 12 }
            },
            grid: { color: "#eee" }
          },
          x: {
            ticks: { color: "#444", font: { size: 12 } },
            grid: { display: false }
          }
        }
      }
    });
  }

  document.getElementById("barChartYear").addEventListener("change", function() {
    renderBarChartTopCategories(this.value);
  });
  renderBarChartTopCategories(document.getElementById("barChartYear").value); // Initial render

  // 2. Category Contribution to Total Sales (Donut Chart)
  const donutCtxCategoryContribution = document.getElementById('donutChartCategoryContribution').getContext('2d');
  let donutChartCategoryContribution;

  function calculateCategoryContribution() {
    let totalOverallSales = 0;
    const categorySales = {};

    for (const year in dataTahun) {
      for (const category in dataTahun[year]) {
        if (!categorySales[category]) {
          categorySales[category] = 0;
        }
        dataTahun[year][category].forEach(monthData => {
          categorySales[category] += monthData.totalSold;
          totalOverallSales += monthData.totalSold;
        });
      }
    }

    const sortedCategories = Object.entries(categorySales)
      .sort(([, a], [, b]) => b - a);

    const top5Categories = sortedCategories.slice(0, 5);
    let otherSales = 0;
    for (let i = 5; i < sortedCategories.length; i++) {
      otherSales += sortedCategories[i][1];
    }

    const labels = top5Categories.map(item => `${item[0]} (${((item[1] / totalOverallSales) * 100).toFixed(0)}%)`);
    const data = top5Categories.map(item => (item[1] / totalOverallSales) * 100);

    if (otherSales > 0) {
      labels.push(`Lainnya (${((otherSales / totalOverallSales) * 100).toFixed(0)}%)`);
      data.push((otherSales / totalOverallSales) * 100);
    }

    const backgroundColors = [
      '#0d6efd', // Blue
      '#6c757d', // Gray
      '#198754', // Green
      '#ffc107', // Yellow
      '#dc3545', // Red
      '#6f42c1'  // Purple (for 'Lainnya')
    ];

    return { labels, data, backgroundColors };
  }

  const { labels, data, backgroundColors } = calculateCategoryContribution();

  donutChartCategoryContribution = new Chart(donutCtxCategoryContribution, {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [{
        label: 'Contribution',
        data: data,
        backgroundColor: backgroundColors,
        borderWidth: 1,
        hoverOffset: 12
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        animateRotate: true,
        animateScale: true,
        duration: 1200
      },
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            boxWidth: 12,
            color: '#333',
            font: { size: 12 }
          }
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              let label = context.label || '';
              if (label) {
                label += ': ';
              }
              if (context.parsed !== null) {
                label += context.parsed.toFixed(1) + '%';
              }
              return label;
            }
          }
        }
      },
      cutout: '70%', // Make it a donut chart
      elements: {
        center: { // Custom plugin to draw text in the center
          text: 'Total\n100%',
          color: '#333',
          fontStyle: 'Arial',
          sidePadding: 20,
          minFontSize: 12,
          lineHeight: 25
        }
      }
    },
    plugins: [{ // Plugin for center text
        id: 'centerText',
        beforeDraw: function(chart) {
            if (chart.options.elements.center) {
                const ctx = chart.ctx;
                const centerConfig = chart.options.elements.center;
                const fontStyle = centerConfig.fontStyle || 'Arial';
                const txt = centerConfig.text;
                const color = centerConfig.color || '#000';
                const sidePadding = centerConfig.sidePadding || 20;
                const sidePaddingCalculated = (centerConfig.sidePaddingCalculated || 0);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                const centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                const centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                ctx.font = "bold 16px " + fontStyle; // Adjust font size as needed
                ctx.fillStyle = color;

                const lines = txt.split('\n');
                const lineHeight = centerConfig.lineHeight || 20;
                let yOffset = centerY - ((lines.length - 1) * lineHeight / 2);

                lines.forEach(line => {
                    ctx.fillText(line, centerX, yOffset);
                    yOffset += lineHeight;
                });
            }
        }
    }]
  });

  // 3. Category Growth Trend (Top 5 Categories) - Line Chart
  let lineChartCategoryGrowth;
  const lineCtxCategoryGrowth = document.getElementById('lineChartCategoryGrowth').getContext('2d');

  function calculateCategoryGrowthTrend(year) {
    const labels = bulanShort.slice(0, 8); // Jan-Agu as per image
    const datasets = [];

    // Get top 5 categories based on total sales for the selected year
    const categorySalesForYear = {};
    kategoriList.forEach(kategori => {
        let totalSales = 0;
        if (dataTahun[year] && dataTahun[year][kategori]) {
            dataTahun[year][kategori].forEach(monthData => {
                totalSales += monthData.totalSold;
            });
        }
        categorySalesForYear[kategori] = totalSales;
    });

    const sortedCategories = Object.entries(categorySalesForYear)
        .sort(([, a], [, b]) => b - a)
        .slice(0, 5);

    const colors = ['#0d6efd', '#6c757d', '#198754', '#ffc107', '#dc3545']; // Matching image colors

    sortedCategories.forEach((item, index) => {
        const categoryName = item[0];
        const monthlyData = dataTahun[year][categoryName].slice(0, 8).map(d => d.totalSold); // Get data for Jan-Agu

        datasets.push({
            label: categoryName,
            data: monthlyData,
            borderColor: colors[index % colors.length],
            fill: false,
            tension: 0.4,
            pointRadius: 3,
            pointHoverRadius: 5,
        });
    });

    return {
      labels: labels,
      datasets: datasets
    };
  }

  function renderLineChartCategoryGrowth(year) {
    const { labels, datasets } = calculateCategoryGrowthTrend(year);
    if (lineChartCategoryGrowth) lineChartCategoryGrowth.destroy();

    lineChartCategoryGrowth = new Chart(lineCtxCategoryGrowth, {
      type: 'line',
      data: {
        labels: labels,
        datasets: datasets
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 1500,
          easing: 'easeOutQuart'
        },
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              boxWidth: 12,
              color: '#333',
              font: { size: 12 }
            }
          },
          tooltip: { mode: 'index', intersect: false }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: false,
            },
            ticks: {
                callback: function(value) {
                    if (value === 0) return '0';
                    if (value >= 1000) return (value / 1000) + 'K';
                    return value;
                },
                color: "#666",
                font: { size: 12 }
            },
            grid: { color: "#eee" }
          },
          x: {
            ticks: { color: "#444", font: { size: 12 } },
            grid: { display: false }
          }
        }
      }
    });
  }

  document.getElementById("lineChartYear").addEventListener("change", function() {
    renderLineChartCategoryGrowth(this.value);
  });
  renderLineChartCategoryGrowth(document.getElementById("lineChartYear").value); // Initial render

  // 4. Prediksi Penjualan Kategori per Bulan (adapted)
  const predictionCategorySelect = document.getElementById("predictionCategorySelect");
  kategoriList.forEach(kategori => {
    const option = document.createElement("option");
    option.value = kategori;
    option.textContent = kategori;
    predictionCategorySelect.appendChild(option);
  });

  function updatePredictionContent() {
    const selectedCategory = predictionCategorySelect.value;
    const predictionContentDiv = document.getElementById("predictionContent");

    // Get last month's data for the selected category for 2025
    const currentYearData = dataTahun["2025"] ? dataTahun["2025"][selectedCategory] : null;
    let lastMonthSales = 0;
    if (currentYearData && currentYearData.length > 0) {
        lastMonthSales = currentYearData[currentYearData.length - 1].totalSold;
    }

    // Simple prediction: 5% increase from last month's sales
    const predictedSales = Math.floor(lastMonthSales * 1.05);
    const accuracy = Math.floor(Math.random() * (95 - 80) + 80); // Random accuracy between 80-95%

    // Dummy comparison data (using lastMonthSales as base for consistency)
    const jul2025 = Math.floor(lastMonthSales * 0.98);
    const aug2024 = Math.floor(lastMonthSales * 0.90);

    let trendIcon = '<i class="fas fa-arrow-up"></i>';
    let trendClass = 'up';

    predictionContentDiv.innerHTML = `
        <div class="prediction-value">${selectedCategory}</div>
        <div class="prediction-detail">diprediksi terjual <strong>${predictedSales.toLocaleString('id-ID')}</strong> unit di Agustus 2025</div>
        <div class="prediction-detail">Akurasi prediksi:</div>
        <div class="progress mb-2" style="height: 8px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: ${accuracy}%;" aria-valuenow="${accuracy}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="prediction-detail mt-2">Bandingkan dengan<br/>Jul 2025: ${jul2025.toLocaleString('id-ID')} unit<br/>Agu 2024: ${aug2024.toLocaleString('id-ID')} unit</div>
        <div class="prediction-trend ${trendClass}">${trendIcon}</div>
    `;
  }
  predictionCategorySelect.addEventListener("change", updatePredictionContent);
  updatePredictionContent(); // Initial load

  // 5. Notifikasi Kritis Otomatis (adapted)
  function generateNotifications() {
    const notificationList = document.getElementById("notificationList");
    notificationList.innerHTML = "";

    // Example: Low Stock Notification (using notesMap)
    const lowStockCategories = kategoriList.filter(cat => notesMap[cat] && notesMap[cat].lowStock && parseInt(notesMap[cat].lowStock.match(/\d+/)[0]) > 0);
    if (lowStockCategories.length > 0) {
        const category = lowStockCategories[0]; // Just pick one for example
        const lowStockCount = notesMap[category].lowStock.match(/\d+/)[0];
        notificationList.innerHTML += `
            <li class="notification-item">
                <i class="fas fa-exclamation-triangle notification-icon text-danger"></i>
                <div class="notification-text">
                    <strong>${category} - Stok Tinggal ${lowStockCount} Produk</strong> <span class="status-label status-critical">Kritis</span><br/>Stok kritis, restock diperlukan segera
                </div>
            </li>
        `;
    }

    // Example: Less Popular Products Notification (using notesMap)
    const lessPopularCategories = kategoriList.filter(cat => notesMap[cat] && notesMap[cat].produkKurangLaku && parseInt(notesMap[cat].produkKurangLaku.match(/\d+/)[0]) > 0);
    if (lessPopularCategories.length > 0) {
        const category = lessPopularCategories[0]; // Just pick one for example
        const lessPopularCount = notesMap[category].produkKurangLaku.match(/\d+/)[0];
        notificationList.innerHTML += `
            <li class="notification-item">
                <i class="fas fa-exclamation-circle notification-icon text-warning"></i>
                <div class="notification-text">
                    <strong>${category} - ${lessPopularCount} Produk Kurang Laku</strong> <span class="status-label status-warning">Peringatan</span><br/>Evaluasi strategi pemasaran untuk produk ini.
                </div>
            </li>
        `;
    }

    // Generic notification (from original AI Insight, adapted to be generic)
    notificationList.innerHTML += `
        <li class="notification-item">
            <i class="fas fa-comment-dots notification-icon text-info"></i>
            <div class="notification-text">
                <strong>Keluhan Pelanggan - 8 Review Negatif Minggu Ini</strong> <span class="status-label status-info">Info</span><br/>Keluhan utama: kerusakan sudut saat pengiriman
            </div>
        </li>
    `;
  }
  generateNotifications(); // Initial load

  // 6. Health Score untuk Kategori (adapted)
  function generateHealthScores() {
    const healthScoreContent = document.getElementById("healthScoreContent");
    healthScoreContent.innerHTML = "";

    // Sort categories by popularity index (item[10]) from categoryData
    const sortedCategoriesByPopularity = [...categoryData].sort((a, b) => b[10] - a[10]);

    // Take top 2 for example
    const topCategory = sortedCategoriesByPopularity[0];
    const secondCategory = sortedCategoriesByPopularity[1];

    if (topCategory) {
        const score = topCategory[10]; // Popularity Index
        const scoreClass = score >= 80 ? 'high' : (score >= 60 ? 'medium' : 'low');
        const categoryNotes = notesMap[topCategory[1]]; // Get notes for this category
        healthScoreContent.innerHTML += `
            <div class="health-score-item">
                <span class="brand-name">${topCategory[1]}</span>
                <div class="score-bar"><div class="score-fill ${scoreClass}" style="width: ${score}%;"></div></div>
                <span class="score-value">${score}/100</span>
            </div>
            <p class="text-muted" style="font-size:12px; margin-top:-10px; margin-bottom:10px;">Stok stabil (95%), rating 4.7, restock normal</p>
        `;
    }
    if (secondCategory) {
        const score = secondCategory[10];
        const scoreClass = score >= 80 ? 'high' : (score >= 60 ? 'medium' : 'low');
        const categoryNotes = notesMap[secondCategory[1]]; // Get notes for this category
        healthScoreContent.innerHTML += `
            <div class="health-score-item">
                <span class="brand-name">${secondCategory[1]}</span>
                <div class="score-bar"><div class="score-fill ${scoreClass}" style="width: ${score}%;"></div></div>
                <span class="score-value">${score}/100</span>
            </div>
            <p class="text-muted" style="font-size:12px; margin-top:-10px;">Penurunan penjualan 15% MoM, rating turun ke 4.1</p>
        `;
    }
  }
  generateHealthScores(); // Initial load

  // 7. Category Readiness Index (adapted)
  const readinessCategorySelect = document.getElementById("readinessCategorySelect");
  kategoriList.forEach(kategori => {
    const option = document.createElement("option");
    option.value = kategori;
    option.textContent = kategori;
    readinessCategorySelect.appendChild(option);
  });

  // Readiness data based on categories
  const readinessData = {
    "Furniture": { percentage: 92, scoreText: "Promo-Ready Score", metrics: { stok: "Tinggi", rating: "4.6", stabilitas: "Stabil" } },
    "Lighting": { percentage: 85, scoreText: "Good for Campaign", metrics: { stok: "Sedang", rating: "4.2", stabilitas: "Cukup Stabil" } },
    "Storage": { percentage: 90, scoreText: "High Potential", metrics: { stok: "Tinggi", rating: "4.5", stabilitas: "Stabil" } },
    "Bedroom": { percentage: 88, scoreText: "Ready for Discount", metrics: { stok: "Tinggi", rating: "4.3", stabilitas: "Stabil" } },
    "Living Room": { percentage: 80, scoreText: "Needs Boost", metrics: { stok: "Sedang", rating: "3.9", stabilitas: "Berfluktuasi" } },
    "Kitchen": { percentage: 75, scoreText: "Needs Attention", metrics: { stok: "Rendah", rating: "3.8", stabilitas: "Berfluktuasi" } },
    "Dining": { percentage: 82, scoreText: "Stable Performance", metrics: { stok: "Sedang", rating: "4.0", stabilitas: "Stabil" } },
    "Office": { percentage: 70, scoreText: "Low Readiness", metrics: { stok: "Rendah", rating: "3.5", stabilitas: "Tidak Stabil" } },
    "Outdoor": { percentage: 65, scoreText: "High Risk", metrics: { stok: "Rendah", rating: "3.0", stabilitas: "Tidak Stabil" } },
    "Textiles": { percentage: 88, scoreText: "Good Potential", metrics: { stok: "Tinggi", rating: "4.4", stabilitas: "Stabil" } },
    "Decoration": { percentage: 78, scoreText: "Moderate Readiness", metrics: { stok: "Sedang", rating: "4.1", stabilitas: "Cukup Stabil" } },
    "Bathroom": { percentage: 72, scoreText: "Needs Improvement", metrics: { stok: "Rendah", rating: "3.7", stabilitas: "Berfluktuasi" } },
    "Children": { percentage: 80, scoreText: "Steady Growth", metrics: { stok: "Tinggi", rating: "4.2", stabilitas: "Stabil" } },
    "Appliances": { percentage: 68, scoreText: "High Risk", metrics: { stok: "Rendah", rating: "3.4", stabilitas: "Tidak Stabil" } },
    "Rugs": { percentage: 79, scoreText: "Moderate Potential", metrics: { stok: "Sedang", rating: "4.0", stabilitas: "Stabil" } },
    "Curtains": { percentage: 70, scoreText: "Needs Boost", metrics: { stok: "Rendah", rating: "3.6", stabilitas: "Berfluktuasi" } },
    "Tableware": { percentage: 85, scoreText: "Good Performance", metrics: { stok: "Tinggi", rating: "4.3", stabilitas: "Stabil" } },
    "Cookware": { percentage: 80, scoreText: "Steady Readiness", metrics: { stok: "Sedang", rating: "4.1", stabilitas: "Stabil" } },
    "Laundry": { percentage: 60, scoreText: "Low Readiness", metrics: { stok: "Rendah", rating: "3.2", stabilitas: "Tidak Stabil" } },
    "Cleaning": { percentage: 55, scoreText: "Critical Readiness", metrics: { stok: "Sangat Rendah", rating: "2.9", stabilitas: "Sangat Tidak Stabil" } },
    "Pet": { percentage: 62, scoreText: "Needs Development", metrics: { stok: "Rendah", rating: "3.1", stabilitas: "Berfluktuasi" } }
  };


  function updateReadinessContent() {
    const selectedCategory = readinessCategorySelect.value;
    const data = readinessData[selectedCategory] || readinessData["Furniture"]; // Default if not found
    const readinessContentDiv = document.getElementById("readinessContent");

    let stokIndicatorClass = '';
    if (data.metrics.stok === 'Tinggi') stokIndicatorClass = 'indicator-green';
    else if (data.metrics.stok === 'Sedang') stokIndicatorClass = 'indicator-orange';
    else stokIndicatorClass = 'indicator-blue'; // For 'Cukup Stabil' or others

    let stabilitasIndicatorClass = '';
    if (data.metrics.stabilitas === 'Stabil') stabilitasIndicatorClass = 'indicator-blue';
    else if (data.metrics.stabilitas === 'Cukup Stabil') stabilitasIndicatorClass = 'indicator-orange';
    else stabilitasIndicatorClass = 'indicator-red'; // For 'Berfluktuasi' or others

    readinessContentDiv.innerHTML = `
        <div class="percentage">${data.percentage}%</div>
        <div class="brand-name">${selectedCategory}</div>
        <div class="score-text">${data.scoreText}</div>
        <div class="brand-readiness-metrics">
            <div class="metric-item">
                <span class="metric-value"><span class="metric-indicator ${stokIndicatorClass}"></span>${data.metrics.stok}</span>
                <span class="metric-label">Stok</span>
            </div>
            <div class="metric-item">
                <span class="metric-value"><span class="metric-indicator indicator-orange"></span>Rating ${data.metrics.rating}</span>
                <span class="metric-label">Rating</span>
            </div>
            <div class="metric-item">
                <span class="metric-value"><span class="metric-indicator ${stabilitasIndicatorClass}"></span>${data.metrics.stabilitas}</span>
                <span class="metric-label">Stabilitas</span>
            </div>
        </div>
        <label class="promo-checkbox">
            <input type="checkbox" checked>
            Siap Promo Flash Sale
        </label>
    `;
  }
  readinessCategorySelect.addEventListener("change", updateReadinessContent);
  updateReadinessContent(); // Initial load

  // 8. Distribusi Lokasi Penjualan Terbanyak per Kategori (adapted)
  function generateLocationDistribution() {
    const locationDistributionContent = document.getElementById("locationDistributionContent");
    locationDistributionContent.innerHTML = "";

    // Use notesMap.toko for top seller (e.g., Furniture -> IKEA Alam Sutera)
    const topSellerCategory = kategoriList.find(cat => notesMap[cat] && notesMap[cat].toko === "IKEA Alam Sutera") || "Furniture"; // Default
    const topSellerLocations = ["Jakarta", "Surabaya", "Medan", "Bandung"]; // Static for visual match

    locationDistributionContent.innerHTML += `
        <div class="mb-3">
            <h5 class="mb-1">${topSellerCategory} <span class="badge bg-primary">Top Seller</span></h5>
            <p class="text-muted" style="font-size:13px;">Paling banyak terjual di:</p>
            <div class="d-flex flex-wrap gap-2">
                ${topSellerLocations.map(loc => `<span class="badge bg-primary">${loc}</span>`).join('')}
            </div>
        </div>
    `;

    // Dummy for rising star (e.g., Storage -> IKEA Kota Baru)
    const risingStarCategory = kategoriList.find(cat => notesMap[cat] && notesMap[cat].toko === "IKEA Kota Baru") || "Storage"; // Example
    const risingStarLocations = ["Bandung", "Yogyakarta", "Malang", "Denpasar"]; // Static for visual match
    locationDistributionContent.innerHTML += `
        <div>
            <h5 class="mb-1">${risingStarCategory} <span class="badge bg-success">Rising Star</span></h5>
            <p class="text-muted" style="font-size:13px;">Populer di:</p>
            <div class="d-flex flex-wrap gap-2">
                ${risingStarLocations.map(loc => `<span class="badge bg-primary">${loc}</span>`).join('')}
            </div>
        </div>
    `;
  }
  generateLocationDistribution(); // Initial load

  // 9. AI Suggestion: Produk Baru yang Potensial (adapted)
  function updateAISuggestion() {
    const aiSuggestionText = document.getElementById("aiSuggestionText");
    // Use insight from a specific category, or a generic one
    const furnitureInsight = notesMap["Furniture"] ? notesMap["Furniture"].insight : "Pertimbangkan menambahkan varian baru pada koleksi yang populer.";
    aiSuggestionText.textContent = `"Pencarian untuk 'rak dinding kayu minimalis' meningkat 45% dalam 3 bulan terakhir. Rekomendasi AI: ${furnitureInsight}"`;
  }
  updateAISuggestion(); // Initial load

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
    <script src="../assets/js/script.js"></script>
  </body>
</html>
