<?php
require_once __DIR__ . '/../include/config.php';
require_once __DIR__ . '/../AI-integrated/AI-CHAT.PHP';
// *** TAMBAHAN: Include AI Helper untuk Supplier Return ***
require_once __DIR__ . '/ai_helper_supplier_return.php';

// *** TAMBAHAN: Get AI Insight ***
$aiInsight = getSupplierReturnAIInsight();
$aiData = $aiInsight['data'];

// *** TAMBAHAN: Extract solutions dari AI recommendation ***
function extractSupplierReturnSolutions($recommendation) {
  $solutions = [];
  $text = strtolower($recommendation);
  
  if (strpos($text, 'quality_control') !== false || strpos($text, 'audit') !== false) {
      $solutions = [
          "Lakukan audit kualitas mendalam untuk supplier dalam 7 hari",
          "Implementasi additional QC checkpoint untuk kategori return",
          "Review dan update kontrak supplier dengan penalty clause",
          "Setup real-time quality monitoring dashboard"
      ];
  } elseif (strpos($text, 'cost_reduction') !== false || strpos($text, 'biaya') !== false) {
      $solutions = [
          "Implementasi bulk return processing untuk mengurangi handling cost",
          "Negosiasi return shipping cost dengan supplier",
          "Setup automated return approval untuk item low-value",
          "Analisis root cause return untuk mencegah future returns"
      ];
  } elseif (strpos($text, 'process_optimization') !== false || strpos($text, 'processing') !== false) {
      $solutions = [
          "Implementasi automated return workflow untuk supplier",
          "Setup express lane untuk return processing",
          "Integrasi sistem return dengan supplier untuk real-time update",
          "Training tim untuk optimized return handling procedures"
      ];
  } elseif (strpos($text, 'supplier_performance') !== false || strpos($text, 'benchmark') !== false) {
      $solutions = [
          "Gunakan supplier sebagai benchmark untuk kategori return",
          "Analisis best practices untuk diterapkan ke supplier lain",
          "Pertimbangkan untuk meningkatkan volume order",
          "Setup supplier performance review meeting"
      ];
  } else {
      // Default solutions
      $supplierName = $aiData['supplier_name'] ?? 'Supplier';
      $category = $aiData['return_category'] ?? 'Category';
      $solutions = [
          "Lakukan comprehensive analysis untuk supplier {$supplierName}",
          "Monitor return patterns untuk kategori {$category}",
          "Setup regular supplier performance review meeting",
          "Implementasi continuous improvement program"
      ];
  }
  
  return $solutions;
}

$aiSolutions = extractSupplierReturnSolutions($aiData['recommendation']);

// *** TAMBAHAN: Format functions untuk AI data ***
function formatSupplierReturnInsightType($type) {
  $types = [
      'quality_control' => 'Quality Control',
      'cost_reduction' => 'Cost Reduction',
      'process_optimization' => 'Process Optimization',
      'supplier_performance' => 'Supplier Performance',
      'general' => 'General'
  ];
  
  return $types[$type] ?? ucfirst($type);
}

function formatSupplierReturnUrgency($urgency) {
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
<title>IKEA - Supplier Returns</title>

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

/* Modal Styles */
.detail-card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 15px;
}

.detail-header {
  font-size: 1rem;
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 12px;
  padding-bottom: 8px;
  border-bottom: 2px solid #e2e8f0;
}

.detail-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 0;
  border-bottom: 1px solid #f1f5f9;
}

.detail-item:last-child {
  border-bottom: none;
}

.detail-label {
  font-weight: 500;
  color: #64748b;
  font-size: 0.9rem;
}

.detail-value {
  font-weight: 600;
  color: #1e293b;
  font-size: 0.9rem;
}

.analytics-item {
  text-align: center;
  padding: 15px;
  background: white;
  border-radius: 8px;
  border: 1px solid #e2e8f0;
}

.analytics-number {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1976d2;
  margin-bottom: 5px;
}

.analytics-label {
  font-size: 0.8rem;
  color: #64748b;
  font-weight: 500;
}

.modal-content {
  border: none;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.modal-header {
  border-bottom: none;
}

.modal-footer {
  border-top: 1px solid #e2e8f0;
  background: #f8fafc;
}

.btn-close-white {
  filter: brightness(0) invert(1);
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
        <h4>Supplier Returns Dashboard</h4>
        <h6>Comprehensive returns analytics and management</h6>
      </div>
      <div class="page-btn">
        <a href="addreturn.php" class="btn btn-added">
          <img src="../assets/img/icons/plus.svg" class="me-1" alt="img">New Return
        </a>
      </div>
    </div>

    <!-- Revenue, Suppliers, Product Sold, Budget Spent -->
          <div class="row justify-content-end">
          <!-- 🔢 Total Returns -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4><span class="counters" data-count="124">124</span></h4>
                    <h5>Total Returns</h5>
                    <h2 class="stat-change">+8% from last month</h2>
                    </div>
                    <div class="icon-box bg-ungu">
                      <i class="fa fa-undo"></i>
                    </div>
                </div>
              </a>
            </div>

            <!-- 🛒 Total Value -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das2">
                  <div class="dash-counts">
                  <h4><span class="counters" data-count="8650">$8,650</span></h4>
                   <h5>Total Value</h5>
                  <h2 class="stat-change">+12% from last month</h2>
                </div>
                <div class="icon-box bg-biru">
                  <i class="fa fa-dollar-sign"></i>
                </div>
                </div>
              </a>
            </div>

             <!-- 📦 Avg Processing Days -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das3">
                  <div class="dash-counts">
                  <h4><span class="counters" data-count="3.2">3.2</span></h4> 
                  <h5>Avg. Processing Days</h5>                 
                    <h2 class="stat-change">-0.8 days improvement</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-clock"></i>
                  </div>
                </div>
              </a>
            </div>

            <!-- 🗂️ Top Supplier Returns -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="#" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                     <h4>28</h4>
                    <h5>Top Supplier Returns</h5>
                   <h2 class="stat-change">Apex Computers</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-user-tie"></i>
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
                  <h5 class="chart-title"><i class="fas fa-chart-bar me-2"></i>Return Growth Trend (Top 5 Categories)</h5>
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
                      <h5 style="font-size: 0.9rem;">Insight: Return Category Trends</h5>
                      <p class="mb-0">Furniture category shows stable growth with 8% QoQ increase. Small decline in June due to stock issues.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Donut Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-pie me-2"></i>Return Distribution by Supplier</h5>
                </div>
                <div id="donutChart" style="height: 200px;"></div>
                <div class="donut-legend" id="donutLegend"></div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Supplier Distribution</h5>
                      <p class="mb-0">Top 5 suppliers account for 72% of total returns. Apex Computers shows highest return rate (+15% YoY).</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Line Chart -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chart-line me-2"></i>Monthly Return Trend (Top 5 Suppliers)</h5>
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
                      <h5 id="lineChartInsightTitle" style="font-size: 0.9rem;">Insight: Return Trends</h5>
                      <p class="mb-0" id="lineChartInsightText">Apex Computers shows consistent return pattern with 12% increase QoQ. Peak returns in Q2 due to seasonal factors.</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Insight Produk Bersaing -->
              <div class="chart-section">
                <div class="chart-header">
                  <h5 class="chart-title"><i class="fas fa-chess-board me-2"></i>Insight "Top Returning Products" Supplier Comparison</h5>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%); border-radius: 10px; border: 1px solid rgba(25, 118, 210, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: var(--primary-blue); font-weight: 600;">Apex Computers vs Modern Automobile</h6>
                        <span style="background: var(--primary-blue); color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">Electronics</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #b8860b;">
                            <i class="fas fa-crown" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">Apex Computers</h6>
                          <small style="font-size: 0.7rem; color: #666;">28 returns | $2,450 | High</small>
                        </div>
                        <div style="margin: 0 10px;">
                          <div style="width: 25px; height: 25px; background: var(--danger-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; font-weight: 700;">VS</div>
                        </div>
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #666;">
                            <i class="fas fa-medal" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">Modern Automobile</h6>
                          <small style="font-size: 0.7rem; color: #666;">18 returns | $1,850 | Medium</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <div class="p-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%); border-radius: 10px; border: 1px solid rgba(25, 118, 210, 0.1);">
                      <div class="text-center mb-2">
                        <h6 class="mb-1" style="color: var(--primary-blue); font-weight: 600;">AIM Infotech vs Best Power Tools</h6>
                        <span style="background: var(--primary-blue); color: white; padding: 2px 8px; border-radius: 10px; font-size: 0.7rem;">Hardware</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #b8860b;">
                            <i class="fas fa-crown" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">AIM Infotech</h6>
                          <small style="font-size: 0.7rem; color: #666;">22 returns | $1,950 | High</small>
                        </div>
                        <div style="margin: 0 10px;">
                          <div style="width: 25px; height: 25px; background: var(--danger-red); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.6rem; font-weight: 700;">VS</div>
                        </div>
                        <div class="text-center" style="flex: 1;">
                          <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 5px; color: #666;">
                            <i class="fas fa-medal" style="font-size: 0.8rem;"></i>
                          </div>
                          <h6 style="font-size: 0.8rem; margin-bottom: 3px;">Best Power Tools</h6>
                          <small style="font-size: 0.7rem; color: #666;">15 returns | $1,420 | Medium</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="insight-container">
                  <div class="d-flex align-items-center">
                    <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
                    <div>
                      <h5 style="font-size: 0.9rem;">Insight: Supplier Competition</h5>
                      <p class="mb-0">Apex Computers leads in return volume but also highest value. AIM Infotech shows consistent return patterns with good processing times.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Column - Sidebar tetap di samping charts -->
            <div class="col-lg-4">
              <!-- Prediksi Return -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-calculator me-2"></i>Return Prediction per Month
                </div>
                <div class="sidebar-card-body">
                  <div class="d-flex align-items-center mb-2">
                    <div class="bg-light p-2 rounded-circle me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-chart-line text-primary" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                      <h5 class="mb-1" style="font-size: 1rem;">Apex Computers</h5>
                      <p class="mb-0" style="font-size: 0.85rem;">predicted <span class="fw-bold">32 returns</span> in August 2025</p>
                    </div>
                    <div class="ms-auto">
                      <span class="trend-indicator trend-up" style="font-size: 1.5rem;">▲</span>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Prediction accuracy:</p>
                      <div class="progress" style="height: 6px; width: 100px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <span class="fw-bold" style="font-size: 0.8rem;">85%</span>
                    </div>
                    <div>
                      <p class="mb-1" style="font-size: 0.8rem;">Compare with:</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Jul 2025: 28 returns</p>
                      <p class="mb-0 fw-bold" style="font-size: 0.8rem;">Aug 2024: 24 returns</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Notifikasi Kritis -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bell me-2"></i>Critical Return Notifications
                </div>
                <div class="sidebar-card-body">
                  <div class="notification-card warning">
                    <i class="fas fa-exclamation-triangle text-warning"></i>
                    <div>
                      <h5 class="mb-1">Furniture - High Return Rate Alert</h5>
                      <p class="mb-0">Critical return levels, investigate quality issues</p>
                    </div>
                  </div>
                  
                  <div class="notification-card danger">
                    <i class="fas fa-sync-alt text-danger"></i>
                    <div>
                      <h5 class="mb-1">Apex Computers - 5 Returns in 7 Days</h5>
                      <p class="mb-0">Return rate increased 45% from last week</p>
                    </div>
                  </div>
                  
                  <div class="notification-card info">
                    <i class="fas fa-thumbs-down text-info"></i>
                    <div>
                      <h5 class="mb-1">Customer Complaints - 8 Negative Reviews</h5>
                      <p class="mb-0">Main complaint: damaged during shipping</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Health Score -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-heartbeat me-2"></i>Supplier Health Score
                </div>
                <div class="sidebar-card-body">
                  <div class="health-score-item">
                    <div class="health-brand-info">
                      <h6>Modern Automobile</h6>
                      <p>Low return rate (2%), good processing time</p>
                    </div>
                    <div class="health-score-value">
                      <div class="health-score good">92/100</div>
                      <div class="health-progress">
                        <div class="health-fill good" style="width: 92%"></div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="health-score-item">
                    <div class="health-brand-info">
                      <h6>Apex Computers</h6>
                      <p>High return rate 15% increase, quality concerns</p>
                    </div>
                    <div class="health-score-value">
                      <div class="health-score poor">58/100</div>
                      <div class="health-progress">
                        <div class="health-fill poor" style="width: 58%"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Compact Supplier Readiness -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-bolt me-2"></i>Supplier Readiness Index
                </div>
                <div class="sidebar-card-body">
                  <div class="readiness-compact">
                    <div class="readiness-score-compact">78%</div>
                    <div class="readiness-brand-compact">Best Power Tools</div>
                    <div class="readiness-label-compact">Return-Ready Score</div>
                    
                    <div class="readiness-features-compact">
                      <div class="readiness-feature-compact">
                        <i class="fas fa-box-open text-success"></i>
                        <p>Low Returns</p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-star text-warning"></i>
                        <p>Quality 4.2</p>
                      </div>
                      <div class="readiness-feature-compact">
                        <i class="fas fa-chart-line text-primary"></i>
                        <p>Stable</p>
                      </div>
                    </div>
                    
                    <div class="readiness-progress-compact">
                      <div class="readiness-fill-compact" style="width: 78%"></div>
                    </div>
                    
                    <div class="readiness-status-compact">
                      ✓ Good Supplier Status
                    </div>
                  </div>
                </div>
              </div>

              <!-- Distribusi Lokasi -->
              <div class="sidebar-card">
                <div class="sidebar-card-header">
                  <i class="fas fa-map-marker-alt me-2"></i>Return Distribution by Store Location
                </div>
                <div class="sidebar-card-body">
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name">IKEA Alam Sutera</h6>
                      <span class="location-status-badge top">Highest Returns</span>
                    </div>
                    <p class="location-description">Most returns from:</p>
                    <div class="location-tags">
                      <span class="location-tag highlight">Apex Computers</span>
                      <span class="location-tag">AIM Infotech</span>
                      <span class="location-tag">Modern Auto</span>
                      <span class="location-tag">Best Tools</span>
                    </div>
                  </div>
                  
                  <div class="location-brand-section">
                    <div class="location-brand-header">
                      <h6 class="location-brand-name">IKEA Jakarta Garden City</h6>
                      <span class="location-status-badge rising">Rising Returns</span>
                    </div>
                    <p class="location-description">Popular returns:</p>
                    <div class="location-tags">
                      <span class="location-tag">Best Tools</span>
                      <span class="location-tag highlight">Hatimi Hardware</span>
                      <span class="location-tag">Modern Auto</span>
                      <span class="location-tag">AIM Infotech</span>
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
                    AI Suggestion: <?= formatSupplierReturnInsightType($aiData['insight_type']) ?>
                  </h4>
                </div>
                <p class="suggestion-content" id="aiSuggestionContent">
                  <?= htmlspecialchars($aiData['recommendation']) ?>
                </p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <small style="opacity: 0.8;" id="aiSuggestionMeta">
                    <?= $aiData['supplier_name'] ?? 'General' ?> • <?= $aiData['return_category'] ?? 'Category' ?> • <?= formatSupplierReturnUrgency($aiData['urgency']) ?>
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

          <!-- Enhanced Supplier Returns Data Table - Full Width Professional with Search & Export -->
          <div class="brand-table-section">
            <div class="chart-header">
              <h5 class="chart-title"><i class="fas fa-table me-2"></i>Recent Supplier Returns</h5>
              <div class="d-flex align-items-center gap-2">
                <span style="font-size: 0.8rem; color: #64748b;" id="totalReturnsText">Total: 12 returns</span>
              </div>
            </div>
            
            <!-- Table Controls -->
            <div class="table-controls">
              <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Search supplier, reference, or status...">
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
            
            <table class="brand-table" id="returnsTable">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Image</th>
                  <th>Date</th>
                  <th>Supplier</th>
                  <th>To Storage</th>
                  <th>Reference</th>
                  <th>Grand Total ($)</th>
                  <th>Paid ($)</th>
                  <th>Due ($)</th>
                  <th>Payment Status</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="returnsTableBody">
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
                Showing 1-4 of 12 returns
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

<!-- Supplier Return Details Modal -->
<div class="modal fade" id="returnDetailsModal" tabindex="-1" aria-labelledby="returnDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%); color: white;">
        <h5 class="modal-title" id="returnDetailsModalLabel">
          <i class="fas fa-file-alt me-2"></i>Supplier Return Details
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Left Column -->
          <div class="col-md-6">
            <div class="detail-card mb-3">
              <h6 class="detail-header">
                <i class="fas fa-info-circle text-primary me-2"></i>Basic Information
              </h6>
              <div class="detail-item">
                <span class="detail-label">Reference:</span>
                <span class="detail-value" id="modalReference">-</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">Date:</span>
                <span class="detail-value" id="modalDate">-</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">Supplier:</span>
                <span class="detail-value" id="modalSupplier">-</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">Storage Location:</span>
                <span class="detail-value" id="modalStorage">-</span>
              </div>
            </div>

            <div class="detail-card mb-3">
              <h6 class="detail-header">
                <i class="fas fa-dollar-sign text-success me-2"></i>Financial Details
              </h6>
              <div class="detail-item">
                <span class="detail-label">Grand Total:</span>
                <span class="detail-value text-primary fw-bold" id="modalTotal">-</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">Amount Paid:</span>
                <span class="detail-value text-success fw-bold" id="modalPaid">-</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">Amount Due:</span>
                <span class="detail-value text-danger fw-bold" id="modalDue">-</span>
              </div>
            </div>
          </div>

          <!-- Right Column -->
          <div class="col-md-6">
            <div class="detail-card mb-3">
              <h6 class="detail-header">
                <i class="fas fa-clipboard-check text-warning me-2"></i>Status Information
              </h6>
              <div class="detail-item">
                <span class="detail-label">Payment Status:</span>
                <span class="detail-value" id="modalPaymentStatus">-</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">Return Status:</span>
                <span class="detail-value" id="modalStatus">-</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">Processing Time:</span>
                <span class="detail-value" id="modalProcessingTime">-</span>
              </div>
            </div>

            <div class="detail-card mb-3">
              <h6 class="detail-header">
                <i class="fas fa-image text-info me-2"></i>Product Image
              </h6>
              <div class="text-center">
                <img id="modalProductImage" src="/placeholder.svg" alt="Product" class="img-fluid rounded" style="max-height: 150px; border: 2px solid #e2e8f0;">
              </div>
            </div>
          </div>
        </div>

        <!-- Additional Information -->
        <div class="row mt-3">
          <div class="col-12">
            <div class="detail-card">
              <h6 class="detail-header">
                <i class="fas fa-chart-line text-purple me-2"></i>Return Analytics
              </h6>
              <div class="row">
                <div class="col-md-4">
                  <div class="analytics-item">
                    <div class="analytics-number" id="modalReturnRate">-</div>
                    <div class="analytics-label">Return Rate</div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="analytics-item">
                    <div class="analytics-number" id="modalSupplierRating">-</div>
                    <div class="analytics-label">Supplier Rating</div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="analytics-item">
                    <div class="analytics-number" id="modalCategory">-</div>
                    <div class="analytics-label">Category</div>
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
        <button type="button" class="btn btn-primary" onclick="editReturn()">
          <i class="fas fa-edit me-2"></i>Edit Return
        </button>
        <button type="button" class="btn btn-success" onclick="printReturn()">
          <i class="fas fa-print me-2"></i>Print Details
        </button>
      </div>
    </div>
  </div>
</div>

    </div>
  </div>
</div>

<script>
// *** TAMBAHAN: Fungsi refresh AI suggestion - SAMA SEPERTI CATEGORYLIST ***
function refreshAISolutions() {
  console.log('AI Solutions refreshed for supplier returns');
  // Optional: Add refresh functionality for solutions if needed
  
  // Simulate fetching new AI solutions
  fetch('get_supplier_return_ai_solution.php')
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              // Update solutions display
              const solutionsBody = document.querySelector('.solutions-body');
              if (solutionsBody && data.data.solutions) {
                  solutionsBody.innerHTML = '';
                  data.data.solutions.forEach((solution, index) => {
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

// Data dummy untuk visualisasi - MENGGUNAKAN DATA SUPPLIER RETURNS
const barChartData = {
  2025: {
    categories: ["Furniture", "Electronics", "Hardware", "Automotive", "Tools"],
    returns: [45, 38, 32, 28, 22], // dalam unit
    insights: {
      "Furniture": "Furniture category shows stable growth with 8% QoQ increase. Small decline in June due to stock issues.",
      "Electronics": "Electronics returns increased 15% due to quality issues from Apex Computers supplier.",
      "Hardware": "Hardware returns remain consistent with seasonal patterns, mainly from AIM Infotech.",
      "Automotive": "Automotive returns decreased 5% after implementing better quality control measures with Modern Automobile.",
      "Tools": "Tools category shows steady performance with Best Power Tools maintaining good return rates."
    }
  },
  2024: {
    categories: ["Electronics", "Furniture", "Hardware", "Tools", "Automotive"],
    returns: [42, 35, 30, 25, 20],
    insights: {
      "Electronics": "Electronics dominated returns in 2024 with consistent issues from multiple suppliers.",
      "Furniture": "Furniture returns were stable throughout 2024 with seasonal variations.",
      "Hardware": "Hardware category showed improvement in Q4 2024 after supplier negotiations.",
      "Tools": "Tools returns increased slightly due to new supplier onboarding issues.",
      "Automotive": "Automotive returns were lowest in 2024 with excellent supplier performance."
    }
  },
  2023: {
    categories: ["Hardware", "Electronics", "Furniture", "Automotive", "Tools"],
    returns: [38, 32, 28, 24, 18],
    insights: {
      "Hardware": "Hardware led returns in 2023 during the initial supplier evaluation period.",
      "Electronics": "Electronics returns were moderate with gradual supplier improvements.",
      "Furniture": "Furniture category maintained steady return patterns throughout 2023.",
      "Automotive": "Automotive returns started high but improved significantly by year-end.",
      "Tools": "Tools category had lowest returns in 2023 with excellent supplier relationships."
    }
  }
};

// Beautiful Blue, Purple, and Teal Color Variations for Charts
const donutChartData = {
  labels: ["Apex Computers", "Modern Automobile", "AIM Infotech", "Best Power Tools", "Hatimi Hardware", "Others"],
  series: [28, 22, 18, 15, 12, 5], // persentase
  colors: ['#1976d2', '#42a5f5', '#64b5f6', '#90caf9', '#bbdefb', '#e3f2fd']
};

const lineChartData = {
  2025: [
    { name: "Apex Computers", data: [25, 28, 32, 35, 38, 36, 40, 42] },
    { name: "Modern Automobile", data: [18, 20, 22, 24, 26, 28, 30, 32] },
    { name: "AIM Infotech", data: [22, 24, 26, 25, 27, 28, 29, 30] },
    { name: "Best Power Tools", data: [20, 19, 21, 22, 23, 24, 25, 26] },
    { name: "Hatimi Hardware", data: [15, 16, 17, 18, 19, 20, 21, 22] }
  ],
  2024: [
    { name: "Apex Computers", data: [22, 24, 26, 28, 30, 32, 34, 36] },
    { name: "Modern Automobile", data: [16, 18, 20, 22, 24, 26, 28, 30] },
    { name: "AIM Infotech", data: [20, 22, 24, 23, 25, 26, 27, 28] },
    { name: "Best Power Tools", data: [18, 17, 19, 20, 21, 22, 23, 24] },
    { name: "Hatimi Hardware", data: [12, 14, 15, 16, 17, 18, 19, 20] }
  ],
  2023: [
    { name: "AIM Infotech", data: [18, 20, 22, 21, 23, 24, 25, 26] },
    { name: "Apex Computers", data: [20, 22, 24, 26, 28, 30, 32, 34] },
    { name: "Modern Automobile", data: [14, 16, 18, 20, 22, 24, 26, 28] },
    { name: "Best Power Tools", data: [16, 15, 17, 18, 19, 20, 21, 22] },
    { name: "Hatimi Hardware", data: [10, 12, 13, 14, 15, 16, 17, 18] }
  ]
};

// Supplier Returns Data for Table
const returnsData = [
  { 
    id: 1, 
    image: "product1.jpg", 
    date: "19/11/2022", 
    supplier: "Apex Computers", 
    storage: "IKEA Alam Sutera", 
    reference: "RT0001", 
    total: 2450.00, 
    paid: 2450.00, 
    due: 0.00, 
    paymentStatus: "Paid", 
    status: "Received" 
  },
  { 
    id: 2, 
    image: "product2.jpg", 
    date: "18/11/2022", 
    supplier: "Modern Automobile", 
    storage: "IKEA Sentul City", 
    reference: "RT0002", 
    total: 1850.00, 
    paid: 925.00, 
    due: 925.00, 
    paymentStatus: "Partial", 
    status: "Ordered" 
  },
  { 
    id: 3, 
    image: "product3.jpg", 
    date: "17/11/2022", 
    supplier: "AIM Infotech", 
    storage: "IKEA Jakarta Garden City", 
    reference: "RT0003", 
    total: 1950.00, 
    paid: 1950.00, 
    due: 0.00, 
    paymentStatus: "Paid", 
    status: "Received" 
  },
  { 
    id: 4, 
    image: "product4.jpg", 
    date: "16/11/2022", 
    supplier: "Best Power Tools", 
    storage: "IKEA Kota Baru Parahyangan", 
    reference: "RT0004", 
    total: 1420.00, 
    paid: 0.00, 
    due: 1420.00, 
    paymentStatus: "Unpaid", 
    status: "Pending" 
  },
  { 
    id: 5, 
    image: "product5.jpg", 
    date: "15/11/2022", 
    supplier: "Hatimi Hardware & Tools", 
    storage: "IKEA Bali", 
    reference: "RT0005", 
    total: 3200.00, 
    paid: 3200.00, 
    due: 0.00, 
    paymentStatus: "Paid", 
    status: "Received" 
  },
  { 
    id: 6, 
    image: "product6.jpg", 
    date: "14/11/2022", 
    supplier: "Apex Computers", 
    storage: "IKEA Mal Taman Anggrek", 
    reference: "RT0006", 
    total: 2750.00, 
    paid: 1375.00, 
    due: 1375.00, 
    paymentStatus: "Partial", 
    status: "Ordered" 
  },
  { 
    id: 7, 
    image: "product7.jpg", 
    date: "13/11/2022", 
    supplier: "Modern Automobile", 
    storage: "IKEA Alam Sutera", 
    reference: "RT0007", 
    total: 1680.00, 
    paid: 1680.00, 
    due: 0.00, 
    paymentStatus: "Paid", 
    status: "Received" 
  },
  { 
    id: 8, 
    image: "product8.jpg", 
    date: "12/11/2022", 
    supplier: "AIM Infotech", 
    storage: "IKEA Sentul City", 
    reference: "RT0008", 
    total: 2100.00, 
    paid: 0.00, 
    due: 2100.00, 
    paymentStatus: "Unpaid", 
    status: "Pending" 
  },
  { 
    id: 9, 
    image: "product9.jpg", 
    date: "11/11/2022", 
    supplier: "Best Power Tools", 
    storage: "IKEA Jakarta Garden City", 
    reference: "RT0009", 
    total: 1890.00, 
    paid: 1890.00, 
    due: 0.00, 
    paymentStatus: "Paid", 
    status: "Received" 
  },
  { 
    id: 10, 
    image: "product10.jpg", 
    date: "10/11/2022", 
    supplier: "Hatimi Hardware & Tools", 
    storage: "IKEA Kota Baru Parahyangan", 
    reference: "RT0010", 
    total: 2350.00, 
    paid: 1175.00, 
    due: 1175.00, 
    paymentStatus: "Partial", 
    status: "Ordered" 
  },
  { 
    id: 11, 
    image: "product1.jpg", 
    date: "09/11/2022", 
    supplier: "Apex Computers", 
    storage: "IKEA Bali", 
    reference: "RT0011", 
    total: 2980.00, 
    paid: 2980.00, 
    due: 0.00, 
    paymentStatus: "Paid", 
    status: "Received" 
  },
  { 
    id: 12, 
    image: "product2.jpg", 
    date: "08/11/2022", 
    supplier: "Modern Automobile", 
    storage: "IKEA Mal Taman Anggrek", 
    reference: "RT0012", 
    total: 1750.00, 
    paid: 0.00, 
    due: 1750.00, 
    paymentStatus: "Unpaid", 
    status: "Pending" 
  }
];

// Pagination and search variables
let currentPage = 1;
let itemsPerPage = 4;
let filteredData = [...returnsData];
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
    filteredData = [...returnsData];
  } else {
    filteredData = returnsData.filter(item => 
      item.supplier.toLowerCase().includes(searchQuery) ||
      item.reference.toLowerCase().includes(searchQuery) ||
      item.status.toLowerCase().includes(searchQuery) ||
      item.paymentStatus.toLowerCase().includes(searchQuery) ||
      item.storage.toLowerCase().includes(searchQuery)
    );
  }
  
  currentPage = 1;
  updateTotalPages();
  renderReturnsTable(currentPage);
  updateTotalReturnsText();
}

// Update total pages based on filtered data
function updateTotalPages() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  
  // Show/hide pagination buttons based on total pages
  document.getElementById('page1Btn').style.display = totalPages >= 1 ? 'inline-block' : 'none';
  document.getElementById('page2Btn').style.display = totalPages >= 2 ? 'inline-block' : 'none';
  document.getElementById('page3Btn').style.display = totalPages >= 3 ? 'inline-block' : 'none';
}

// Update total returns text
function updateTotalReturnsText() {
  const totalText = document.getElementById('totalReturnsText');
  if (searchQuery === '') {
    totalText.textContent = `Total: ${returnsData.length} returns`;
  } else {
    totalText.textContent = `Found: ${filteredData.length} of ${returnsData.length} returns`;
  }
}

// Export to PDF function
function exportToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  
  // Add title
  doc.setFontSize(16);
  doc.text('Supplier Returns Data', 14, 22);
  
  // Add export date
  doc.setFontSize(10);
  doc.text(`Exported on: ${new Date().toLocaleDateString('en-US')}`, 14, 30);
  
  // Prepare table data
  const tableData = filteredData.map((item, index) => [
    index + 1,
    item.date,
    item.supplier,
    item.storage,
    item.reference,
    '$' + item.total.toFixed(2),
    '$' + item.paid.toFixed(2),
    '$' + item.due.toFixed(2),
    item.paymentStatus,
    item.status
  ]);
  
  // Add table
  doc.autoTable({
    head: [['No', 'Date', 'Supplier', 'Storage', 'Reference', 'Total', 'Paid', 'Due', 'Payment', 'Status']],
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
  doc.save('supplier-returns-data.pdf');
}

// Export to Excel function
function exportToExcel() {
  // Prepare data for Excel
  const excelData = filteredData.map((item, index) => ({
    'No': index + 1,
    'Date': item.date,
    'Supplier': item.supplier,
    'To Storage': item.storage,
    'Reference': item.reference,
    'Grand Total ($)': item.total,
    'Paid ($)': item.paid,
    'Due ($)': item.due,
    'Payment Status': item.paymentStatus,
    'Status': item.status
  }));
  
  // Create workbook and worksheet
  const wb = XLSX.utils.book_new();
  const ws = XLSX.utils.json_to_sheet(excelData);
  
  // Add worksheet to workbook
  XLSX.utils.book_append_sheet(wb, ws, 'Supplier Returns Data');
  
  // Save the Excel file
  XLSX.writeFile(wb, 'supplier-returns-data.xlsx');
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
function updateBarChartInsight(category) {
  const insight = barChartData[currentYear].insights[category] || 
                 `Category ${category} shows consistent return patterns with seasonal variations.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: ${category} Category</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('barChartInsight').innerHTML = insightHTML;
}

// Update insight untuk line chart
function updateLineChartInsight(supplier) {
  const lineInsights = {
    "Apex Computers": "Apex Computers shows consistent return pattern with 12% increase QoQ. Peak returns in Q2 due to seasonal factors.",
    "Modern Automobile": "Modern Automobile maintains stable return rates with excellent quality control measures.",
    "AIM Infotech": "AIM Infotech shows improving trend with better supplier relationship management.",
    "Best Power Tools": "Best Power Tools demonstrates consistent performance with minimal return fluctuations.",
    "Hatimi Hardware": "Hatimi Hardware shows steady growth in returns but maintains good processing times."
  };
  
  const insight = lineInsights[supplier] || 
                `Supplier ${supplier} shows consistent return patterns with seasonal variations.`;

  const insightHTML = `
    <div class="d-flex align-items-center">
      <i class="fas fa-lightbulb text-warning me-2" style="font-size: 1.3rem;"></i>
      <div>
        <h5 style="font-size: 0.9rem;">Insight: ${supplier} Trend</h5>
        <p class="mb-0">${insight}</p>
      </div>
    </div>
  `;

  document.getElementById('lineChartInsight').innerHTML = insightHTML;
}

// Render Returns Table with Row Numbers
function renderReturnsTable(page = 1) {
  const startIndex = (page - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  const tableBody = document.getElementById('returnsTableBody');
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
    
    const paymentStatusClass = item.paymentStatus === 'Paid' ? 'status-active' : 
                              item.paymentStatus === 'Partial' ? 'status-trending' : 'status-stable';
    const statusClass = item.status === 'Received' ? 'status-active' : 
                       item.status === 'Ordered' ? 'status-trending' : 'status-stable';
    
    const rowNumber = startIndex + index + 1;
    
    row.innerHTML = `
      <td style="color: #374151; font-weight: 600;">${rowNumber}</td>
      <td>
        <img src="../assets/img/product/${item.image}" alt="product" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;" />
      </td>
      <td>${item.date}</td>
      <td><span class="brand-name">${item.supplier}</span></td>
      <td>${item.storage}</td>
      <td><span class="brand-id">${item.reference}</span></td>
      <td><span class="brand-price">$${item.total.toFixed(2)}</span></td>
      <td><span class="brand-sales">$${item.paid.toFixed(2)}</span></td>
      <td><span class="brand-price">$${item.due.toFixed(2)}</span></td>
      <td><span class="brand-status ${paymentStatusClass}">${item.paymentStatus}</span></td>
      <td><span class="brand-status ${statusClass}">${item.status}</span></td>
      <td>
        <button class="btn btn-sm btn-outline-primary" onclick="showReturnDetails(${item.id})">
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
    `Showing ${startItem}-${endItem} of ${totalItems} returns`;

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
    renderReturnsTable(currentPage);
  }
}

// Go to Specific Page
function goToPage(page) {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (page >= 1 && page <= totalPages) {
    currentPage = page;
    renderReturnsTable(currentPage);
  }
}

// Inisialisasi Bar Chart
function initBarChart(year) {
  const data = barChartData[year];
  currentYear = year;

  const options = {
    series: [{
      data: data.returns
    }],
    chart: {
      type: 'bar',
      height: 250,
      toolbar: {
        show: true
      },
      events: {
        dataPointSelection: function(event, chartContext, config) {
          const category = data.categories[config.dataPointIndex];
          updateBarChartInsight(category);
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
      categories: data.categories,
    },
    yaxis: {
      title: {
      },
      labels: {
        formatter: function(val) {
          return val + ' returns';
        }
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' returns';
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
          const supplier = data[config.seriesIndex].name;
          updateLineChartInsight(supplier);
        },
        legendClick: function(chartContext, seriesIndex, config) {
          const supplier = data[seriesIndex].name;
          updateLineChartInsight(supplier);
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
      strokeWidth: 2,
      fillOpacity: 1,
      strokeOpacity: 1,
      hover: {
        size: 6
      }
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
    },
    yaxis: {
      title: {
      },
      labels: {
        formatter: function(val) {
          return val + ' returns';
        }
      }
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return val + ' returns';
        }
      }
    },
    legend: {
      position: 'top',
      horizontalAlign: 'left',
      offsetX: 40
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'],
        opacity: 0.5
      }
    }
  };

  if (lineChart) {
    lineChart.destroy();
  }

  lineChart = new ApexCharts(document.querySelector("#lineChart"), options);
  lineChart.render();
}

// Show Return Details Modal
function showReturnDetails(returnId) {
  const returnItem = returnsData.find(item => item.id === returnId);
  if (!returnItem) return;

  // Populate modal with return data
  document.getElementById('modalReference').textContent = returnItem.reference;
  document.getElementById('modalDate').textContent = returnItem.date;
  document.getElementById('modalSupplier').textContent = returnItem.supplier;
  document.getElementById('modalStorage').textContent = returnItem.storage;
  document.getElementById('modalTotal').textContent = '$' + returnItem.total.toFixed(2);
  document.getElementById('modalPaid').textContent = '$' + returnItem.paid.toFixed(2);
  document.getElementById('modalDue').textContent = '$' + returnItem.due.toFixed(2);
  
  // Set payment status with appropriate styling
  const paymentStatusElement = document.getElementById('modalPaymentStatus');
  paymentStatusElement.textContent = returnItem.paymentStatus;
  paymentStatusElement.className = `detail-value ${
    returnItem.paymentStatus === 'Paid' ? 'text-success' : 
    returnItem.paymentStatus === 'Partial' ? 'text-warning' : 'text-danger'
  } fw-bold`;
  
  // Set status with appropriate styling
  const statusElement = document.getElementById('modalStatus');
  statusElement.textContent = returnItem.status;
  statusElement.className = `detail-value ${
    returnItem.status === 'Received' ? 'text-success' : 
    returnItem.status === 'Ordered' ? 'text-warning' : 'text-danger'
  } fw-bold`;
  
  // Set product image
  document.getElementById('modalProductImage').src = `../assets/img/product/${returnItem.image}`;
  
  // Set additional analytics data (simulated)
  document.getElementById('modalProcessingTime').textContent = '2.5 days';
  document.getElementById('modalReturnRate').textContent = '8.5%';
  document.getElementById('modalSupplierRating').textContent = '4.2/5';
  document.getElementById('modalCategory').textContent = 'Electronics';

  // Show modal
  const modal = new bootstrap.Modal(document.getElementById('returnDetailsModal'));
  modal.show();
}

// Edit Return Function
function editReturn() {
  alert('Edit return functionality would be implemented here');
}

// Print Return Function
function printReturn() {
  window.print();
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
  // Hide loader
  document.getElementById('global-loader').style.display = 'none';

  // Initialize charts
  initBarChart('2025');
  initDonutChart();
  initLineChart('2025');

  // Initialize table
  renderReturnsTable(1);
  updateTotalReturnsText();

  // Search functionality
  const searchInput = document.getElementById('searchInput');
  searchInput.addEventListener('input', function() {
    performSearch(this.value);
  });

  // Chart year selectors
  document.getElementById('barChartYear').addEventListener('change', function() {
    initBarChart(this.value);
  });

  document.getElementById('lineChartYear').addEventListener('change', function() {
    initLineChart(this.value);
  });

  // Initialize default insights
  updateBarChartInsight('Furniture');
  updateLineChartInsight('Apex Computers');

  // Counter animation
  const counters = document.querySelectorAll('.counters');
  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-count'));
    const increment = target / 100;
    let current = 0;
    
    const updateCounter = () => {
      if (current < target) {
        current += increment;
        counter.textContent = Math.ceil(current);
        setTimeout(updateCounter, 20);
      } else {
        counter.textContent = target;
      }
    };
    
    updateCounter();
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/js/jquery.slimscroll.min.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/plugins/select2/js/select2.min.js"></script>
<script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>
<script src="../assets/js/script.js"></script>

</body>
</html>
