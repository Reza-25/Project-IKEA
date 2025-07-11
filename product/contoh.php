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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Export Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<style>
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

  style
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
/* END - CSS Kolom */

/* Custom CSS Variables */
:root {
  --primary-blue: #1976d2;
  --secondary-blue: #42a5f5;
  --success-green: #4caf50;
  --warning-orange: #ff9800;
  --danger-red: #f44336;
  --info-cyan: #00bcd4;
  --light-gray: #f5f5f5;
  --white: #ffffff;
  --text-dark: #333333;
  --border-color: #e0e0e0;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f8f9fa;
  color: var(--text-dark);
  line-height: 1.6;
  padding: 10px;
}

a {
  text-decoration: none !important;
}

.main-wrapper {
  background-color: #f8f9fa;
  min-height: 100vh;
}

.content {
  padding: 20px;
  max-width: 1400px;
  margin: 0 auto;
}

/* Page Header */
.page-header {
  background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
  border-radius: 12px;
  padding: 12px 15px;
  color: white;
  margin-bottom: 15px;
  box-shadow: 0 3px 8px rgba(13, 71, 161, 0.15);
}

.page-header .page-title h4 {
  font-size: 1.3rem !important;
  margin-bottom: 5px;
  font-weight: 600;
}

.page-header .page-title h6 {
  font-size: 0.85rem !important;
  opacity: 0.9;
  margin-bottom: 0;
}

.page-header .page-btn .btn {
  background: rgba(255, 255, 255, 0.2);
  border: 1px solid rgba(255, 255, 255, 0.3);
  color: white;
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 0.9rem;
  transition: all 0.3s ease;
}

.page-header .page-btn .btn:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
}

/* Stats Cards */
.dash-count {
  background: var(--white);
  border-radius: 12px;
  padding: 15px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  display: flex;
  justify-content: space-between;
  align-items: center;
  min-height: 80px;
  margin-bottom: 15px;
  border-left: 4px solid transparent;
}

.dash-count:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  background-color: #f8f9fa;
}

.das1 { border-left-color: #1a5ea7; }
.das2 { border-left-color: #751e8d; }
.das3 { border-left-color: #e78001; }
.das4 { border-left-color: #018679; }

.das1 .dash-counts h4, .das1 .dash-counts h5 { color: #1a5ea7 !important; }
.das2 .dash-counts h4, .das2 .dash-counts h5 { color: #751e8d !important; }
.das3 .dash-counts h4, .das3 .dash-counts h5 { color: #e78001 !important; }
.das4 .dash-counts h4, .das4 .dash-counts h5 { color: #018679 !important; }

.dash-counts h4 {
  font-size: 18px;
  margin-bottom: 3px;
  font-weight: bold;
}

.dash-counts h5 {
  font-size: 12px;
  margin: 0;
}

.stat-change {
  font-size: 10px;
  font-weight: normal;
  margin-top: 2px;
  color: #6c757d;
  background: rgba(40, 167, 69, 0.1);
  color: #28a745;
  display: inline-block;
  padding: 2px 4px;
  border-radius: 8px;
  font-weight: 600;
}

.icon-box {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(33, 150, 243, 0.15);
  transition: box-shadow 0.2s, transform 0.2s;
  cursor: pointer;
}

.icon-box i {
  color: #ffffff !important;
  font-size: 14px;
}

.icon-box:hover {
  box-shadow: 0 3px 8px rgba(0,0,0,0.15);
  transform: scale(1.05);
}

.bg-ungu { background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%); }
.bg-biru { background: linear-gradient(135deg, #a259c6 0%, #6d28d9 100%); }
.bg-hijau { background: linear-gradient(135deg,rgb(89, 236, 222) 0%, #018679 100%); }
.bg-merah { background: linear-gradient(135deg, #ff5858 0%, #e78001 100%); }

/* Chart Section */
.chart-section {
  background: var(--white);
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 25px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.chart-section:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.chart-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--primary-blue);
  margin: 0;
}

.chart-select {
  border: 1px solid var(--border-color);
  border-radius: 6px;
  padding: 6px 12px;
  background: var(--white);
  font-size: 0.9rem;
  color: var(--text-dark);
}

.chart-select:focus {
  outline: none;
  border-color: var(--primary-blue);
  box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.2);
}

/* Insight Container */
.insight-container {
  padding: 15px;
  background: linear-gradient(135deg, #f0f8ff 0%, #e6f3ff 100%);
  border-top: 1px solid rgba(25, 118, 210, 0.1);
  border-radius: 0 0 12px 12px;
  font-size: 0.85rem;
  margin-top: 20px;
}

.insight-container h5 {
  color: var(--primary-blue) !important;
  font-weight: 600;
}

.insight-container p {
  color: #4a5568;
  line-height: 1.5;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 12px;
  margin-bottom: 15px;
}

.stats-card {
  background: var(--white);
  padding: 15px;
  text-align: center;
  border-radius: 12px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  margin-bottom: 12px;
  transition: all 0.3s ease;
  min-height: 120px;
}

.stats-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.stats-card i {
  font-size: 1.8rem;
  margin-bottom: 8px;
}

.stats-card h3 {
  font-size: 1.2rem;
  font-weight: 700;
  margin: 6px 0;
}

.stats-card p {
  color: #6c757d;
  margin-bottom: 0;
  font-size: 0.8rem;
}

/* Insight Cards */
.insight-card {
  background: var(--white);
  border-radius: 12px;
  padding: 15px;
  margin-bottom: 15px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.insight-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.insight-card-header {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  gap: 8px;
}

.insight-card-header i {
  font-size: 1.2rem;
  color: var(--primary-blue);
}

.insight-card-header h4 {
  font-size: 1rem !important;
  margin: 0;
  font-weight: 600;
}

/* Notification Cards */
.notification-card {
  padding: 12px;
  border-radius: 8px;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
  transition: all 0.3s ease;
  border-left: 4px solid transparent;
}

.notification-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
}

.notification-card i {
  font-size: 1.1rem;
  min-width: 24px;
  text-align: center;
}

.notification-card.warning {
  background-color: #fefbf3;
  border-left-color: #d97706;
}

.notification-card.danger {
  background-color: #fef2f2;
  border-left-color: #dc2626;
}

.notification-card.info {
  background-color: #f0f9ff;
  border-left-color: #0ea5e9;
}

.notification-card h5 {
  font-size: 0.9rem;
  margin-bottom: 2px;
  font-weight: 600;
}

.notification-card p {
  font-size: 0.8rem;
  margin-bottom: 0;
  color: #6b7280;
}

/* Sidebar Cards */
.sidebar-card {
  background: var(--white);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  margin-bottom: 15px;
  transition: all 0.3s ease;
}

.sidebar-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.sidebar-card-header {
  background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
  color: white;
  padding: 12px 15px;
  font-weight: 600;
  font-size: 0.9rem;
}

.sidebar-card-body {
  padding: 15px;
}

/* Professional Health Score */
.health-score-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 0;
  border-bottom: 1px solid #f1f5f9;
}

.health-score-item:last-child {
  border-bottom: none;
}

.health-brand-info h6 {
  font-size: 0.95rem;
  font-weight: 600;
  margin-bottom: 4px;
  color: #1e293b;
}

.health-brand-info p {
  font-size: 0.8rem;
  color: #64748b;
  margin-bottom: 0;
}

.health-score-value {
  text-align: right;
}

.health-score {
  font-size: 1.1rem;
  font-weight: 700;
  margin-bottom: 4px;
}

.health-score.good { color: #059669; }
.health-score.poor { color: #dc2626; }

.health-progress {
  width: 60px;
  height: 4px;
  background: #e2e8f0;
  border-radius: 2px;
  overflow: hidden;
}

.health-fill {
  height: 100%;
  border-radius: 2px;
  transition: width 1.5s ease-out;
}

.health-fill.good { background: #059669; }
.health-fill.poor { background: #dc2626; }

/* Compact Brand Readiness */
.readiness-compact {
  background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
  border: 1px solid rgba(14, 165, 233, 0.2);
  border-radius: 10px;
  padding: 15px;
  text-align: center;
}

.readiness-score-compact {
  font-size: 2rem;
  font-weight: 800;
  color: #0ea5e9;
  margin-bottom: 5px;
}

.readiness-brand-compact {
  font-size: 1rem;
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 3px;
}

.readiness-label-compact {
  font-size: 0.75rem;
  color: #64748b;
  margin-bottom: 12px;
}

.readiness-features-compact {
  display: flex;
  justify-content: space-around;
  margin: 12px 0;
}

.readiness-feature-compact {
  text-align: center;
  flex: 1;
}

.readiness-feature-compact i {
  font-size: 1.2rem;
  margin-bottom: 4px;
  display: block;
}

.readiness-feature-compact p {
  font-size: 0.7rem;
  font-weight: 600;
  margin-bottom: 0;
  color: #374151;
}

.readiness-progress-compact {
  height: 4px;
  background: #e2e8f0;
  border-radius: 2px;
  overflow: hidden;
  margin: 10px 0;
}

.readiness-fill-compact {
  height: 100%;
  background: linear-gradient(90deg, #0ea5e9 0%, #0284c7 100%);
  border-radius: 2px;
  transition: width 2s ease-out;
}

.readiness-status-compact {
  background: rgba(14, 165, 233, 0.1);
  color: #0c4a6e;
  padding: 6px 10px;
  border-radius: 15px;
  font-size: 0.7rem;
  font-weight: 600;
  display: inline-block;
}

/* Professional Location Distribution */
.location-brand-section {
  margin-bottom: 20px;
  padding: 15px;
  background: #fafbfc;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
}

.location-brand-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.location-brand-name {
  font-size: 1rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0;
}

.location-status-badge {
  font-size: 0.7rem;
  padding: 3px 8px;
  border-radius: 12px;
  font-weight: 600;
}

.location-status-badge.top { background: #dbeafe; color: #1e40af; }
.location-status-badge.rising { background: #d1fae5; color: #065f46; }

.location-description {
  font-size: 0.8rem;
  color: #6b7280;
  margin-bottom: 10px;
}

.location-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
}

.location-tag {
  background: #e5e7eb;
  color: #374151;
  padding: 4px 10px;
  border-radius: 15px;
  font-size: 0.75rem;
  font-weight: 500;
  transition: all 0.2s ease;
}

.location-tag.highlight {
  background: #3b82f6;
  color: white;
}

.location-tag:hover {
  transform: translateY(-1px);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Donut Legend */
.donut-legend {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 8px;
  margin-top: 15px;
}

.legend-item {
  display: flex;
  align-items: center;
  font-size: 0.8rem;
  color: #4b5563;
}

.legend-color {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 6px;
}

/* Enhanced Brand Data Table - Extended Width and Blue Gradient Headers */
.brand-table-section {
  background: var(--white);
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 25px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
  transition: all 0.3s ease;
}

.brand-table-section:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

/* Table Controls */
.table-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  flex-wrap: wrap;
  gap: 15px;
}

.search-container {
  position: relative;
  flex: 1;
  max-width: 300px;
}

.search-input {
  width: 100%;
  padding: 10px 40px 10px 15px;
  border: 2px solid #e2e8f0;
  border-radius: 8px;
  font-size: 0.9rem;
  transition: all 0.3s ease;
}

.search-input:focus {
  outline: none;
  border-color: var(--primary-blue);
  box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
}

.search-icon {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #64748b;
  font-size: 1rem;
}

.export-buttons {
  display: flex;
  gap: 10px;
}

.export-btn {
  padding: 8px 16px;
  border: 2px solid transparent;
  border-radius: 8px;
  font-size: 0.85rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 6px;
}

.export-btn.pdf {
  background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
  color: white;
}

.export-btn.pdf:hover {
  background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.export-btn.excel {
  background: linear-gradient(135deg, #059669 0%, #10b981 100%);
  color: white;
}

.export-btn.excel:hover {
  background: linear-gradient(135deg, #047857 0%, #059669 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}

.brand-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}

.brand-table th {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: #ffffff;
  font-weight: 600;
  font-size: 0.85rem;
  padding: 12px 10px;
  text-align: left;
  border-bottom: 2px solid #1565c0;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.brand-table th:first-child {
  border-top-left-radius: 8px;
}

.brand-table th:last-child {
  border-top-right-radius: 8px;
}

.brand-table td {
  padding: 12px 10px;
  border-bottom: 1px solid #f1f5f9;
  font-size: 0.85rem;
  color: #374151;
  vertical-align: middle;
}

.brand-table tbody tr:hover {
  background-color: #f8fafc;
  transition: all 0.2s ease;
}

.brand-name {
  font-weight: 600;
  color: #1e293b;
}

.brand-id {
  background: #f1f5f9;
  color: #475569;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 0.75rem;
  font-weight: 500;
  display: inline-block;
  font-family: 'Courier New', monospace;
}

.brand-category {
  background: #f8fafc;
  color: #64748b;
  padding: 4px 10px;
  border-radius: 15px;
  font-size: 0.75rem;
  font-weight: 500;
  display: inline-block;
  border: 1px solid #e2e8f0;
}

.brand-rating {
  display: flex;
  align-items: center;
  gap: 4px;
}

.brand-rating .stars {
  color: #fbbf24;
}

.brand-rating-value {
  color: #1e293b;
  font-weight: 600;
}

.brand-sales {
  font-weight: 600;
  color: #059669;
}

.brand-price {
  font-weight: 600;
  color: #1e293b;
}

.brand-status {
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.7rem;
  font-weight: 600;
  text-align: center;
}

.status-active { background: #d1fae5; color: #065f46; }
.status-trending { background: #fef3c7; color: #92400e; }
.status-stable { background: #dbeafe; color: #1e40af; }

/* No Results Message */
.no-results {
  text-align: center;
  padding: 40px 20px;
  color: #64748b;
}

.no-results i {
  font-size: 3rem;
  margin-bottom: 15px;
  color: #cbd5e1;
}

.no-results h5 {
  font-size: 1.1rem;
  margin-bottom: 8px;
  color: #475569;
}

.no-results p {
  font-size: 0.9rem;
  margin-bottom: 0;
}

/* Pagination */
.table-pagination {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
  padding-top: 15px;
  border-top: 1px solid #e2e8f0;
}

.pagination-info {
  font-size: 0.85rem;
  color: #64748b;
}

.pagination-controls {
  display: flex;
  gap: 8px;
}

.pagination-btn {
  padding: 6px 12px;
  border: 1px solid #d1d5db;
  background: white;
  color: #374151;
  border-radius: 6px;
  font-size: 0.8rem;
  cursor: pointer;
  transition: all 0.2s ease;
}

.pagination-btn:hover {
  background: #f3f4f6;
  border-color: #9ca3af;
}

.pagination-btn.active {
  background: #3b82f6;
  color: white;
  border-color: #3b82f6;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Suggestion Card */
.suggestion-card {
  background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
  color: white;
  border-radius: 10px;
  padding: 15px;
  margin-bottom: 12px;
  transition: all 0.3s ease;
}

.suggestion-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

/* Responsive */
@media (max-width: 768px) {
  .content {
    padding: 15px;
  }
  
  .chart-header {
    flex-direction: column;
    gap: 10px;
    text-align: center;
  }
  
  .table-controls {
    flex-direction: column;
    align-items: stretch;
  }
  
  .search-container {
    max-width: 100%;
  }
  
  .export-buttons {
    justify-content: center;
  }
  
  .dash-count {
    min-height: 70px;
    padding: 12px;
  }
  
  .dash-counts h4 {
    font-size: 16px;
  }
  
  .dash-counts h5 {
    font-size: 11px;
  }
  
  .icon-box {
    width: 32px;
    height: 32px;
  }
  
  .icon-box i {
    font-size: 12px;
  }
  
  .stats-grid {
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 10px;
  }
  
  .brand-table {
    font-size: 0.75rem;
  }
  
  .brand-table th,
  .brand-table td {
    padding: 12px 8px;
  }
  
  .table-stats {
    flex-direction: column;
    gap: 8px;
  }
  
  .pagination-controls {
    flex-wrap: wrap;
    gap: 6px;
  }
  
  .pagination-btn {
    padding: 8px 12px;
    font-size: 0.8rem;
  }
}

/* Loading Animation */
#global-loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.whirly-loader {
  width: 50px;
  height: 50px;
  border: 4px solid #f3f3f3;
  border-top: 4px solid var(--primary-blue);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.trend-indicator {
  font-size: 1rem;
  display: inline-block;
  margin-left: 4px;
}

.trend-up {
  color: var(--success-green);
}

.trend-down {
  color: var(--danger-red);
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
  <div class="content">
    <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
  <div class="page-header">
      <div class="page-title">
        <h4>Product Category list</h4>
        <h6>View/Search product Category</h6>
      </div>
      <div class="page-btn">
        <a href="addcategory.php" class="btn btn-added">
          <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
        </a>
      </div>
    </div>

    <!-- Revenue, Suppliers, Product Sold, Budget Spent -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4>$<span class="counters" data-count="385656.50">385,656.50</span></h4>
                    <h5>Total Product Sold</h5>
                    <h2 class="stat-change">+9% from last year</h2>
                    </div>
                    <div class="icon-box bg-ungu">
                      <i class="fa fa-box"></i>
                    </div>
                </div>
              </a>
            </div>

            <!-- Most Popular Category -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="people/supplierlist.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das2">
                  <div class="dash-counts">
                    <h4>Furniture</h4>
                    <h5>Top Category</h5>
                  <h2 class="stat-change">+9% from last year</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-couch"></i>
                </div>
                </div>
              </a>
            </div>

            <!-- Top-Selling Product -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="product/productsold.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das3">
                  <div class="dash-counts">
                    <h4>Sofa KVK</span></h4>
                    <h5>Top-Selling Product</h5>
                    <h2 class="stat-change">+15% from last year</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-trophy"></i>
                  </div>
                </div>
              </a>
            </div>

            <!-- Average Product Sales -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="expense/expensecategory.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                    <h4>$<span class="counters" data-count="185556.30">185,556.30</span></h4>
                    <h5>Avg. Product Sales</h5>
                   <h2 class="stat-change">+6% from last year</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

    <!-- Dashboard Container -->
    <div class="dashboard-container">
      <!-- Stats Grid -->
      <div class="stats-grid">
        <div class="stats-card">
          <i class="fas fa-boxes text-primary"></i>
          <h3>12 Brand</h3>
          <p>Total brand aktif</p>
        </div>
        <div class="stats-card">
          <i class="fas fa-money-bill-wave text-success"></i>
          <h3>Rp 385 M</h3>
          <p>Total penjualan Q2 2025</p>
        </div>
        <div class="stats-card">
          <i class="fas fa-star text-warning"></i>
          <h3>4.6 <span class="trend-indicator trend-up">▲</span></h3>
          <p>Rata-rata rating brand</p>
        </div>
        <div class="stats-card">
          <i class="fas fa-sync-alt text-info"></i>
          <h3>24 <span class="trend-indicator trend-down">▼</span></h3>
          <p>Restock bulan ini</p>
        </div>
      </div>

      <!-- Main Content -->
      <div class="row">
        <!-- Left Column - Charts - Extended Width -->
        <div class="col-lg-12">
          <!-- Charts Section dalam row terpisah -->
          <div class="row mb-4">
            <div class="col-lg-8">
              <!-- Bar Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Top 5 Brands with Highest Sales</h5>
                  <select class="chart-select" id="barChartYear">
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
                <div id="barChart" style="height: 250px;"></div>
                <div class="insight-container" id="barChartInsight">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Dominasi Brand LACK</h5>
                      <p class="mb-0">Brand LACK mendominasi penjualan dengan kontribusi 28% dari total revenue. Penjualan tertinggi di Q2 karena program promo "Summer Refresh".</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Donut Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-pie me-2"></i>Brand Contribution to Total Sales</h5>
                </div>
                <div id="donutChart" style="height: 200px;"></div>
                <div class="donut-legend" id="donutLegend"></div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-info me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Distribusi Merata</h5>
                      <p class="mb-0">Top 5 brand menyumbang 72% total penjualan. Brand SKÅDIS menunjukkan peningkatan kontribusi terbesar (+5% YoY).</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Line Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-line me-2"></i>Brand Growth Trend (Top 5 Brands)</h5>
                  <select class="chart-select" id="lineChartYear">
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
                <div id="lineChart" style="height: 250px;"></div>
                <div class="insight-container" id="lineChartInsight">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-primary me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 id="lineChartInsightTitle" style="font-size: 0.9rem;">Insight: Tren Brand LACK</h5>
                      <p class="mb-0" id="lineChartInsightText">Brand LACK menunjukkan pertumbuhan stabil dengan peningkatan 8% QoQ. Penurunan kecil di bulan Juni karena masalah stok.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Insight Produk Bersaing -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chess-board me-2"></i>Insight "Produk Bersaing" Antar Brand</h5>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%); border-radius: 10px; border: 1px solid rgba(25, 118, 210, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: var(--primary-blue); font-weight: 600;">SKÅDIS vs VARIERA</h6>
                        <span style="background: var(--primary-blue); color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">Organizer</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #b8860b;">
                            <i class="fas fa-crown" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">SKÅDIS</h6>
                          <small style="font-size: 0.7rem; color: #666;">4.6⭐ | Rp 299K | 1.240/bln</small>
                        </div>
                        <div style="margin: 0 10px;">
                          <div style="width: 25px; height: 25px; background: var(--danger-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; font-weight: 700;">VS</div>
                        </div>
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #666;">
                            <i class="fas fa-medal" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">VARIERA</h6>
                          <small style="font-size: 0.7rem; color: #666;">4.3⭐ | Rp 249K | 1.050/bln</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%); border-radius: 10px; border: 1px solid rgba(25, 118, 210, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: var(--primary-blue); font-weight: 600;">LACK vs HEMNES</h6>
                        <span style="background: var(--primary-blue); color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">Furniture</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #b8860b;">
                            <i class="fas fa-crown" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">LACK</h6>
                          <small style="font-size: 0.7rem; color: #666;">4.5⭐ | Rp 199K | 1.850/bln</small>
                        </div>
                        <div style="margin: 0 10px;">
                          <div style="width: 25px; height: 25px; background: var(--danger-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; font-weight: 700;">VS</div>
                        </div>
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #666;">
                            <i class="fas fa-medal" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">HEMNES</h6>
                          <small style="font-size: 0.7rem; color: #666;">4.7⭐ | Rp 599K | 1.420/bln</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-info me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Kompetisi Brand</h5>
                      <p class="mb-0">SKÅDIS unggul di rating dan penjualan, sementara VARIERA unggul di harga. LACK mendominasi dengan volume penjualan tertinggi meski HEMNES memiliki rating terbaik.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Column - Sidebar tetap di samping charts -->
            <div class="col-lg-4">
              <!-- Prediksi Penjualan -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-calculator me-2"></i>Prediksi Penjualan Brand per Bulan
                </div>
                <div class="sidebar-card-body">
                  <div class="d-flex align-items-center mb-2">
                    <div class="bg-light p-2 rounded-circle me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-chart-line text-primary" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                      <h5 class="mb-1" style="font-size: 1rem;">LACK</h5>
                      <p class="mb-0" style="font-size: 0.85rem;">diprediksi terjual <span class="fw-bold">2.100 unit</span> di Agustus 2025</p>
                    </div>
                    <div class="ms-auto">
                      <span class="trend-indicator trend-up" style="font-size: 1.5rem;">▲</span>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Akurasi prediksi:</p>
                      <div class="progress" style="height: 6px; width: 100px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <span class="fw-bold" style="font-size: 0.8rem;">88%</span>
                    </div>
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Bandingkan dengan:</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Jul 2025: 1.950 unit</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Ags 2024: 1.820 unit</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Notifikasi Kritis -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bell me-2"></i>Notifikasi Kritis Otomatis
                </div>
                <div class="sidebar-card-body">
                  <div class="notification-card warning">
                    <i class="fas fa-exclamation-triangle text-warning"></i>
                    <div>
                      <h5 class="mb-1">LACK - Stok Tinggal 6 Unit</h5>
                      <p class="mb-0">Stok kritis, restock diperlukan segera</p>
                    </div>
                  </div>
                  
                  <div class="notification-card danger">
                    <i class="fas fa-sync-alt text-danger"></i>
                    <div>
                      <h5 class="mb-1">SKÅDIS - 4x Restock dalam 30 Hari</h5>
                      <p class="mb-0">Permintaan melonjak 45% dari bulan lalu</p>
                    </div>
                  </div>
                  
                  <div class="notification-card info">
                    <i class="fas fa-thumbs-down text-info"></i>
                    <div>
                      <h5 class="mb-1">VITTSJÖ - 8 Review Negatif Minggu Ini</h5>
                      <p class="mb-0">Keluhan utama: kerusakan sudut saat pengiriman</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Health Score -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-heartbeat me-2"></i>Health Score untuk Brand
                </div>
                <div class="sidebar-card-body">
                  <div class="health-score-item">
                    <div class="health-brand-info">
                      <h6>HEMNES</h6>
                      <p>Stok stabil (95%), rating 4.7, restock normal</p>
                    </div>
                    <div class="health-score-value">
                      <div class="health-score good">87/100</div>
                      <div class="health-progress">
                        <div class="health-fill good" style="width: 87%"></div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="health-score-item">
                    <div class="health-brand-info">
                      <h6>FJÄLLBO</h6>
                      <p>Penurunan penjualan 15% MoM, rating turun ke 4.1</p>
                    </div>
                    <div class="health-score-value">
                      <div class="health-score poor">62/100</div>
                      <div class="health-progress">
                        <div class="health-fill poor" style="width: 62%"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Compact Brand Readiness -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bolt me-2"></i>Brand Readiness Index
                </div>
                <div class="sidebar-card-body">
                  <div class="readiness-compact">
                    <div class="readiness-score-compact">92%</div>
                    <div class="readiness-brand-compact">KALLAX</div>
                    <div class="readiness-label-compact">Promo-Ready Score</div>
                    
                    <div class="readiness-features-compact">
                      <div class="readiness-feature-compact">
                        <i class="fas fa-box-open text-success"></i>
                        <p>Stok Tinggi</p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-star text-warning"></i>
                        <p>Rating 4.6</p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-chart-line text-primary"></i>
                        <p>Stabil</p>
                      </div>
                    </div>
                    
                    <div class="readiness-progress-compact">
                      <div class="readiness-fill-compact" style="width: 92%"></div>
                    </div>
                    
                    <div class="readiness-status-compact">
                      ✓ Siap Promo Flash Sale
                    </div>
                  </div>
                </div>
              </div>

              <!-- Distribusi Lokasi -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-map-marker-alt me-2"></i>Distribusi Lokasi Penjualan Terbanyak
                </div>
                <div class="sidebar-card-body">
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name">HEMNES</h6>
                      <span class="location-status-badge top">Top Seller</span>
                    </div>
                    <p class="location-description">Paling banyak terjual di:</p>
                    <div class="location-tags">
                      <span class="location-tag highlight">Jakarta</span>
                      <span class="location-tag">Surabaya</span>
                      <span class="location-tag">Medan</span>
                      <span class="location-tag">Bandung</span>
                    </div>
                  </div>
                  
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name">SKÅDIS</h6>
                      <span class="location-status-badge rising">Rising Star</span>
                    </div>
                    <p class="location-description">Populer di:</p>
                    <div class="location-tags">
                      <span class="location-tag">Bandung</span>
                      <span class="location-tag highlight">Yogyakarta</span>
                      <span class="location-tag">Malang</span>
                      <span class="location-tag">Denpasar</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- AI Suggestion -->
              <div class="suggestion-card">
                <div class="insight-card-header">
                  <i class="fas fa-brain text-white"></i>
                  <h4 class="mb-0 text-white">AI Suggestion: Produk Baru yang Potensial</h4>
                </div>
                <p class="mb-0" style="font-size: 0.85rem;">"Pencarian untuk 'rak dinding kayu minimalis' meningkat 45% dalam 3 bulan terakhir. Pertimbangkan menambahkan varian ini di koleksi LACK."</p>
              </div>
            </div>
          </div>

          <!-- Enhanced Brand Data Table - Full Width Professional with Search & Export -->
          <div class="brand-table-section">
            <div class="chart-header">
              <h5 class="chart-title"><i class="fas fa-table me-2"></i>Data Brand IKEA</h5>
              <div class="d-flex align-items-center gap-2">
                <span style="font-size: 0.8rem; color: #64748b;" id="totalBrandsText">Total: 12 brands</span>
              </div>
            </div>
            
            <!-- Table Controls -->
            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Cari brand, kategori, atau status...">
                <i class="fas fa-search search-icon"></i>
              </div>
              <div class="export-buttons">
                <button class="export-btn pdf" onclick="exportToPDF()">
                  <i class="fas fa-file-pdf"></i>
                  Export PDF
                </button>
                <button class="export-btn excel" onclick="exportToExcel()">
                  <i class="fas fa-file-excel"></i>
                  Export Excel
                </button>
              </div>
            </div>
            
            <table class="brand-table" id="brandTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Brand</th>
                  <th>Brand</th>
                  <th>Kategori</th>
                  <th>Rating</th>
                  <th>Penjualan/Bulan</th>
                  <th>Harga Rata-rata</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="brandTableBody">
                <!-- Data akan diisi oleh JavaScript -->
              </tbody>
            </table>
            
            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display: none;">
              <i class="fas fa-search"></i>
              <h5>Tidak ada data yang ditemukan</h5>
              <p>Coba ubah kata kunci pencarian Anda</p>
            </div>
            
            <div class="table-pagination" id="tablePagination">
              <div class="pagination-info" id="paginationInfo">
                Menampilkan 1-4 dari 12 brand
              </div>
              <div class="pagination-controls">
                <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                  <i class="fas fa-chevron-left"></i> Prev
                </button>
                <button class="pagination-btn active" id="page1Btn" onclick="goToPage(1)">1</button>
                <button class="pagination-btn" id="page2Btn" onclick="goToPage(2)">2</button>
                <button class="pagination-btn"  id="page3Btn" onclick="goToPage(3)">3</button>
                <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">
                  Next <i class="fas fa-chevron-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Data dummy untuk visualisasi - MENGGUNAKAN DATA ASLI DARI FILE ORIGINAL
const barChartData = {
  2025: {
    brands: ["LACK", "SKÅDIS", "HEMNES", "KALLAX", "VITTSJÖ"],
    sales: [385, 315, 280, 265, 240], // dalam juta
    insights: {
      "LACK": "Brand LACK mendominasi penjualan dengan kontribusi 28% dari total revenue. Penjualan tertinggi di Q2 karena program promo 'Summer Refresh'.",
      "SKÅDIS": "Brand SKÅDIS menunjukkan pertumbuhan pesat dengan peningkatan 18% YoY, terutama karena produk organizer yang populer di kalangan urban.",
      "HEMNES": "HEMNES tetap menjadi favorit dengan penjualan stabil. Koleksi kayu solidnya masih menjadi pilihan utama konsumen kelas menengah atas.",
      "KALLAX": "KALLAX mengalami peningkatan 5% di kuartal ini setelah peluncuran varian warna baru yang lebih modern.",
      "VITTSJÖ": "VITTSJÖ menunjukkan potensi dengan peningkatan penjualan di segmen furniture logam, terutama untuk ruang kerja."
    }
  },
  2024: {
    brands: ["HEMNES", "LACK", "KALLAX", "SKÅDIS", "VITTSJÖ"],
    sales: [325, 310, 290, 275, 220],
    insights: {
      "HEMNES": "HEMNES menjadi brand terlaris di tahun 2024 dengan koleksi kayu solidnya yang tahan lama dan desain klasik.",
      "LACK": "LACK tetap menjadi favorit dengan harga terjangkau, meskipun sempat mengalami penurunan stok di Q3.",
      "KALLAX": "KALLAX menunjukkan kinerja konsisten dengan sistem penyimpanan modular yang fleksibel.",
      "SKÅDIS": "SKÅDIS mulai menunjukkan potensi dengan peningkatan 12% di paruh kedua tahun 2024.",
      "VITTSJÖ": "VITTSJÖ mulai dikenal di pasar dengan desain industrial yang minimalis."
    }
  },
  2023: {
    brands: ["KALLAX", "HEMNES", "LACK", "VITTSJÖ", "SKÅDIS"],
    sales: [295, 285, 265, 240, 210],
    insights: {
      "KALLAX": "KALLAX mendominasi penjualan di 2023 dengan sistem penyimpanan modular yang sangat populer.",
      "HEMNES": "HEMNES tetap menjadi pilihan utama untuk furniture kayu berkualitas dengan desain timeless.",
      "LACK": "LACK mulai dikenal sebagai brand dengan harga terjangkau dan desain modern.",
      "VITTSJÖ": "VITTSJÖ baru memasuki pasar dengan koleksi furniture logam industrial.",
      "SKÅDIS": "SKÅDIS masih dalam tahap pengenalan dengan produk organizer plastik."
    }
  }
};

// Beautiful Blue, Purple, and Teal Color Variations for Charts
const donutChartData = {
  labels: ["LACK", "SKÅDIS", "HEMNES", "KALLAX", "VITTSJÖ", "Lainnya"],
  series: [28, 22, 18, 15, 12, 5], // persentase
  colors: ['#3b82f6', '#8b5cf6', '#06b6d4', '#6366f1', '#a855f7', '#0891b2'] // Beautiful blues, purples, and teals
};

const lineChartData = {
  2025: [
    { name: "LACK", data: [320, 350, 380, 410, 440, 420, 450, 480] },
    { name: "SKÅDIS", data: [220, 240, 260, 290, 310, 330, 350, 380] },
    { name: "HEMNES", data: [280, 290, 310, 300, 320, 330, 340, 350] },
    { name: "KALLAX", data: [260, 250, 270, 280, 290, 300, 310, 320] },
    { name: "VITTSJÖ", data: [190, 200, 210, 220, 230, 240, 250, 260] }
  ],
  2024: [
    { name: "HEMNES", data: [310, 300, 290, 300, 310, 320, 330, 340] },
    { name: "LACK", data: [290, 310, 330, 350, 370, 360, 380, 400] },
    { name: "KALLAX", data: [280, 270, 260, 270, 280, 290, 300, 310] },
    { name: "SKÅDIS", data: [180, 200, 220, 240, 260, 280, 300, 320] },
    { name: "VITTSJÖ", data: [170, 180, 190, 200, 210, 220, 230, 240] }
  ],
  2023: [
    { name: "KALLAX", data: [300, 290, 280, 290, 300, 310, 320, 330] },
    { name: "HEMNES", data: [280, 270, 280, 290, 300, 310, 320, 330] },
    { name: "LACK", data: [250, 270, 290, 310, 330, 320, 340, 360] },
    { name: "VITTSJÖ", data: [150, 160, 170, 180, 190, 200, 210, 220] },
    { name: "SKÅDIS", data: [150, 170, 190, 210, 230, 250, 270, 290] }
  ]
};

const lineInsights = {
  "LACK": "Brand LACK menunjukkan pertumbuhan stabil dengan peningkatan 8% QoQ. Penurunan kecil di bulan Juni karena masalah stok.",
  "SKÅDIS": "SKÅDIS menunjukkan pertumbuhan eksponensial dengan peningkatan 18% di Q2. Popularitas brand ini terus meningkat.",
  "HEMNES": "HEMNES memiliki penjualan stabil dengan sedikit peningkatan di akhir tahun. Konsistensi menjadi kekuatan utama brand ini.",
  "KALLAX": "KALLAX memiliki tren yang stabil dengan sedikit fluktuasi. Brand ini tetap menjadi favorit di segmen penyimpanan.",
  "VITTSJÖ": "VITTSJÖ menunjukkan pertumbuhan konsisten meski lambat. Potensi peningkatan dengan strategi pemasaran yang tepat."
};

// Brand Data for Table - Extended to 12 entries with IDs
const brandData = [
  { id: "BRD001", brand: "LACK", category: "Furniture", rating: 4.5, sales: 1850, price: "Rp 199K", status: "active" },
  { id: "BRD002", brand: "SKÅDIS", category: "Organizer", rating: 4.6, sales: 1240, price: "Rp 299K", status: "trending" },
  { id: "BRD003", brand: "HEMNES", category: "Furniture", rating: 4.7, sales: 1420, price: "Rp 599K", status: "active" },
  { id: "BRD004", brand: "KALLAX", category: "Storage", rating: 4.4, sales: 1180, price: "Rp 399K", status: "stable" },
  { id: "BRD005", brand: "VITTSJÖ", category: "Furniture", rating: 4.2, sales: 980, price: "Rp 449K", status: "stable" },
  { id: "BRD006", brand: "VARIERA", category: "Organizer", rating: 4.3, sales: 1050, price: "Rp 249K", status: "active" },
  { id: "BRD007", brand: "FJÄLLBO", category: "Furniture", rating: 4.1, sales: 720, price: "Rp 799K", status: "stable" },
  { id: "BRD008", brand: "IVAR", category: "Storage", rating: 4.5, sales: 890, price: "Rp 349K", status: "active" },
  { id: "BRD009", brand: "BILLY", category: "Storage", rating: 4.6, sales: 1320, price: "Rp 199K", status: "trending" },
  { id: "BRD010", brand: "MALM", category: "Furniture", rating: 4.4, sales: 1150, price: "Rp 899K", status: "active" },
  { id: "BRD011", brand: "POÄNG", category: "Furniture", rating: 4.8, sales: 950, price: "Rp 1.299K", status: "trending" },
  { id: "BRD012", brand: "EKET", category: "Storage", rating: 4.3, sales: 780, price: "Rp 179K", status: "stable" }
];

// Pagination and search variables
let currentPage = 1;
let itemsPerPage = 4;
let filteredData = [...brandData];
let searchQuery = '';

// Inisialisasi chart
let barChart, donutChart, lineChart;
let currentYear = '2025';

// Fungsi untuk memformat angka
function formatNumber(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Search functionality
function performSearch(query) {
  searchQuery = query.toLowerCase();
  
  if (searchQuery === '') {
    filteredData = [...brandData];
  } else {
    filteredData = brandData.filter(brand => 
      brand.brand.toLowerCase().includes(searchQuery) ||
      brand.category.toLowerCase().includes(searchQuery) ||
      brand.status.toLowerCase().includes(searchQuery) ||
      brand.id.toLowerCase().includes(searchQuery)
    );
  }
  
  currentPage = 1;
  updateTotalPages();
  renderBrandTable(currentPage);
  updateTotalBrandsText();
}

// Update total pages based on filtered data
function updateTotalPages() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  // Show/hide pagination buttons based on total pages
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
}

// Update total brands text
function updateTotalBrandsText() {
  const totalText = document.getElementById('totalBrandsText');
  if (searchQuery === '') {
    totalText.textContent = `Total: ${brandData.length} brands`;
  } else {
    totalText.textContent = `Ditemukan: ${filteredData.length} dari ${brandData.length} brands`;
  }
}

// Export to PDF function
function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  
  // Add title
  doc.setFontSize(16);
  doc.text('Data Brand IKEA', 14, 22);
  
  // Add export date
  doc.setFontSize(10);
  doc.text(`Exported on: ${new Date().toLocaleDateString('id-ID')}`, 14, 30);
  
  // Prepare table data
  const tableData = filteredData.map((brand, index) => [
    index + 1,
    brand.id,
    brand.brand,
    brand.category,
    brand.rating.toString(),
    brand.sales.toLocaleString(),
    brand.price,
    brand.status === 'active' ? 'Aktif' : 
    brand.status === 'trending' ? 'Trending' : 'Stabil'
  ]);
  
  // Add table
  doc.autoTable({
    head: [['No', 'ID Brand', 'Brand', 'Kategori', 'Rating', 'Penjualan/Bulan', 'Harga Rata-rata', 'Status']],
    body: tableData,
    startY: 35,
    styles: {
      fontSize: 8,
      cellPadding: 2
    },
    headStyles: {
      fillColor: [25, 118, 210],
      textColor: 255
    }
  });
  
  // Save the PDF
  doc.save('data-brand-ikea.pdf');
}

// Export to Excel function
function exportToExcel() {
  // Prepare data for Excel
  const excelData = filteredData.map((brand, index) => ({
    'No': index + 1,
    'ID Brand': brand.id,
    'Brand': brand.brand,
    'Kategori': brand.category,
    'Rating': brand.rating,
    'Penjualan/Bulan': brand.sales,
    'Harga Rata-rata': brand.price,
    'Status': brand.status === 'active' ? 'Aktif' : 
              brand.status === 'trending' ? 'Trending' : 'Stabil'
  }));
  
  // Create workbook and worksheet
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.json_to_sheet(excelData);
  
  // Add worksheet to workbook
  XLSX.utils.book_append_sheet(wb, ws, 'Data Brand IKEA');
  
  // Save the Excel file
  XLSX.writeFile(wb, 'data-brand-ikea.xlsx');
}

// Membuat custom legend untuk donut chart
function createDonutLegend() {
  const legendContainer = document.getElementById('donutLegend');
  legendContainer.innerHTML = '';

  donutChartData.labels.forEach((label, index) => {
    const legendItem = document.createElement('div');
    legendItem.className = 'legend-item';
    
    const colorBox = document.createElement('div');
    colorBox.className = 'legend-color';
    colorBox.style.backgroundColor = donutChartData.colors[index];
    
    const labelText = document.createElement('span');
    labelText.textContent = `${label} (${donutChartData.series[index]}%)`;
    
    legendItem.appendChild(colorBox);
    legendItem.appendChild(labelText);
    legendContainer.appendChild(legendItem);
  });
}

// Update insight untuk bar chart
function updateBarChartInsight(brand) {
  const insight = barChartData[currentYear].insights[brand] || 
                 `Brand ${brand} menunjukkan kinerja yang solid dengan kontribusi signifikan terhadap total penjualan.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: Brand ${brand}</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('barChartInsight').innerHTML = insightHTML;
}

// Update insight untuk line chart
function updateLineChartInsight(brand) {
  const insight = lineInsights[brand] || 
                `Tren penjualan brand ${brand} menunjukkan pola yang menarik dengan fluktuasi musiman.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-primary me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: Tren Brand ${brand}</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('lineChartInsight').innerHTML = insightHTML;
}

// Render Brand Table with Row Numbers and IDs
function renderBrandTable(page = 1) {
  const startIndex = (page - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  const tableBody = document.getElementById('brandTableBody');
  const noResults = document.getElementById('noResults');
  const tablePagination = document.getElementById('tablePagination');
  
  if (filteredData.length === 0) {
    tableBody.innerHTML = '';
    noResults.style.display = 'block';
    tablePagination.style.display = 'none';
    return;
  } else {
    noResults.style.display = 'none';
    tablePagination.style.display = 'flex';
  }

  tableBody.innerHTML = '';

  pageData.forEach((brand, index) => {
    const row = document.createElement('tr');
    
    const statusClass = brand.status === 'active' ? 'status-active' : 
                       brand.status === 'trending' ? 'status-trending' : 'status-stable';
    const statusText = brand.status === 'active' ? 'Aktif' : 
                      brand.status === 'trending' ? 'Trending' : 'Stabil';
    
    const rowNumber = startIndex + index + 1;
    
    row.innerHTML = `
      <td style="color: #374151; font-weight: 600;">${rowNumber}</td>
      <td><span class="brand-id">${brand.id}</span></td>
      <td><span class="brand-name">${brand.brand}</span></td>
      <td><span class="brand-category">${brand.category}</span></td>
      <td>
        <div class="brand-rating">
          <span class="stars">★</span>
          <span class="brand-rating-value">${brand.rating}</span>
        </div>
      </td>
      <td><span class="brand-sales">${brand.sales.toLocaleString()}</span></td>
      <td><span class="brand-price">${brand.price}</span></td>
      <td><span class="brand-status ${statusClass}">${statusText}</span></td>
    `;
    
    tableBody.appendChild(row);
  });

  // Update pagination info
  const totalItems = filteredData.length;
  const startItem = startIndex + 1;
  const endItem = Math.min(endIndex, totalItems);
  document.getElementById('paginationInfo').textContent = 
    `Menampilkan ${startItem}-${endItem} dari ${totalItems} brand`;

  // Update pagination buttons
  updatePaginationButtons(page);
}

// Update Pagination Buttons
function updatePaginationButtons(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  document.getElementById('prevBtn').disabled = page === 1;
  document.getElementById('nextBtn').disabled = page === totalPages;

  // Update page buttons
  document.getElementById('page1Btn').classList.toggle('active', page === 1);
  document.getElementById('page2Btn').classList.toggle('active', page === 2);
  document.getElementById('page3Btn').classList.toggle('active', page === 3);
  
  // Hide/show page buttons based on total pages
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
}

// Change Page Function
function changePage(direction) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  const newPage = currentPage + direction;
  if (newPage >= 1 && newPage <= totalPages) {
    currentPage = newPage;
    renderBrandTable(currentPage);
  }
}

// Go to Specific Page
function goToPage(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (page >= 1 && page <= totalPages) {
    currentPage = page;
    renderBrandTable(currentPage);
  }
}

// Inisialisasi Bar Chart
function initBarChart(year) {
  const data = barChartData[year];
  currentYear = year;

  const options = {
    series: [{
      name: 'Penjualan (Rp Juta)',
      data: data.sales
    }],
    chart: {
      type: 'bar',
      height: 250,
      toolbar: {
        show: true
      },
      events: {
        dataPointSelection: function(event, chartContext, config) {
          const brand = data.brands[config.dataPointIndex];
          updateBarChartInsight(brand);
        }
      }
    },
    plotOptions: {
      bar: {
        borderRadius: 6,
        horizontal: false,
        columnWidth: '60%',
        distributed: false,
      }
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#1976d2'],
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: 'vertical',
        shadeIntensity: 0.25,
        gradientToColors: ['#64b5f6'],
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      }
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: data.brands,
    },
    yaxis: {
      title: {
        text: 'Penjualan (Rp Juta)'
      },
      labels: {
        formatter: function(val) {
          return 'Rp ' + formatNumber(val);
        }
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return 'Rp ' + formatNumber(val) + ' juta';
        }
      }
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'],
        opacity: 0.5
      }
    }
  };

  if (barChart) {
    barChart.destroy();
  }

  barChart = new ApexCharts(document.querySelector("#barChart"), options);
  barChart.render();
}

// Inisialisasi Donut Chart
function initDonutChart() {
  const options = {
    series: donutChartData.series,
    chart: {
      type: 'donut',
      height: 200,
    },
    labels: donutChartData.labels,
    colors: donutChartData.colors, // Using light blue and purple variations
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 150
        },
        legend: {
          position: 'bottom'
        }
      }
    }],
    legend: {
      show: false
    },
    plotOptions: {
      pie: {
        donut: {
          size: '60%',
          labels: {
            show: true,
            total: {
              show: true,
              label: 'Total',
              formatter: function (w) {
                return '100%'
              }
            }
          }
        }
      }
    },
    dataLabels: {
      formatter: function(val, opts) {
        return val.toFixed(1) + '%';
      },
      dropShadow: {
        enabled: false
      }
    }
  };

  if (donutChart) {
    donutChart.destroy();
  }

  donutChart = new ApexCharts(document.querySelector("#donutChart"), options);
  donutChart.render();

  // Buat custom legend setelah chart di-render
  createDonutLegend();
}

// Inisialisasi Line Chart
function initLineChart(year) {
  const data = lineChartData[year];

  const options = {
    series: data,
    chart: {
      height: 250,
      type: 'line',
      zoom: {
        enabled: false
      },
      toolbar: {
        show: true
      },
      events: {
        dataPointSelection: function(event, chartContext, config) {
          const brand = data[config.seriesIndex].name;
          updateLineChartInsight(brand);
        },
        legendClick: function(chartContext, seriesIndex, config) {
          const brand = data[seriesIndex].name;
          updateLineChartInsight(brand);
        }
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2,
    },
    colors: ['#3b82f6', '#8b5cf6', '#06b6d4', '#6366f1', '#a855f7'], // Light blue and purple variations
    markers: {
      size: 4,
      strokeWidth: 0,
      hover: {
        size: 6
      }
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'],
        opacity: 0.5
      }
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags'],
    },
    yaxis: {
      title: {
        text: 'Penjualan (Unit)'
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' unit';
        }
      }
    }
  };

  if (lineChart) {
    lineChart.destroy();
  }

  lineChart = new ApexCharts(document.querySelector("#lineChart"), options);
  lineChart.render();
}

// Event listeners
document.getElementById('barChartYear').addEventListener('change', function() {
  const year = this.value;
  initBarChart(year);
  initLineChart(year);
});

document.getElementById('lineChartYear').addEventListener('change', function() {
  const year = this.value;
  initLineChart(year);
});

// Search input event listener
document.getElementById('searchInput').addEventListener('input', function() {
  performSearch(this.value);
});

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
  // Hide loader
  setTimeout(function() {
    document.getElementById('global-loader').style.display = 'none';
  }, 1000);

  initBarChart('2025');
  initDonutChart();
  initLineChart('2025');
  renderBrandTable(1);
  updateTotalBrandsText();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
