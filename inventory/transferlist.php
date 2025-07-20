<?php
require_once __DIR__ . '/../include/config.php';

// *** TAMBAHAN: Include AI Helper untuk Transfer ***
require_once __DIR__ . '/ai_helper_transfer.php';
require_once __DIR__ . '/../AI-integrated/AI-CHAT.PHP';
// *** TAMBAHAN: Get AI Insight ***
$aiInsight = getTransferAIInsight();
$aiData = $aiInsight['data'];

// *** TAMBAHAN: Extract solutions dari AI recommendation ***
function extractTransferSolutions($recommendation) {
    $solutions = [];
    $text = strtolower($recommendation);
    
    if (strpos($text, 'route_optimization') !== false || strpos($text, 'optimasi_rute') !== false) {
        $solutions = [
            "Implementasi rute langsung untuk mengurangi waktu transfer 45%",
            "Analisis traffic pattern untuk optimasi jadwal transfer harian",
            "Setup automated routing system untuk efisiensi maksimal"
        ];
    } elseif (strpos($text, 'efficiency') !== false || strpos($text, 'efisiensi') !== false) {
        $solutions = [
            "Audit proses transfer antar branch dalam 3 hari",
            "Implementasi real-time tracking untuk semua transfer",
            "Training tim untuk prosedur transfer yang lebih efisien"
        ];
    } elseif (strpos($text, 'cost_reduction') !== false || strpos($text, 'pengurangan_biaya') !== false) {
        $solutions = [
            "Review kontrak transportasi untuk optimasi biaya",
            "Implementasi bulk transfer untuk mengurangi biaya per unit",
            "Analisis alternatif transportasi yang lebih cost-effective"
        ];
    } elseif (strpos($text, 'time_optimization') !== false || strpos($text, 'optimasi_waktu') !== false) {
        $solutions = [
            "Setup express transfer lane untuk item prioritas tinggi",
            "Implementasi pre-scheduling system untuk transfer rutin",
            "Optimasi loading/unloading process di kedua branch"
        ];
    } else {
        // Default solutions
        $branchFrom = $aiData['branch_from'] ?? 'Branch';
        $branchTo = $aiData['branch_to'] ?? 'Branch';
        $solutions = [
            "Analisis mendalam performa transfer {$branchFrom}-{$branchTo} dalam 1 minggu",
            "Buat action plan spesifik untuk optimasi transfer corridor",
            "Monitor KPI transfer secara real-time selama 30 hari"
        ];
    }
    
    return $solutions;
}

$aiSolutions = extractTransferSolutions($aiData['recommendation']);

// *** TAMBAHAN: Format functions untuk AI data ***
function formatTransferInsightType($type) {
    $types = [
        'route_optimization' => 'Optimasi Rute',
        'efficiency' => 'Efisiensi Transfer',
        'cost_reduction' => 'Pengurangan Biaya',
        'time_optimization' => 'Optimasi Waktu',
        'general' => 'Umum'
    ];
    
    return $types[$type] ?? ucfirst($type);
}

function formatTransferUrgency($urgency) {
    $urgencies = [
        'low' => 'Rendah',
        'medium' => 'Sedang',
        'high' => 'Tinggi'
    ];
    
    return $urgencies[$urgency] ?? ucfirst($urgency);
}
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
<title>RuangKu</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
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

/* *** TAMBAHAN: AI Suggestion Card - SAMA SEPERTI CATEGORYLIST *** */
.suggestion-card {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: white;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 15px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(25, 118, 210, 0.2);
  position: relative;
  overflow: hidden;
}

.suggestion-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(25, 118, 210, 0.3);
}

.suggestion-card::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  transition: all 0.3s ease;
}

.suggestion-card:hover::before {
  top: -30%;
  right: -30%;
}

.suggestion-header {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  gap: 10px;
}

.suggestion-icon {
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  flex-shrink: 0;
}

.suggestion-title {
  font-size: 1.1rem;
  font-weight: 700;
  margin: 0;
  line-height: 1.3;
}

.suggestion-content {
  font-size: 0.9rem;
  line-height: 1.6;
  margin: 0;
  opacity: 0.95;
}

/* *** TAMBAHAN: AI Solutions Card - SAMA SEPERTI CATEGORYLIST *** */
.ai-solutions-card {
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 15px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  position: relative;
  overflow: hidden;
}

.ai-solutions-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
  border-color: #1976d2;
}

.ai-solutions-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #1976d2 0%, #42a5f5 100%);
}

.solutions-header {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  gap: 10px;
  position: relative;
}

.solutions-icon {
  width: 35px;
  height: 35px;
  background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  color: white;
  flex-shrink: 0;
  box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
}

.solutions-title {
  font-size: 1rem;
  font-weight: 700;
  margin: 0;
  color: #1e293b;
  line-height: 1.3;
}

.solutions-tooltip {
  position: absolute;
  right: 0;
  top: 0;
  background: rgba(59, 130, 246, 0.1);
  color: #1976d2;
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.7rem;
  font-weight: 600;
}

.solutions-body {
  margin-bottom: 15px;
}

.solution-item-card {
  display: flex;
  align-items: flex-start;
  margin-bottom: 12px;
  padding: 12px;
  background: white;
  border-radius: 8px;
  transition: all 0.2s ease;
  border: 1px solid #f1f5f9;
}

.solution-item-card:hover {
  background: #f8fafc;
  border-color: #e2e8f0;
  transform: translateX(5px);
}

.solution-item-card:last-child {
  margin-bottom: 0;
}

.solution-number {
  background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
  color: white;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
  font-weight: 700;
  margin-right: 12px;
  flex-shrink: 0;
  box-shadow: 0 2px 6px rgba(25, 118, 210, 0.3);
}

.solution-text {
  font-size: 0.85rem;
  line-height: 1.5;
  color: #374151;
  font-weight: 500;
}

.solutions-footer {
  text-align: center;
  padding-top: 10px;
  border-top: 1px solid #e2e8f0;
}

.solutions-footer small {
  color: #64748b;
  font-size: 0.75rem;
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

/* Modal Styling */
.info-item {
  display: flex;
  align-items: center;
  padding: 4px 0;
}

.info-item strong {
  min-width: 140px;
  color: #374151;
  font-size: 0.9rem;
}

.modal-body {
  max-height: 70vh;
  overflow-y: auto;
}

.modal-body::-webkit-scrollbar {
  width: 6px;
}

.modal-body::-webkit-scrollbar-thumb {
  background-color: #ccc;
  border-radius: 4px;
}

.modal-body::-webkit-scrollbar-track {
  background-color: #f1f1f1;
}

/* Print Styles */
@media print {
  .modal-header, .modal-footer {
    display: none !important;
  }
  
  .modal-body {
    padding: 0 !important;
    max-height: none !important;
    overflow: visible !important;
  }
  
  .modal-content {
    box-shadow: none !important;
    border: none !important;
  }
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
        <h4>Transfer Analytics Dashboard</h4>
        <h6>Comprehensive transfer insights and branch distribution analysis</h6>
      </div>
      <div class="page-btn">
        <a href="addtransfer.php" class="btn btn-added">
          <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">New Transfer
        </a>
      </div>
    </div>

    <!-- Revenue, Suppliers, Product Sold, Budget Spent -->
          <div class="row justify-content-end">
          <!-- 🔢 Total Active Transfers -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4><span class="counters" data-count="156">156</span></h4>
                    <h5>Total Active Transfers</h5>
                    <h2 class="stat-change">+12% from last month</h2>
                    </div>
                    <div class="icon-box bg-ungu">
                      <i class="fa fa-exchange-alt"></i>
                    </div>
                </div>
              </a>
            </div>

            <!-- 🛒 Avg Transfer Time -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das2">
                  <div class="dash-counts">
                  <h4><span class="counters" data-count="2.4">2.4</span></h4>
                   <h5>Avg Transfer Time (Days)</h5>
                  <h2 class="stat-change">+8.3% from last year</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-clock"></i>
                </div>
                </div>
              </a>
            </div>

             <!-- 📦 Success Rate -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das3">
                  <div class="dash-counts">
                  <h4><span class="counters" data-count="89">89%</span></h4> 
                  <h5>Success Rate</h5>                 
                    <h2 class="stat-change">+15% from last month</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-check-circle"></i>
                  </div>
                </div>
              </a>
            </div>

            <!-- 🗂️ Top Transfer Category -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                     <h4>Furniture</h4>
                    <h5>Top Transfer Category</h5>
                   <h2 class="stat-change">Dominated by HEMNES</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-couch"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->

    
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
                  <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Transfer Growth Trend (Top 5 Branches)</h5>
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
                      <h5 style="font-size: 0.9rem;">Insight: Transfer Branch Trends</h5>
                      <p class="mb-0">IKEA Alam Sutera shows consistent growth with 8% QoQ improvement. Slight decline in June due to inventory optimization program.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Donut Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-pie me-2"></i>Branch Transfer Distribution</h5>
                </div>
                <div id="donutChart" style="height: 200px;"></div>
                <div class="donut-legend" id="donutLegend"></div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Branch Distribution</h5>
                      <p class="mb-0">Top 3 branches account for 68% of total transfers. IKEA Jakarta Garden City shows highest growth (+5% YoY) in transfer volume.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Line Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-line me-2"></i>Monthly Transfer Trend (Top 5 Branches)</h5>
                  <select class="chart-select" id="lineChartYear">
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
                <div id="lineChart" style="height: 250px;"></div>
                <div class="insight-container" id="lineChartInsight">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 id="lineChartInsightTitle" style="font-size: 0.9rem;">Insight: Transfer Trends</h5>
                      <p class="mb-0" id="lineChartInsightText">IKEA Alam Sutera shows consistent transfer pattern with 12% increase QoQ. Peak transfers in Q2 due to seasonal factors.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Insight Branch Comparison -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-balance-scale me-2"></i>Branch Performance Comparison</h5>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%); border-radius: 10px; border: 1px solid rgba(25, 118, 210, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: var(--primary-blue); font-weight: 600;">IKEA Alam Sutera vs IKEA Sentul City</h6>
                        <span style="background: var(--primary-blue); color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">Furniture</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #b8860b;">
                            <i class="fas fa-crown" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">IKEA Alam Sutera</h6>
                          <small style="font-size: 0.7rem; color: #666;">4.6⭐ | 156 transfers | 2.1 days avg</small>
                        </div>
                        <div style="margin: 0 10px;">
                          <div style="width: 25px; height: 25px; background: var(--danger-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; font-weight: 700;">VS</div>
                        </div>
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #666;">
                            <i class="fas fa-medal" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">IKEA Sentul City</h6>
                          <small style="font-size: 0.7rem; color: #666;">4.3⭐ | 98 transfers | 2.8 days avg</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%); border-radius: 10px; border: 1px solid rgba(25, 118, 210, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: var(--primary-blue); font-weight: 600;">IKEA Jakarta GC vs IKEA Bali</h6>
                        <span style="background: var(--primary-blue); color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">Storage</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #b8860b;">
                            <i class="fas fa-crown" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">IKEA Jakarta GC</h6>
                          <small style="font-size: 0.7rem; color: #666;">4.5⭐ | 142 transfers | 2.3 days avg</small>
                        </div>
                        <div style="margin: 0 10px;">
                          <div style="width: 25px; height: 25px; background: var(--danger-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; font-weight: 700;">VS</div>
                        </div>
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #666;">
                            <i class="fas fa-medal" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">IKEA Bali</h6>
                          <small style="font-size: 0.7rem; color: #666;">4.7⭐ | 89 transfers | 3.1 days avg</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Branch Competition</h5>
                      <p class="mb-0">Alam Sutera leads in efficiency and volume, while Sentul City excels in customer satisfaction. Jakarta GC dominates furniture category transfers.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Column - Sidebar tetap di samping charts -->
            <div class="col-lg-4">
              <!-- Transfer Readiness Index -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bolt me-2"></i>Transfer Readiness Index
                </div>
                <div class="sidebar-card-body">
                  <div class="readiness-compact">
                    <div class="readiness-score-compact">92%</div>
                    <div class="readiness-brand-compact">IKEA ALAM SUTERA</div>
                    <div class="readiness-label-compact">Transfer-Ready Score</div>
                    
                    <div class="readiness-features-compact">
                      <div class="readiness-feature-compact">
                        <i class="fas fa-boxes text-success"></i>
                        <p>Stock Ready</p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-star text-warning"></i>
                        <p>Rating 4.6</p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-chart-line text-primary"></i>
                        <p>Stable</p>
                      </div>
                    </div>
                    
                    <div class="readiness-progress-compact">
                      <div class="readiness-fill-compact" style="width: 92%"></div>
                    </div>
                    
                    <div class="readiness-status-compact">
                      ✓ Ready for Flash Transfer
                    </div>
                  </div>
                </div>
              </div>

              <!-- AI Transfer Optimization -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-robot me-2"></i>AI Transfer Optimization
                </div>
                <div class="sidebar-card-body">
                  <div class="d-flex align-items-center mb-2">
                    <div class="bg-light p-2 rounded-circle me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-lightbulb text-primary" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                      <h5 class="mb-1" style="font-size: 1rem;">Route Optimization</h5>
                      <p class="mb-0" style="font-size: 0.85rem;">AI suggests <span class="fw-bold">direct transfer route</span> for furniture items</p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Efficiency gain:</p>
                      <div class="progress" style="height: 6px; width: 100px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <span class="fw-bold" style="font-size: 0.8rem;">45%</span>
                    </div>
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Optimize corridor:</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Jakarta-Bali</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Better efficiency</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Top Transfer Locations -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-map-marker-alt me-2"></i>Top Transfer Locations
                </div>
                <div class="sidebar-card-body">
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name">IKEA ALAM SUTERA</h6>
                      <span class="location-status-badge top">Most Transfers</span>
                    </div>
                    <p class="location-description">Most transfers to:</p>
                    <div class="location-tags">
                      <span class="location-tag highlight">Jakarta GC</span>
                      <span class="location-tag">Sentul City</span>
                      <span class="location-tag">Bali</span>
                      <span class="location-tag">Bandung</span>
                    </div>
                  </div>
                  
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name">IKEA JAKARTA GC</h6>
                      <span class="location-status-badge rising">Popular Destinations</span>
                    </div>
                    <p class="location-description">Transfer destinations:</p>
                    <div class="location-tags">
                      <span class="location-tag">Bandung</span>
                      <span class="location-tag highlight">Alam Sutera</span>
                      <span class="location-tag">Sentul</span>
                      <span class="location-tag">Bali</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Critical Notifications -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-exclamation-triangle me-2"></i>Critical Notifications
                </div>
                <div class="sidebar-card-body">
                  <div class="notification-card warning">
                    <i class="fas fa-exclamation-triangle text-warning"></i>
                    <div>
                      <h5 class="mb-1">IKEA ALAM SUTERA - High Volume Alert</h5>
                      <p class="mb-0">Transfer volume critical, optimize routing immediately</p>
                    </div>
                  </div>
                  
                  <div class="notification-card danger">
                    <i class="fas fa-sync-alt text-danger"></i>
                    <div>
                      <h5 class="mb-1">IKEA JAKARTA GC - 4x Restocks in 30 Days</h5>
                      <p class="mb-0">Inventory requests increased 45% from last month</p>
                    </div>
                  </div>
                  
                  <div class="notification-card info">
                    <i class="fas fa-chart-line text-info"></i>
                    <div>
                      <h5 class="mb-1">Transfer Prediction Ready</h5>
                      <p class="mb-0">IKEA Bali predicted to need 2,100 units in August 2025</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- *** TAMBAHAN: AI Suggestion Card - SAMA SEPERTI CATEGORYLIST *** -->
              <div class="suggestion-card" id="aiSuggestionCard">
                <div class="suggestion-header">
                  <div class="suggestion-icon">
                    <i class="fas fa-brain"></i>
                  </div>
                  <h4 class="suggestion-title" id="aiSuggestionTitle">
                    AI Suggestion: <?= formatTransferInsightType($aiData['insight_type']) ?>
                  </h4>
                </div>
                <p class="suggestion-content" id="aiSuggestionContent">
                  <?= htmlspecialchars($aiData['recommendation']) ?>
                </p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <small style="opacity: 0.8;" id="aiSuggestionMeta">
                    <?= $aiData['branch_from'] ?? 'General' ?> → <?= $aiData['branch_to'] ?? 'Branch' ?> • <?= formatTransferUrgency($aiData['urgency']) ?>
                  </small>
                  <small style="opacity: 0.7;" id="aiSuggestionTime">
                    <?= date('d M H:i', strtotime($aiData['generated_at'])) ?>
                  </small>
                </div>
              </div>

              <!-- *** TAMBAHAN: AI Solutions Card - SAMA SEPERTI CATEGORYLIST *** -->
              <div class="ai-solutions-card" id="aiSolutionsCard">
                <div class="solutions-header">
                  <div class="solutions-icon">
                    <i class="fas fa-lightbulb"></i>
                  </div>
                  <h5 class="solutions-title">Solusi AI Actionable</h5>
                  <div class="solutions-tooltip">
                    Solusi berdasarkan AI suggestion di atas
                  </div>
                </div>
                <div class="solutions-body">
                  <?php foreach ($aiSolutions as $index => $solution) { ?>
                  <div class="solution-item-card">
                    <div class="solution-number"><?php echo $index + 1; ?></div>
                    <div class="solution-text"><?php echo htmlspecialchars($solution); ?></div>
                  </div>
                  <?php } ?>
                </div>
                <div class="solutions-footer">
                  <small><i class="fas fa-robot me-1"></i>Generated by AI • <?php echo date('H:i'); ?></small>
                </div>
              </div>
            </div>
          </div>

          <!-- Enhanced Transfer Data Table - Full Width Professional with Search & Export -->
          <div class="brand-table-section">
            <div class="chart-header">
              <h5 class="chart-title"><i class="fas fa-table me-2"></i>Recent Transfer Records</h5>
              <div class="d-flex align-items-center gap-2">
                <span style="font-size: 0.8rem; color: #64748b;" id="totalTransfersText">Total: 24 transfers</span>
              </div>
            </div>
            
            <!-- Table Controls -->
            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Search transfers, branches, or status...">
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
            
            <table class="brand-table" id="transfersTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Category ID</th>
                  <th>From Branch</th>
                  <th>To Branch</th>
                  <th>Items</th>
                  <th>Value</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="transfersTableBody">
                <!-- Data akan diisi oleh JavaScript -->
              </tbody>
            </table>
            
            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display: none;">
              <i class="fas fa-search"></i>
              <h5>No data found</h5>
              <p>Try changing your search keywords</p>
            </div>
            
            <div class="table-pagination" id="tablePagination">
              <div class="pagination-info" id="paginationInfo">
                Showing 1-6 of 24 transfers
              </div>
              <div class="pagination-controls">
                <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                  <i class="fas fa-chevron-left"></i> Prev
                </button>
                <button class="pagination-btn active" id="page1Btn" onclick="goToPage(1)">1</button>
                <button class="pagination-btn" id="page2Btn" onclick="goToPage(2)">2</button>
                <button class="pagination-btn"  id="page3Btn" onclick="goToPage(3)">3</button>
                <button class="pagination-btn" id="page4Btn" onclick="goToPage(4)">4</button>
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

<!-- Transfer Details Modal -->
<div class="modal fade" id="transferDetailsModal" tabindex="-1" aria-labelledby="transferDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%); color: white;">
        <h5 class="modal-title" id="transferDetailsModalLabel">
          <i class="fas fa-exchange-alt me-2"></i>Transfer Details
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Left Column -->
          <div class="col-md-6">
            <div class="mb-4">
              <h6 class="text-primary mb-3"><i class="fas fa-info-circle me-2"></i>Transfer Information</h6>
              <div class="info-item mb-2">
                <strong>Transfer ID:</strong>
                <span id="modalTransferId" class="ms-2 badge bg-light text-dark">TR-001</span>
              </div>
              <div class="info-item mb-2">
                <strong>Transfer Date:</strong>
                <span id="modalTransferDate" class="ms-2">2025-01-20</span>
              </div>
              <div class="info-item mb-2">
                <strong>Category:</strong>
                <span id="modalCategory" class="ms-2 badge bg-info">Furniture</span>
              </div>
              <div class="info-item mb-2">
                <strong>Status:</strong>
                <span id="modalStatus" class="ms-2 badge bg-success">Completed</span>
              </div>
            </div>

            <div class="mb-4">
              <h6 class="text-primary mb-3"><i class="fas fa-map-marker-alt me-2"></i>Location Details</h6>
              <div class="info-item mb-2">
                <strong>From Branch:</strong>
                <span id="modalFromBranch" class="ms-2">IKEA Alam Sutera</span>
              </div>
              <div class="info-item mb-2">
                <strong>To Branch:</strong>
                <span id="modalToBranch" class="ms-2">IKEA Jakarta Garden City</span>
              </div>
              <div class="info-item mb-2">
                <strong>Distance:</strong>
                <span id="modalDistance" class="ms-2">45 km</span>
              </div>
              <div class="info-item mb-2">
                <strong>Estimated Time:</strong>
                <span id="modalEstimatedTime" class="ms-2">2.5 hours</span>
              </div>
            </div>
          </div>

          <!-- Right Column -->
          <div class="col-md-6">
            <div class="mb-4">
              <h6 class="text-primary mb-3"><i class="fas fa-dollar-sign me-2"></i>Financial Details</h6>
              <div class="info-item mb-2">
                <strong>Transfer Value:</strong>
                <span id="modalValue" class="ms-2 text-success fw-bold">Rp 2.450.000</span>
              </div>
              <div class="info-item mb-2">
                <strong>Transport Cost:</strong>
                <span id="modalTransportCost" class="ms-2">Rp 150.000</span>
              </div>
              <div class="info-item mb-2">
                <strong>Insurance:</strong>
                <span id="modalInsurance" class="ms-2">Rp 25.000</span>
              </div>
              <div class="info-item mb-2">
                <strong>Total Cost:</strong>
                <span id="modalTotalCost" class="ms-2 text-primary fw-bold">Rp 2.625.000</span>
              </div>
            </div>

            <div class="mb-4">
              <h6 class="text-primary mb-3"><i class="fas fa-chart-line me-2"></i>Transfer Analytics</h6>
              <div class="info-item mb-2">
                <strong>Processing Time:</strong>
                <span id="modalProcessingTime" class="ms-2">2.1 days</span>
              </div>
              <div class="info-item mb-2">
                <strong>Success Rate:</strong>
                <span id="modalSuccessRate" class="ms-2 text-success">98%</span>
              </div>
              <div class="info-item mb-2">
                <strong>Branch Rating:</strong>
                <span id="modalBranchRating" class="ms-2">
                  <span class="text-warning">★★★★☆</span> 4.6/5.0
                </span>
              </div>
              <div class="info-item mb-2">
                <strong>Priority Level:</strong>
                <span id="modalPriority" class="ms-2 badge bg-warning">High</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Additional Details Section -->
        <div class="row mt-4">
          <div class="col-12">
            <div class="card" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%); border: 1px solid rgba(25, 118, 210, 0.2);">
              <div class="card-body">
                <h6 class="text-primary mb-3"><i class="fas fa-boxes me-2"></i>Items Details</h6>
                <div class="row">
                  <div class="col-md-4">
                    <div class="text-center">
                      <div style="width: 80px; height: 80px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                        <i class="fas fa-couch" style="font-size: 2rem; color: #1976d2;"></i>
                      </div>
                      <small class="text-muted">Product Image</small>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="info-item mb-2">
                      <strong>Items Count:</strong>
                      <span id="modalItemsCount" class="ms-2">156 units</span>
                    </div>
                    <div class="info-item mb-2">
                      <strong>Weight:</strong>
                      <span id="modalWeight" class="ms-2">2,450 kg</span>
                    </div>
                    <div class="info-item mb-2">
                      <strong>Volume:</strong>
                      <span id="modalVolume" class="ms-2">45 m³</span>
                    </div>
                    <div class="info-item mb-2">
                      <strong>Special Instructions:</strong>
                      <span id="modalInstructions" class="ms-2 text-muted">Handle with care - fragile items</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times me-2"></i>Close
        </button>
        <button type="button" class="btn btn-primary" onclick="editTransfer()">
          <i class="fas fa-edit me-2"></i>Edit Transfer
        </button>
        <button type="button" class="btn btn-success" onclick="printTransferDetails()">
          <i class="fas fa-print me-2"></i>Print Details
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Print Modal -->
<div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="printModalLabel">Print Transfer Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="printContent">
        <!-- Print content will be generated here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
      </div>
    </div>
  </div>
</div>
</div>

<script>
// *** TAMBAHAN: Fungsi refresh AI suggestion - SAMA SEPERTI CATEGORYLIST ***
function refreshAISolutions() {
    console.log('AI Solutions refreshed for transfers');
    // Optional: Add refresh functionality for solutions if needed
    
    // Simulate fetching new AI solutions
    fetch('get_ai_solution.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update solutions display
                const solutionsBody = document.querySelector('.solutions-body');
                if (solutionsBody && data.solutions) {
                    solutionsBody.innerHTML = '';
                    data.solutions.forEach((solution, index) => {
                        const solutionCard = document.createElement('div');
                        solutionCard.className = 'solution-item-card';
                        solutionCard.innerHTML = `
                            <div class="solution-number">${index + 1}</div>
                            <div class="solution-text">${solution}</div>
                        `;
                        solutionsBody.appendChild(solutionCard);
                    });
                }
            }
        })
        .catch(error => {
            console.error('Error refreshing AI solutions:', error);
        });
}

// Data dummy untuk visualisasi - MENGGUNAKAN DATA TRANSFER
const barChartData = {
  2025: {
    branches: ["IKEA Alam Sutera", "IKEA Jakarta GC", "IKEA Sentul City", "IKEA Bali", "IKEA Kota Baru Parahyangan"],
    transfers: [156, 142, 98, 89, 67], // dalam unit
    insights: {
      "IKEA Alam Sutera": "IKEA Alam Sutera shows consistent growth with 8% QoQ improvement. Slight decline in June due to inventory optimization program.",
      "IKEA Jakarta GC": "IKEA Jakarta GC transfers increased 15% due to high demand from furniture category transfers.",
      "IKEA Sentul City": "IKEA Sentul City transfers remain consistent with seasonal patterns, mainly furniture and storage items.",
      "IKEA Bali": "IKEA Bali transfers decreased 5% after implementing better inventory management with suppliers.",
      "IKEA Kota Baru Parahyangan": "IKEA Kota Baru Parahyangan shows steady performance with consistent transfer patterns throughout 2025."
    }
  },
  2024: {
    branches: ["IKEA Jakarta GC", "IKEA Alam Sutera", "IKEA Sentul City", "IKEA Bali", "IKEA Kota Baru Parahyangan"],
    transfers: [138, 145, 92, 85, 62],
    insights: {
      "IKEA Jakarta GC": "IKEA Jakarta GC dominated transfers in 2024 with consistent growth from furniture category.",
      "IKEA Alam Sutera": "IKEA Alam Sutera maintained stable transfer volumes throughout 2024 with seasonal variations.",
      "IKEA Sentul City": "IKEA Sentul City showed improvement in Q4 2024 after branch optimization programs.",
      "IKEA Bali": "IKEA Bali transfers increased slightly due to tourism season demand patterns.",
      "IKEA Kota Baru Parahyangan": "IKEA Kota Baru Parahyangan had steady transfers in 2024 with excellent branch coordination."
    }
  },
  2023: {
    branches: ["IKEA Alam Sutera", "IKEA Jakarta GC", "IKEA Sentul City", "IKEA Bali", "IKEA Kota Baru Parahyangan"],
    transfers: [132, 125, 88, 78, 58],
    insights: {
      "IKEA Alam Sutera": "IKEA Alam Sutera led transfers in 2023 during the initial branch expansion period.",
      "IKEA Jakarta GC": "IKEA Jakarta GC transfers were moderate with gradual branch improvements.",
      "IKEA Sentul City": "IKEA Sentul City maintained steady transfer patterns throughout 2023.",
      "IKEA Bali": "IKEA Bali transfers started moderate but improved significantly by year-end.",
      "IKEA Kota Baru Parahyangan": "IKEA Kota Baru Parahyangan had lowest transfers in 2023 with excellent branch relationships."
    }
  }
};

// Beautiful Blue, Purple, and Teal Color Variations for Charts
const donutChartData = {
  labels: ["IKEA Alam Sutera", "IKEA Jakarta GC", "IKEA Sentul City", "IKEA Bali", "IKEA Kota Baru Parahyangan", "Others"],
  series: [28, 22, 18, 15, 12, 5], // persentase
  colors: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9', '#bbdefb', '#e3f2fd']
};

const lineChartData = {
  2025: [
    { name: "IKEA Alam Sutera", data: [320, 350, 380, 410, 440, 420, 450, 480] },
    { name: "IKEA Jakarta GC", data: [280, 290, 310, 330, 340, 350, 370, 380] },
    { name: "IKEA Sentul City", data: [220, 240, 260, 270, 280, 290, 300, 320] },
    { name: "IKEA Bali", data: [200, 210, 220, 230, 240, 250, 260, 270] },
    { name: "IKEA Kota Baru Parahyangan", data: [180, 190, 200, 210, 220, 230, 240, 250] }
  ],
  2024: [
    { name: "IKEA Jakarta GC", data: [275, 285, 305, 325, 335, 345, 365, 375] },
    { name: "IKEA Alam Sutera", data: [290, 310, 330, 350, 370, 390, 410, 430] },
    { name: "IKEA Sentul City", data: [210, 230, 250, 260, 270, 280, 290, 310] },
    { name: "IKEA Bali", data: [190, 200, 210, 220, 230, 240, 250, 260] },
    { name: "IKEA Kota Baru Parahyangan", data: [170, 180, 190, 200, 210, 220, 230, 240] }
  ],
  2023: [
    { name: "IKEA Alam Sutera", data: [260, 280, 300, 320, 340, 360, 380, 400] },
    { name: "IKEA Jakarta GC", data: [250, 270, 290, 310, 330, 350, 370, 390] },
    { name: "IKEA Sentul City", data: [200, 220, 240, 250, 260, 270, 280, 300] },
    { name: "IKEA Bali", data: [180, 190, 200, 210, 220, 230, 240, 250] },
    { name: "IKEA Kota Baru Parahyangan", data: [160, 170, 180, 190, 200, 210, 220, 230] }
  ]
};

// Extended Transfer Data for Table - 24 records
const transfersData = [
  { 
    id: 1, 
    categoryId: "TR-001", 
    fromBranch: "IKEA Alam Sutera", 
    toBranch: "IKEA Jakarta Garden City", 
    items: "Furniture", 
    value: "Rp 2.450.000", 
    status: "Completed" 
  },
  { 
    id: 2, 
    categoryId: "TR-002", 
    fromBranch: "IKEA Jakarta Garden City", 
    toBranch: "IKEA Sentul City", 
    items: "Storage", 
    value: "Rp 1.850.000", 
    status: "In Progress" 
  },
  { 
    id: 3, 
    categoryId: "TR-003", 
    fromBranch: "IKEA Sentul City", 
    toBranch: "IKEA Bali", 
    items: "Lighting", 
    value: "Rp 1.950.000", 
    status: "Completed" 
  },
  { 
    id: 4, 
    categoryId: "TR-004", 
    fromBranch: "IKEA Bali", 
    toBranch: "IKEA Kota Baru Parahyangan", 
    items: "Bedroom", 
    value: "Rp 1.420.000", 
    status: "Pending" 
  },
  { 
    id: 5, 
    categoryId: "TR-005", 
    fromBranch: "IKEA Kota Baru Parahyangan", 
    toBranch: "IKEA Mal Taman Anggrek", 
    items: "Living Room", 
    value: "Rp 3.200.000", 
    status: "Completed" 
  },
  { 
    id: 6, 
    categoryId: "TR-006", 
    fromBranch: "IKEA Mal Taman Anggrek", 
    toBranch: "IKEA Alam Sutera", 
    items: "Kitchen", 
    value: "Rp 2.750.000", 
    status: "In Progress" 
  },
  { 
    id: 7, 
    categoryId: "TR-007", 
    fromBranch: "IKEA Alam Sutera", 
    toBranch: "IKEA Bali", 
    items: "Dining", 
    value: "Rp 1.680.000", 
    status: "Completed" 
  },
  { 
    id: 8, 
    categoryId: "TR-008", 
    fromBranch: "IKEA Jakarta Garden City", 
    toBranch: "IKEA Kota Baru Parahyangan", 
    items: "Storage", 
    value: "Rp 2.100.000", 
    status: "Pending" 
  },
  { 
    id: 9, 
    categoryId: "TR-009", 
    fromBranch: "IKEA Sentul City", 
    toBranch: "IKEA Mal Taman Anggrek", 
    items: "Furniture", 
    value: "Rp 1.890.000", 
    status: "Completed" 
  },
  { 
    id: 10, 
    categoryId: "TR-010", 
    fromBranch: "IKEA Bali", 
    toBranch: "IKEA Jakarta Garden City", 
    items: "Lighting", 
    value: "Rp 2.350.000", 
    status: "In Progress" 
  },
  { 
    id: 11, 
    categoryId: "TR-011", 
    fromBranch: "IKEA Kota Baru Parahyangan", 
    toBranch: "IKEA Sentul City", 
    items: "Bedroom", 
    value: "Rp 2.980.000", 
    status: "Completed" 
  },
  { 
    id: 12, 
    categoryId: "TR-012", 
    fromBranch: "IKEA Mal Taman Anggrek", 
    toBranch: "IKEA Alam Sutera", 
    items: "Kitchen", 
    value: "Rp 1.750.000", 
    status: "Pending" 
  },
  { 
    id: 13, 
    categoryId: "TR-013", 
    fromBranch: "IKEA Alam Sutera", 
    toBranch: "IKEA Sentul City", 
    items: "Textiles", 
    value: "Rp 1.320.000", 
    status: "Completed" 
  },
  { 
    id: 14, 
    categoryId: "TR-014", 
    fromBranch: "IKEA Jakarta Garden City", 
    toBranch: "IKEA Bali", 
    items: "Decoration", 
    value: "Rp 980.000", 
    status: "In Progress" 
  },
  { 
    id: 15, 
    categoryId: "TR-015", 
    fromBranch: "IKEA Sentul City", 
    toBranch: "IKEA Kota Baru Parahyangan", 
    items: "Furniture", 
    value: "Rp 2.650.000", 
    status: "Completed" 
  },
  { 
    id: 16, 
    categoryId: "TR-016", 
    fromBranch: "IKEA Bali", 
    toBranch: "IKEA Mal Taman Anggrek", 
    items: "Storage", 
    value: "Rp 1.780.000", 
    status: "Pending" 
  },
  { 
    id: 17, 
    categoryId: "TR-017", 
    fromBranch: "IKEA Kota Baru Parahyangan", 
    toBranch: "IKEA Alam Sutera", 
    items: "Lighting", 
    value: "Rp 1.450.000", 
    status: "Completed" 
  },
  { 
    id: 18, 
    categoryId: "TR-018", 
    fromBranch: "IKEA Mal Taman Anggrek", 
    toBranch: "IKEA Jakarta Garden City", 
    items: "Bedroom", 
    value: "Rp 3.100.000", 
    status: "In Progress" 
  },
  { 
    id: 19, 
    categoryId: "TR-019", 
    fromBranch: "IKEA Alam Sutera", 
    toBranch: "IKEA Kota Baru Parahyangan", 
    items: "Kitchen", 
    value: "Rp 2.890.000", 
    status: "Completed" 
  },
  { 
    id: 20, 
    categoryId: "TR-020", 
    fromBranch: "IKEA Jakarta Garden City", 
    toBranch: "IKEA Sentul City", 
    items: "Living Room", 
    value: "Rp 2.200.000", 
    status: "Pending" 
  },
  { 
    id: 21, 
    categoryId: "TR-021", 
    fromBranch: "IKEA Sentul City", 
    toBranch: "IKEA Alam Sutera", 
    items: "Dining", 
    value: "Rp 1.560.000", 
    status: "Completed" 
  },
  { 
    id: 22, 
    categoryId: "TR-022", 
    fromBranch: "IKEA Bali", 
    toBranch: "IKEA Kota Baru Parahyangan", 
    items: "Textiles", 
    value: "Rp 1.120.000", 
    status: "In Progress" 
  },
  { 
    id: 23, 
    categoryId: "TR-023", 
    fromBranch: "IKEA Kota Baru Parahyangan", 
    toBranch: "IKEA Jakarta Garden City", 
    items: "Decoration", 
    value: "Rp 850.000", 
    status: "Completed" 
  },
  { 
    id: 24, 
    categoryId: "TR-024", 
    fromBranch: "IKEA Mal Taman Anggrek", 
    toBranch: "IKEA Bali", 
    items: "Furniture", 
    value: "Rp 2.750.000", 
    status: "Pending" 
  }
];

// Pagination and search variables
let currentPage = 1;
let itemsPerPage = 6;
let filteredData = [...transfersData];
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
    filteredData = [...transfersData];
  } else {
    filteredData = transfersData.filter(item => 
      item.fromBranch.toLowerCase().includes(searchQuery) ||
      item.toBranch.toLowerCase().includes(searchQuery) ||
      item.categoryId.toLowerCase().includes(searchQuery) ||
      item.status.toLowerCase().includes(searchQuery) ||
      item.items.toLowerCase().includes(searchQuery)
    );
  }
  
  currentPage = 1;
  updateTotalPages();
  renderTransfersTable(currentPage);
  updateTotalTransfersText();
}

// Update total pages based on filtered data
function updateTotalPages() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  // Show/hide pagination buttons based on total pages
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
  document.getElementById('page4Btn').style.display = totalPages >= 4 ? 'inline-block' : 'none';
}

// Update total transfers text
function updateTotalTransfersText() {
  const totalText = document.getElementById('totalTransfersText');
  if (searchQuery === '') {
    totalText.textContent = `Total: ${transfersData.length} transfers`;
  } else {
    totalText.textContent = `Found: ${filteredData.length} of ${transfersData.length} transfers`;
  }
}

// Export to PDF function
function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  
  // Add title
  doc.setFontSize(16);
  doc.text('Transfer Records Data', 14, 22);
  
  // Add export date
  doc.setFontSize(10);
  doc.text(`Exported on: ${new Date().toLocaleDateString('en-US')}`, 14, 30);
  
  // Prepare table data
  const tableData = filteredData.map((item, index) => [
    index + 1,
    item.categoryId,
    item.fromBranch,
    item.toBranch,
    item.items,
    item.value,
    item.status
  ]);
  
  // Add table
  doc.autoTable({
    head: [['No', 'Category ID', 'From Branch', 'To Branch', 'Items', 'Value', 'Status']],
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
  doc.save('transfer-records-data.pdf');
}

// Export to Excel function
function exportToExcel() {
  // Prepare data for Excel
  const excelData = filteredData.map((item, index) => ({
    'No': index + 1,
    'Category ID': item.categoryId,
    'From Branch': item.fromBranch,
    'To Branch': item.toBranch,
    'Items': item.items,
    'Value': item.value,
    'Status': item.status
  }));
  
  // Create workbook and worksheet
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.json_to_sheet(excelData);
  
  // Add worksheet to workbook
  XLSX.utils.book_append_sheet(wb, ws, 'Transfer Records Data');
  
  // Save the Excel file
  XLSX.writeFile(wb, 'transfer-records-data.xlsx');
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
function updateBarChartInsight(branch) {
  const insight = barChartData[currentYear].insights[branch] || 
                 `Branch ${branch} shows consistent transfer patterns with seasonal variations.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: ${branch}</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('barChartInsight').innerHTML = insightHTML;
}

// Update insight untuk line chart
function updateLineChartInsight(branch) {
  const lineInsights = {
    "IKEA Alam Sutera": "IKEA Alam Sutera shows consistent transfer pattern with 12% increase QoQ. Peak transfers in Q2 due to seasonal factors.",
    "IKEA Jakarta GC": "IKEA Jakarta GC maintains stable transfer rates with excellent branch coordination measures.",
    "IKEA Sentul City": "IKEA Sentul City shows improving trend with better inventory management systems.",
    "IKEA Bali": "IKEA Bali demonstrates consistent performance with minimal transfer fluctuations.",
    "IKEA Kota Baru Parahyangan": "IKEA Kota Baru Parahyangan shows steady growth in transfers with good processing times."
  };
  
  const insight = lineInsights[branch] || 
                `Branch ${branch} shows consistent transfer patterns with seasonal variations.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: ${branch} Trend</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('lineChartInsight').innerHTML = insightHTML;
}

// Render Transfers Table with Row Numbers
function renderTransfersTable(page = 1) {
  const startIndex = (page - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  const tableBody = document.getElementById('transfersTableBody');
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

  pageData.forEach((item, index) => {
    const row = document.createElement('tr');
    
    const statusClass = item.status === 'Completed' ? 'status-active' : 
                       item.status === 'In Progress' ? 'status-trending' : 'status-stable';
    
    const rowNumber = startIndex + index + 1;
    
    row.innerHTML = `
      <td style="color: #374151; font-weight: 600;">${rowNumber}</td>
      <td><span class="brand-id">${item.categoryId}</span></td>
      <td><span class="brand-name">${item.fromBranch}</span></td>
      <td><span class="brand-name">${item.toBranch}</span></td>
      <td><span class="brand-category">${item.items}</span></td>
      <td><span class="brand-price">${item.value}</span></td>
      <td><span class="brand-status ${statusClass}">${item.status}</span></td>
      <td>
        <button class="btn btn-sm btn-outline-primary" onclick="showTransferDetails(${JSON.stringify(item).replace(/"/g, '&quot;')})">
          <i class="fas fa-eye"></i>
        </button>
      </td>
    `;
    
    tableBody.appendChild(row);
  });

  // Update pagination info
  const totalItems = filteredData.length;
  const startItem = startIndex + 1;
  const endItem = Math.min(endIndex, totalItems);
  document.getElementById('paginationInfo').textContent = 
    `Showing ${startItem}-${endItem} of ${totalItems} transfers`;

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
  document.getElementById('page4Btn').classList.toggle('active', page === 4);
  
  // Hide/show page buttons based on total pages
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
  document.getElementById('page4Btn').style.display = totalPages >= 4 ? 'inline-block' : 'none';
}

// Change Page Function
function changePage(direction) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  const newPage = currentPage + direction;
  if (newPage >= 1 && newPage <= totalPages) {
    currentPage = newPage;
    renderTransfersTable(currentPage);
  }
}

// Go to Specific Page
function goToPage(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (page >= 1 && page <= totalPages) {
    currentPage = page;
    renderTransfersTable(currentPage);
  }
}

// Inisialisasi Bar Chart
function initBarChart(year) {
  const data = barChartData[year];
  currentYear = year;

  const options = {
    series: [{
      data: data.transfers
    }],
    chart: {
      type: 'bar',
      height: 250,
      toolbar: {
        show: true
      },
      events: {
        dataPointSelection: function(event, chartContext, config) {
          const branch = data.branches[config.dataPointIndex];
          updateBarChartInsight(branch);
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
      categories: data.branches,
    },
    yaxis: {
      title: {
      },
      labels: {
        formatter: function(val) {
          return val + ' transfers';
        }
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' transfers';
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
    colors: donutChartData.colors,
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
          const branch = data[config.seriesIndex].name;
          updateLineChartInsight(branch);
        },
        legendClick: function(chartContext, seriesIndex, config) {
          const branch = data[seriesIndex].name;
          updateLineChartInsight(branch);
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
    colors: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9', '#bbdefb'],
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
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
    },
    yaxis: {
      title: {
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' transfers';
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

// Show Transfer Details Modal
function showTransferDetails(transfer) {
  // Populate modal with transfer data
  document.getElementById('modalTransferId').textContent = transfer.categoryId;
  document.getElementById('modalTransferDate').textContent = new Date().toLocaleDateString();
  document.getElementById('modalCategory').textContent = transfer.items;
  document.getElementById('modalFromBranch').textContent = transfer.fromBranch;
  document.getElementById('modalToBranch').textContent = transfer.toBranch;
  document.getElementById('modalValue').textContent = transfer.value;
  
  // Set status with appropriate badge color
  const statusElement = document.getElementById('modalStatus');
  statusElement.textContent = transfer.status;
  statusElement.className = 'ms-2 badge ' + 
    (transfer.status === 'Completed' ? 'bg-success' : 
     transfer.status === 'In Progress' ? 'bg-warning' : 'bg-secondary');
  
  // Set additional mock data
  document.getElementById('modalDistance').textContent = Math.floor(Math.random() * 100) + 20 + ' km';
  document.getElementById('modalEstimatedTime').textContent = (Math.random() * 3 + 1).toFixed(1) + ' hours';
  document.getElementById('modalTransportCost').textContent = 'Rp ' + (Math.floor(Math.random() * 200000) + 100000).toLocaleString();
  document.getElementById('modalInsurance').textContent = 'Rp ' + (Math.floor(Math.random() * 50000) + 20000).toLocaleString();
  document.getElementById('modalTotalCost').textContent = 'Rp ' + (Math.floor(Math.random() * 500000) + 2000000).toLocaleString();
  document.getElementById('modalProcessingTime').textContent = (Math.random() * 2 + 1).toFixed(1) + ' days';
  document.getElementById('modalSuccessRate').textContent = (Math.floor(Math.random() * 10) + 90) + '%';
  document.getElementById('modalBranchRating').innerHTML = '<span class="text-warning">★★★★☆</span> ' + (Math.random() * 1 + 4).toFixed(1) + '/5.0';
  
  const priorities = ['High', 'Medium', 'Low'];
  const priorityColors = ['bg-danger', 'bg-warning', 'bg-success'];
  const randomPriority = Math.floor(Math.random() * 3);
  const priorityElement = document.getElementById('modalPriority');
  priorityElement.textContent = priorities[randomPriority];
  priorityElement.className = 'ms-2 badge ' + priorityColors[randomPriority];
  
  document.getElementById('modalItemsCount').textContent = Math.floor(Math.random() * 200) + 50 + ' units';
  document.getElementById('modalWeight').textContent = (Math.random() * 3000 + 1000).toFixed(0) + ' kg';
  document.getElementById('modalVolume').textContent = Math.floor(Math.random() * 50) + 20 + ' m³';
  document.getElementById('modalInstructions').textContent = 'Handle with care - ' + transfer.items.toLowerCase() + ' items';
  
  // Show the modal
  const modal = new bootstrap.Modal(document.getElementById('transferDetailsModal'));
  modal.show();
}

// Edit Transfer Function
function editTransfer() {
  alert('Edit transfer functionality would redirect to edit page');
  // In real implementation: window.location.href = 'edittransfer.php?id=' + transferId;
}

// Print Transfer Details
function printTransferDetails() {
  const transferId = document.getElementById('modalTransferId').textContent;
  const fromBranch = document.getElementById('modalFromBranch').textContent;
  const toBranch = document.getElementById('modalToBranch').textContent;
  const value = document.getElementById('modalValue').textContent;
  const status = document.getElementById('modalStatus').textContent;
  const category = document.getElementById('modalCategory').textContent;
  
  const printContent = `
    <div style="text-align: center; margin-bottom: 30px;">
      <h2 style="color: #1976d2; margin-bottom: 5px;">IKEA Transfer Details</h2>
      <p style="color: #666; margin: 0;">Transfer Management System</p>
      <hr style="border: 1px solid #1976d2; width: 200px; margin: 20px auto;">
    </div>
    
    <div style="margin-bottom: 25px;">
      <h4 style="color: #1976d2; border-bottom: 2px solid #e3f2fd; padding-bottom: 8px;">Transfer Information</h4>
      <table style="width: 100%; margin-top: 15px;">
        <tr><td style="padding: 8px 0; font-weight: bold; width: 30%;">Transfer ID:</td><td>${transferId}</td></tr>
        <tr><td style="padding: 8px 0; font-weight: bold;">Date:</td><td>${new Date().toLocaleDateString()}</td></tr>
        <tr><td style="padding: 8px 0; font-weight: bold;">Category:</td><td>${category}</td></tr>
        <tr><td style="padding: 8px 0; font-weight: bold;">Status:</td><td>${status}</td></tr>
      </table>
    </div>
    
    <div style="margin-bottom: 25px;">
      <h4 style="color: #1976d2; border-bottom: 2px solid #e3f2fd; padding-bottom: 8px;">Location Details</h4>
      <table style="width: 100%; margin-top: 15px;">
        <tr><td style="padding: 8px 0; font-weight: bold; width: 30%;">From Branch:</td><td>${fromBranch}</td></tr>
        <tr><td style="padding: 8px 0; font-weight: bold;">To Branch:</td><td>${toBranch}</td></tr>
        <tr><td style="padding: 8px 0; font-weight: bold;">Transfer Value:</td><td style="color: #4caf50; font-weight: bold;">${value}</td></tr>
      </table>
    </div>
    
    <div style="margin-top: 40px; text-align: center; color: #666; font-size: 12px;">
      <p>Generated on ${new Date().toLocaleString()}</p>
      <p>IKEA Transfer Management System</p>
    </div>
  `;
  
  document.getElementById('printContent').innerHTML = printContent;
  const printModal = new bootstrap.Modal(document.getElementById('printModal'));
  printModal.show();
}

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
  // Hide loader
  setTimeout(function() {
    document.getElementById('global-loader').style.display = 'none';
  }, 1000);

  initBarChart('2025');
  initDonutChart();
  initLineChart('2025');
  renderTransfersTable(1);
  updateTotalTransfersText();
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