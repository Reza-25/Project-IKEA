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
<title>Dreams Pos admin template</title>

<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/css/animate.css">

<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">

<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">   
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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

/* Tambahkan di dalam <head> setelah style yang sudah ada */
.table.datanew tbody tr:nth-child(even) {
    background-color: #f8fafc;
}
.table.datanew tbody tr:nth-child(odd) {
    background-color: #fff;
}
/* Hover effect pada baris */
.table.datanew tbody tr:hover {
    background-color: #e3f0fa !important;
    transition: background 0.2s;
    cursor: pointer;
}
/* Sedikit border radius pada cell */
.table.datanew td, .table.datanew th {
    border-radius: 6px;
    vertical-align: middle;
}

.card-header.bg-primary.text-white.text-center.py-2 {
  background: linear-gradient(90deg, #1976d2 0%, #64b5f6 100%) !important;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
.card-header.bg-success.text-white.text-center.py-2 {
  background: linear-gradient(90deg, #1976d2 0%, #64b5f6 100%) !important;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

#totalKaryawan {
  color: #1976d2 !important;
  font-weight: 700 !important;
  letter-spacing: 1px;
}

#selectedCabangInfo {
  margin-top: 32px !important;
  display: block;
  color: #1976d2 !important;
  font-size: 1rem !important;
  font-weight: 700 !important;
}

.card.h-100 {
  transition: box-shadow 0.25s, transform 0.25s;
  box-shadow: 0 2px 10px rgba(25, 118, 210, 0.07);
  animation: fadeInCard 0.7s cubic-bezier(.4,1.4,.6,1) both;
}
.card.h-100:hover {
  box-shadow: 0 8px 32px rgba(25, 118, 210, 0.18), 0 1.5px 6px rgba(44,62,80,0.07);
  transform: translateY(-6px) scale(1.02);
  z-index: 2;
}

@keyframes fadeInCard {
  0% {
    opacity: 0;
    transform: translateY(30px) scale(0.97);
  }
  100% {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

/* Hover effect untuk list cabang */
#listCabangKaryawan .list-group-item {
  transition: background 0.18s, color 0.18s, box-shadow 0.18s;
}
#listCabangKaryawan .list-group-item:hover {
  background: #e3f0fa;
  color: #1976d2;
  box-shadow: 0 2px 8px rgba(25, 118, 210, 0.10);
  cursor: pointer;
}

  .chart-container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .chart-header {
            background: linear-gradient(90deg, #1657b6 0%, #6ec6ff 100%);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chart-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .chart-tabs {
            display: flex;
            gap: 5px;
        }

        .tab-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background: rgba(255,255,255,0.9);
            color: #1657b6;
            font-weight: 600;
        }

        .tab-btn:hover:not(.active) {
            background: rgba(255,255,255,0.3);
        }

        .chart-body {
            padding: 20px;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .chart-content {
            display: none;
            height: 100%;
        }

        .chart-content.active {
            display: block;
        }

        /* Bar Chart Styles */
        .bar-chart {
            display: flex;
            align-items: end;
            justify-content: space-around;
            height: 220px;
            margin: 20px 0;
        }

        .bar {
            width: 70px;
            border-radius: 8px 8px 0 0;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .bar:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .bar.excellent {
            background: linear-gradient(to top, #2196f3, #0d47a1);
        }

        .bar.good {
            background: linear-gradient(to top, #FFCC00, #f59e0b);
        }

        .bar.average {
            background: linear-gradient(to top, #C8102E, #dc2626);
        }

        .bar-label {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 11px;
            color: #6b7280;
            font-weight: 500;
            text-align: center;
            width: 80px;
        }

        .bar-value {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            color: #1f2937;
            font-weight: 600;
        }

        /* Radar Chart Styles */
        .radar-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
            position: relative;
        }

        .radar-chart {
            width: 280px;
            height: 280px;
            position: relative;
        }

        .radar-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .radar-labels {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .radar-label {
            position: absolute;
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
            text-align: center;
            width: 80px;
            transform: translate(-50%, -50%);
        }

        .branch-selector {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .branch-btn {
            background: #e5e7eb;
            border: none;
            color: #374151;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .branch-btn.active {
            background: #1657b6;
            color: white;
        }

        /* Stacked Chart Styles */
        .stacked-chart {
            display: flex;
            align-items: end;
            justify-content: space-around;
            height: 220px;
            margin: 20px 0;
        }

        .stacked-bar {
            width: 70px;
            display: flex;
            flex-direction: column;
            position: relative;
            cursor: pointer;
        }

        .stacked-segment {
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .stacked-segment:hover {
            opacity: 0.8;
        }

        .tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            pointer-events: none;
            z-index: 1000;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .tooltip.show {
            opacity: 1;
        }

        .stacked-segment:first-child {
            border-radius: 8px 8px 0 0;
        }

        .stacked-segment.customer-handling {
            background: linear-gradient(to top, #2196f3, #0d47a1);
        }

        .stacked-segment.stock-management {
            background: linear-gradient(to top, #ff5858, #e78001);
        }

        .stacked-segment.operational-support {
            background: linear-gradient(to top, rgb(89, 236, 222), #018679);
        }

        .stacked-segment.team-collaboration {
            background: linear-gradient(to top, #a259c6, #6d28d9);
        }

        .stacked-bar:hover .stacked-segment {
            transform: scale(1.05);
        }

        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6b7280;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        .stats-info {
            text-align: center;
            margin-top: 10px;
            color: #6b7280;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .chart-container {
                margin: 10px;
                border-radius: 10px;
            }
            
            .chart-header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            
            .bar, .stacked-bar {
                width: 45px;
            }
            
            .chart-legend {
                flex-wrap: wrap;
                gap: 10px;
            }

            .radar-chart {
                width: 220px;
                height: 220px;
            }
        }
          /* Employee Card Styles */
/* Header Animation */
.header-animation {
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  animation: headerPulse 4s ease-in-out infinite;
}

@keyframes headerPulse {
  0%, 100% { transform: scale(1); opacity: 0.3; }
  50% { transform: scale(1.1); opacity: 0.6; }
}

.period-badge {
  background: rgba(255, 255, 255, 0.2);
  padding: 8px 20px;
  border-radius: 25px;
  font-size: 0.9rem;
  font-weight: 600;
  border: 2px solid rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(10px);
}

/* Enhanced Employee Card Styles */
.employee-card {
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  border: 2px solid #e3f2fd;
  border-radius: 20px;
  padding: 18px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
  height: fit-content;
  cursor: pointer;
}

.employee-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #2196f3 0%, #0d47a1 100%);
  border-radius: 20px 20px 0 0;
}

.employee-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(33, 150, 243, 0.2);
  border-color: #2196f3;
}

/* Rank Specific Styles */
.employee-card.rank-1 {
  background: linear-gradient(135deg, #fff8e1 0%, #ffffff 100%);
  border-color: #fcd116;
  box-shadow: 0 12px 30px rgba(252, 209, 22, 0.3);
}

.employee-card.rank-1::before {
  background: linear-gradient(90deg, #fcd116 0%, #f57c00 100%);
}

.employee-card.rank-1:hover {
  box-shadow: 0 20px 40px rgba(252, 209, 22, 0.4);
  border-color: #fcd116;
}

.employee-card.rank-2 {
  background: linear-gradient(135deg, #fafafa 0%, #ffffff 100%);
  border-color: #c0c0c0;
  box-shadow: 0 12px 30px rgba(192, 192, 192, 0.3);
}

.employee-card.rank-2::before {
  background: linear-gradient(90deg, #c0c0c0 0%, #9e9e9e 100%);
}

.employee-card.rank-2:hover {
  box-shadow: 0 20px 40px rgba(192, 192, 192, 0.4);
  border-color: #c0c0c0;
}

.employee-card.rank-3 {
  background: linear-gradient(135deg, #fff3e0 0%, #ffffff 100%);
  border-color: #cd7f32;
  box-shadow: 0 12px 30px rgba(205, 127, 50, 0.3);
}

.employee-card.rank-3::before {
  background: linear-gradient(90deg, #cd7f32 0%, #a0522d 100%);
}

.employee-card.rank-3:hover {
  box-shadow: 0 20px 40px rgba(205, 127, 50, 0.4);
  border-color: #cd7f32;
}

/* Medal Styles */
.rank-medal {
  position: absolute;
  top: -10px;
  right: 15px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3rem;
  font-weight: 800;
  color: white;
  z-index: 10;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}

.rank-medal.gold {
  background: linear-gradient(135deg, #fcd116 0%, #f57c00 100%);
  animation: goldGlow 2s ease-in-out infinite;
}

.rank-medal.silver {
  background: linear-gradient(135deg, #c0c0c0 0%, #9e9e9e 100%);
  animation: silverGlow 2s ease-in-out infinite;
}

.rank-medal.bronze {
  background: linear-gradient(135deg, #cd7f32 0%, #a0522d 100%);
  animation: bronzeGlow 2s ease-in-out infinite;
}

@keyframes goldGlow {
  0%, 100% { box-shadow: 0 6px 15px rgba(252, 209, 22, 0.5); }
  50% { box-shadow: 0 8px 20px rgba(252, 209, 22, 0.8); }
}

@keyframes silverGlow {
  0%, 100% { box-shadow: 0 6px 15px rgba(192, 192, 192, 0.5); }
  50% { box-shadow: 0 8px 20px rgba(192, 192, 192, 0.8); }
}

@keyframes bronzeGlow {
  0%, 100% { box-shadow: 0 6px 15px rgba(205, 127, 50, 0.5); }
  50% { box-shadow: 0 8px 20px rgba(205, 127, 50, 0.8); }
}

/* Top Performer Badge */
.top-performer {
  position: absolute;
  top: 12px;
  left: 15px;
  background: linear-gradient(135deg, #fcd116 0%, #f57c00 100%);
  color: #1a237e;
  padding: 6px 12px;
  border-radius: 15px;
  font-size: 0.7rem;
  font-weight: 700;
  box-shadow: 0 3px 10px rgba(252, 209, 22, 0.4);
  animation: topPerformerPulse 2s ease-in-out infinite;
}

@keyframes topPerformerPulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

/* Employee Info Section */
.employee-info {
  display: flex;
  align-items: center;
  gap: 20px;
}

.employee-info-compact {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 15px;
}

.employee-avatar {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  overflow: hidden;
  border: 4px solid #2196f3;
  box-shadow: 0 8px 20px rgba(33, 150, 243, 0.3);
  position: relative;
  transition: all 0.3s ease;
}

.employee-avatar-small {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  overflow: hidden;
  border: 3px solid #2196f3;
  box-shadow: 0 6px 15px rgba(33, 150, 243, 0.3);
  position: relative;
  transition: all 0.3s ease;
}

.employee-avatar:hover, .employee-avatar-small:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 25px rgba(33, 150, 243, 0.5);
}

.employee-avatar img, .employee-avatar-small img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.employee-avatar::after, .employee-avatar-small::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: 2px solid rgba(255, 255, 255, 0.5);
  border-radius: 50%;
}

.employee-details h6, .employee-details-compact h6 {
  font-size: 1.1rem;
  font-weight: 800;
  color: #1a237e;
  margin: 0 0 3px 0;
  cursor: pointer;
  transition: color 0.3s ease;
}

.employee-details-compact h6 {
  font-size: 1rem;
}

.employee-details h6:hover, .employee-details-compact h6:hover {
  color: #2196f3;
  text-shadow: 0 2px 4px rgba(33, 150, 243, 0.3);
}

.employee-role {
  font-size: 0.8rem;
  color: #5c6bc0;
  margin: 0 0 5px 0;
  font-weight: 600;
  display: inline-block;
}

.employee-location {
  font-size: 0.8rem;
  color: #2196f3;
  display: flex;
  align-items: center;
  gap: 4px;
  font-weight: 600;
}

.employee-name-role {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 5px;
}

/* Performance Metrics */
.performance-metrics {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.performance-metrics-compact {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-bottom: 15px;
}

.metric-item {
  display: flex;
  align-items: center;
  gap: 15px;
}

.metric-item-compact {
  display: flex;
  align-items: center;
  gap: 10px;
}

.metric-label {
  font-size: 0.85rem;
  font-weight: 600;
  color: #37474f;
  min-width: 110px;
}

.metric-bar {
  flex: 1;
  height: 10px;
  background: #e3f2fd;
  border-radius: 5px;
  overflow: hidden;
  position: relative;
}

.metric-bar-small {
  flex: 1;
  height: 8px;
  background: #e3f2fd;
  border-radius: 4px;
  overflow: hidden;
  position: relative;
}

.metric-progress {
  height: 100%;
  background: linear-gradient(90deg, #2196f3 0%, #0d47a1 100%);
  border-radius: 5px;
  transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
}

.metric-progress::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%);
  animation: shimmer 2s infinite;
}

@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

.metric-value {
  font-size: 0.85rem;
  font-weight: 700;
  color: #1a237e;
  min-width: 40px;
  text-align: right;
}

/* Overall Score */
.overall-score {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}

.overall-score-compact {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

.score-circle {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
  color: white;
  transition: all 0.3s ease;
}

.score-circle-small {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
  color: white;
  transition: all 0.3s ease;
}

.score-circle:hover, .score-circle-small:hover {
  transform: scale(1.05);
}

.score-circle.excellent, .score-circle-small.excellent {
  background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
}

.score-circle.good, .score-circle-small.good {
  background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
}

.score-circle.average, .score-circle-small.average {
  background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
}

.score-number {
  font-size: 1.6rem;
  font-weight: 800;
  line-height: 1;
}

.score-circle-small .score-number {
  font-size: 1.4rem;
}

.score-label {
  font-size: 0.65rem;
  font-weight: 600;
  letter-spacing: 1px;
  opacity: 0.9;
}

.score-change {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 0.8rem;
  font-weight: 600;
  padding: 5px 10px;
  border-radius: 10px;
}
.score-change.positive {
  background: rgba(16, 185, 129, 0.1);
  color: #059669;
}

.score-change.negative {
  background: rgba(239, 68, 68, 0.1);
  color: #dc2626;
}

/* Header Gradient */
.bg-gradient-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
  .employee-card {
    padding: 16px;
  }
  
  .employee-info {
    flex-direction: column;
    text-align: center;
    gap: 8px;
  }
  
  .performance-metrics {
    margin: 16px 0;
  }
  
  .metric-item {
    flex-direction: column;
    gap: 8px;
  }
  
  .metric-label {
    min-width: auto;
    text-align: center;
  }
  
  .overall-score {
    margin-top: 16px;
  }
}

/* Gamification Badges */
.game-badges {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-top: 10px;
}

.badge-item {
  background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);
  color: white;
  padding: 6px 12px;
  border-radius: 15px;
  font-size: 0.8rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 5px;
  box-shadow: 0 4px 10px rgba(33, 150, 243, 0.3);
  transition: all 0.3s ease;
}

.badge-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(33, 150, 243, 0.4);
}

.badge-item.hero {
  background: linear-gradient(135deg, #fcd116 0%, #f57c00 100%);
  color: #1a237e;
}

.badge-item.solver {
  background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
}

.badge-item.star {
  background: linear-gradient(135deg, #9c27b0 0%, #6a1b9a 100%);
}

/* Animation on load */
.employee-card {
  animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) both;
}

.employee-card:nth-child(1) { animation-delay: 0.1s; }
.employee-card:nth-child(2) { animation-delay: 0.2s; }
.employee-card:nth-child(3) { animation-delay: 0.3s; }
.employee-card:nth-child(4) { animation-delay: 0.4s; }
.employee-card:nth-child(5) { animation-delay: 0.5s; }

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
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
<?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
</div>

</div>

<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Employee List</h4>
<h6>Manage your Employee</h6>
</div>
</div>

<!-- Total Expenses, Top Category, Top Expense, Avg Daily Expense -->
          <div class="row justify-content-end">
            <!-- Total Product Sold -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="revenue/revenue.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das1">
                  <div class="dash-counts">
                    <h4>Bali</h4>
                    <h5>Cabang Terbaik</h5>
                    <h2 class="stat-change">Keep up the good work</h2>
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
                    <h4>Andi S.</h4>
                    <h5>Karyawan Terbaik</h5>
                  <h2 class="stat-change">+10% from last week</h2>
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
                    <h4><span class="counters" data-count="134870"></span></h4>
                    <h5>Total User</h5>
                    <h2 class="stat-change">+71 dari minggu lalu</h2>
                  </div>
                  <div class="icon-box bg-merah">
                    <i class="fa fa-exclamation-triangle"></i>
                  </div>
                </div>
              </a>
            </div>

            <!-- Average Product Sales -->
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
              <a href="expense/expensecategory.php" class="w-100 text-decoration-none text-dark">
                <div class="dash-count das4">
                  <div class="dash-counts">
                    <h4>8.9</h4>
                    <h5>Rata-Rata Poin</h5>
                   <h2 class="stat-change">-0.5 from last month</h2>
                    </div>
                    <div class="icon-box bg-hijau">
                      <i class="fa fa-chart-line"></i>
                    </div>
                </div>
              </a>
            </div>
          </div>
          <!-- END KOLOM  -->


  <!-- DONUT & DETAIL KARYAWAN -->
<div class="row mt-4">
  <!-- Donut Chart Karyawan per Cabang -->
  <div class="col-md-5">
    <div class="card h-100">
      <div class="card-header bg-primary text-white text-center py-2">
        <h6 class="mb-0 small">Karyawan per Cabang</h6>
      </div>
      <div class="card-body d-flex flex-column justify-content-center align-items-center">
        <div id="donutChartKaryawan"></div>
        <div id="selectedCabangInfo" class="text-center mt-2" style="font-size: 14px;"></div>
      </div>
    </div>
  </div>

  <!-- Total Karyawan dan List Detail -->
  <div class="col-md-7">
    <div class="card h-100">
      <div class="card-header bg-success text-white text-center py-2">
        <h6 class="mb-0 small">Total Karyawan & Detail Cabang</h6>
      </div>
      <div class="card-body">
        <h3 class="text-center text-success mb-3" id="totalKaryawan">Total: -</h3>
        <p class="text-muted small">Detail per Cabang:</p>
        <ul id="listCabangKaryawan" class="list-group small"></ul>
      </div>
    </div>
  </div>
</div>

<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Data Hardcoded
  const cabangData = [
    { nama: "Alam Sutera", jumlah: 35 },
    { nama: "Sentul City", jumlah: 28 },
    { nama: "Kota Baru Parahyangan", jumlah: 22 },
    { nama: "Surabaya", jumlah: 18 },
    { nama: "Bali", jumlah: 25 },
    { nama: "Jakarta Garden City", jumlah: 10 },
    { nama: "Mal Taman Anggrek", jumlah: 55 }
  ];

  const labels = cabangData.map(c => c.nama);
  const values = cabangData.map(c => c.jumlah);
  const total = values.reduce((sum, val) => sum + val, 0);

  // Update total karyawan
  document.getElementById("totalKaryawan").textContent = `Total: ${total} Karyawan`;

  // Update list cabang
  const listContainer = document.getElementById("listCabangKaryawan");
  cabangData.forEach(item => {
    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";
    li.textContent = item.nama;

    const badge = document.createElement("span");
    badge.className = "badge bg-primary rounded-pill";
    badge.textContent = item.jumlah;
    li.appendChild(badge);

    listContainer.appendChild(li);
  });

  // Donut Chart config
  const chart = new ApexCharts(document.querySelector("#donutChartKaryawan"), {
    chart: {
      type: 'donut',
      height: 260,
      events: {
        dataPointSelection: function(event, chartContext, config) {
          const index = config.dataPointIndex;
          const cabang = labels[index];
          const jumlah = values[index];
          document.getElementById("selectedCabangInfo").textContent = `${cabang}: ${jumlah} karyawan`;
        }
      }
    },
    series: values,
    labels: labels,
    colors: [
      "#1976d2", "#42a5f5", "#64b5f6", "#1565c0", "#90caf9", "#1e88e5", "#0d47a1"
    ],
    dataLabels: {
      enabled: false // label di dalam donat disembunyikan
    },
    legend: {
      position: 'bottom'
    }
  });

  chart.render();
});
</script>
<div class="chart-container">
        <div class="chart-header">
            <h5><i class="fa fa-chart-bar me-2"></i>Visualisasi Kinerja Karyawan</h5>
            <div class="chart-tabs">
                <button class="tab-btn active" data-tab="kehadiran">Kehadiran</button>
                <button class="tab-btn" data-tab="kinerja">Kinerja</button>
                <button class="tab-btn" data-tab="aktivitas">Aktivitas</button>
            </div>
        </div>
        
        <div class="chart-body">
            <!-- Kehadiran Chart -->
            <div class="chart-content active" id="kehadiran">
                <div class="bar-chart">
                    <div class="bar excellent" style="height: 95%" data-value="95">
                        <div class="bar-value">95%</div>
                        <div class="bar-label">Alam Sutera</div>
                    </div>
                    <div class="bar excellent" style="height: 88%" data-value="88">
                        <div class="bar-value">88%</div>
                        <div class="bar-label">Sentul</div>
                    </div>
                    <div class="bar excellent" style="height: 92%" data-value="92">
                        <div class="bar-value">92%</div>
                        <div class="bar-label">Bandung</div>
                    </div>
                    <div class="bar good" style="height: 78%" data-value="78">
                        <div class="bar-value">78%</div>
                        <div class="bar-label">Surabaya</div>
                    </div>
                    <div class="bar excellent" style="height: 85%" data-value="85">
                        <div class="bar-value">85%</div>
                        <div class="bar-label">Bali</div>
                    </div>
                    <div class="bar good" style="height: 72%" data-value="72">
                        <div class="bar-value">72%</div>
                        <div class="bar-label">Jakarta</div>
                    </div>
                    <div class="bar excellent" style="height: 90%" data-value="90">
                        <div class="bar-value">90%</div>
                        <div class="bar-label">Taman Anggrek</div>
                    </div>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background: #0d47a1;"></div>
                        <span>Excellent (≥85%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #f59e0b;"></div>
                        <span>Good (70-84%)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #C8102E;"></div>
                        <span>Perlu Perbaikan (<70%)</span>
                    </div>
                </div>
                <div class="stats-info">
                    Tingkat kehadiran karyawan per cabang • Rata-rata 86%
                </div>
            </div>

            <!-- Kinerja Chart (Radar) -->
            <div class="chart-content" id="kinerja">
                <div class="branch-selector">
                    <button class="branch-btn active" data-branch="alam-sutera">Alam Sutera</button>
                    <button class="branch-btn" data-branch="sentul">Sentul</button>
                    <button class="branch-btn" data-branch="bandung">Bandung</button>
                    <button class="branch-btn" data-branch="surabaya">Surabaya</button>
                    <button class="branch-btn" data-branch="bali">Bali</button>
                    <button class="branch-btn" data-branch="jakarta">Jakarta</button>
                    <button class="branch-btn" data-branch="taman-anggrek">Taman Anggrek</button>
                </div>
                <div class="radar-container">
                    <div class="radar-chart">
                        <svg class="radar-grid" width="280" height="280">
                            <!-- Grid circles -->
                            <circle cx="140" cy="140" r="28" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            <circle cx="140" cy="140" r="56" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            <circle cx="140" cy="140" r="84" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            <circle cx="140" cy="140" r="112" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            <circle cx="140" cy="140" r="140" fill="none" stroke="#e5e7eb" stroke-width="1"/>
                            
                            <!-- Grid lines -->
                            <line x1="140" y1="0" x2="140" y2="280" stroke="#e5e7eb" stroke-width="1"/>
                            <line x1="0" y1="140" x2="280" y2="140" stroke="#e5e7eb" stroke-width="1"/>
                            <line x1="41" y1="41" x2="239" y2="239" stroke="#e5e7eb" stroke-width="1"/>
                            <line x1="239" y1="41" x2="41" y2="239" stroke="#e5e7eb" stroke-width="1"/>
                            
                            <!-- Radar polygon -->
                            <polygon id="radar-polygon" points="140,28 224,85 224,195 140,252 56,195 56,85" 
                                     fill="rgba(22, 87, 182, 0.2)" stroke="#1657b6" stroke-width="2"/>
                        </svg>
                        <div class="radar-labels">
                            <div class="radar-label" style="top: 10px; left: 140px;">Kepatuhan<br><span id="kepatuhan-score">90%</span></div>
                            <div class="radar-label" style="top: 50px; right: 10px;">Pelayanan<br><span id="pelayanan-score">85%</span></div>
                            <div class="radar-label" style="bottom: 50px; right: 10px;">Ketepatan<br><span id="ketepatan-score">80%</span></div>
                            <div class="radar-label" style="bottom: 10px; left: 140px;">Kepemimpinan<br><span id="kepemimpinan-score">75%</span></div>
                            <div class="radar-label" style="bottom: 50px; left: 10px;">Kolaborasi<br><span id="kolaborasi-score">88%</span></div>
                        </div>
                    </div>
                </div>
                <div class="stats-info">
                    Evaluasi komprehensif 5 aspek kinerja • <span id="current-branch">Alam Sutera</span>
                </div>
            </div>

            <!-- Aktivitas Chart (Stacked) -->
            <div class="chart-content" id="aktivitas">
                <div class="stacked-chart">
                    <div class="stacked-bar">
                        <div class="stacked-segment customer-handling" style="height: 80px;" data-value="40"></div>
                        <div class="stacked-segment stock-management" style="height: 30px;" data-value="15"></div>
                        <div class="stacked-segment operational-support" style="height: 50px;" data-value="25"></div>
                        <div class="stacked-segment team-collaboration" style="height: 40px;" data-value="20"></div>
                        <div class="bar-label">Alam Sutera</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment customer-handling" style="height: 70px;" data-value="35"></div>
                        <div class="stacked-segment stock-management" style="height: 40px;" data-value="20"></div>
                        <div class="stacked-segment operational-support" style="height: 35px;" data-value="18"></div>
                        <div class="stacked-segment team-collaboration" style="height: 35px;" data-value="17"></div>
                        <div class="bar-label">Sentul</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment customer-handling" style="height: 75px;" data-value="38"></div>
                        <div class="stacked-segment stock-management" style="height: 35px;" data-value="18"></div>
                        <div class="stacked-segment operational-support" style="height: 40px;" data-value="20"></div>
                        <div class="stacked-segment team-collaboration" style="height: 30px;" data-value="15"></div>
                        <div class="bar-label">Bandung</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment customer-handling" style="height: 60px;" data-value="30"></div>
                        <div class="stacked-segment stock-management" style="height: 45px;" data-value="23"></div>
                        <div class="stacked-segment operational-support" style="height: 30px;" data-value="15"></div>
                        <div class="stacked-segment team-collaboration" style="height: 25px;" data-value="12"></div>
                        <div class="bar-label">Surabaya</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment customer-handling" style="height: 85px;" data-value="42"></div>
                        <div class="stacked-segment stock-management" style="height: 25px;" data-value="13"></div>
                        <div class="stacked-segment operational-support" style="height: 45px;" data-value="22"></div>
                        <div class="stacked-segment team-collaboration" style="height: 35px;" data-value="18"></div>
                        <div class="bar-label">Bali</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment customer-handling" style="height: 50px;" data-value="25"></div>
                        <div class="stacked-segment stock-management" style="height: 50px;" data-value="25"></div>
                        <div class="stacked-segment operational-support" style="height: 25px;" data-value="12"></div>
                        <div class="stacked-segment team-collaboration" style="height: 35px;" data-value="18"></div>
                        <div class="bar-label">Jakarta</div>
                    </div>
                    <div class="stacked-bar">
                        <div class="stacked-segment customer-handling" style="height: 90px;" data-value="45"></div>
                        <div class="stacked-segment stock-management" style="height: 20px;" data-value="10"></div>
                        <div class="stacked-segment operational-support" style="height: 55px;" data-value="28"></div>
                        <div class="stacked-segment team-collaboration" style="height: 45px;" data-value="22"></div>
                        <div class="bar-label">Taman Anggrek</div>
                    </div>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background: #0d47a1;"></div>
                        <span>Customer Handling</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #ff5858;"></div>
                        <span>Stock Management</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #018679;"></div>
                        <span>Operational Support</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #6d28d9;"></div>
                        <span>Team Collaboration</span>
                    </div>
                </div>
                <div class="stats-info">
                    Distribusi aktivitas karyawan per cabang • Total rata-rata 100 aktivitas/bulan
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for radar chart
        const radarData = {
            'alam-sutera': { kepatuhan: 90, pelayanan: 85, ketepatan: 80, kepemimpinan: 75, kolaborasi: 88 },
            'sentul': { kepatuhan: 85, pelayanan: 78, ketepatan: 85, kepemimpinan: 70, kolaborasi: 82 },
            'bandung': { kepatuhan: 88, pelayanan: 82, ketepatan: 75, kepemimpinan: 80, kolaborasi: 85 },
            'surabaya': { kepatuhan: 75, pelayanan: 70, ketepatan: 72, kepemimpinan: 65, kolaborasi: 78 },
            'bali': { kepatuhan: 82, pelayanan: 88, ketepatan: 85, kepemimpinan: 78, kolaborasi: 90 },
            'jakarta': { kepatuhan: 70, pelayanan: 75, ketepatan: 68, kepemimpinan: 72, kolaborasi: 80 },
            'taman-anggrek': { kepatuhan: 92, pelayanan: 90, ketepatan: 88, kepemimpinan: 85, kolaborasi: 92 }
        };

        // Tab switching functionality
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.chart-content').forEach(content => content.classList.remove('active'));
                
                this.classList.add('active');
                
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Branch selector for radar chart
        document.querySelectorAll('.branch-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.branch-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const branchId = this.getAttribute('data-branch');
                updateRadarChart(branchId);
                document.getElementById('current-branch').textContent = this.textContent;
            });
        });

        // Update radar chart
        function updateRadarChart(branchId) {
            const data = radarData[branchId];
            const center = 140;
            const maxRadius = 112;
            
            // Calculate points for polygon
            const points = [];
            const angles = [0, 72, 144, 216, 288]; // 5 points, 72 degrees apart
            
            Object.values(data).forEach((value, index) => {
                const angle = (angles[index] - 90) * Math.PI / 180; // Start from top
                const radius = (value / 100) * maxRadius;
                const x = center + radius * Math.cos(angle);
                const y = center + radius * Math.sin(angle);
                points.push(`${x},${y}`);
            });
            
            // Update polygon
            document.getElementById('radar-polygon').setAttribute('points', points.join(' '));
            
            // Update labels
            document.getElementById('kepatuhan-score').textContent = data.kepatuhan + '%';
            document.getElementById('pelayanan-score').textContent = data.pelayanan + '%';
            document.getElementById('ketepatan-score').textContent = data.ketepatan + '%';
            document.getElementById('kepemimpinan-score').textContent = data.kepemimpinan + '%';
            document.getElementById('kolaborasi-score').textContent = data.kolaborasi + '%';
        }

        // Bar hover effects
        document.querySelectorAll('.bar, .stacked-bar').forEach(element => {
            element.addEventListener('mouseenter', function() {
                if (this.classList.contains('bar')) {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
                }
            });
            
            element.addEventListener('mouseleave', function() {
                if (this.classList.contains('bar')) {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                }
            });
        });

        // Animation on load
        window.addEventListener('load', function() {
            document.querySelectorAll('.bar, .stacked-bar').forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = '0';
                    element.style.transform = 'translateY(50px)';
                    element.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }, 50);
                }, index * 100);
            });
        });
    </script>

<!-- List Evaluasi Karyawan IKEA - Compact Version -->
<div class="row justify-content-center mt-4">
  <div class="col-12">
    <div class="card shadow-lg border-0">
      <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%); position: relative; overflow: hidden; border-radius: 25px 25px 0 0;">
        <div class="header-animation"></div>
        <div class="d-flex justify-content-between align-items-center position-relative">
          <div>
            <h4 class="mb-1 fw-bold">
              <i class="bi bi-trophy-fill me-2"></i>
              Employee Hall of Fame
            </h4>
            <p class="mb-0 opacity-90">Celebrating Our Top Performers - Juni 2024</p>
          </div>
          <div class="period-badge">
            <i class="bi bi-calendar-check me-2"></i>
            Top 5 Best Employee
          </div>
        </div>
      </div>
      <div class="card-body p-3" style="border-radius: 0 0 25px 25px;">
        
        <!-- RANK 1 - GOLD MEDAL -->
        <div class="employee-card rank-1 mb-3">
          <div class="rank-medal gold">1</div>
          <div class="top-performer">
            <i class="bi bi-star-fill me-1"></i>
            TOP PERFORMER
          </div>
          <div class="row align-items-center">
            <div class="col-md-3">
              <div class="employee-info-compact">
                <div class="employee-avatar-small">
                  <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face" alt="Andi Saputra">
                </div>
                <div class="employee-details-compact">
                  <h6 class="employee-name">Andi Saputra</h6>
                  <p class="employee-role">Sales Associate</p>
                  <span class="employee-location">
                    <i class="bi bi-geo-alt-fill"></i>
                    Alam Sutera
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="performance-metrics">
                <div class="metric-item">
                  <span class="metric-label">Kehadiran</span>
                  <div class="metric-bar">
                    <div class="metric-progress" style="width: 98%"></div>
                  </div>
                  <span class="metric-value">98%</span>
                </div>
                <div class="metric-item">
                  <span class="metric-label">Pelayanan</span>
                  <div class="metric-bar">
                    <div class="metric-progress" style="width: 90%"></div>
                  </div>
                  <span class="metric-value">90%</span>
                </div>
                <div class="metric-item">
                  <span class="metric-label">Tugas</span>
                  <div class="metric-bar">
                    <div class="metric-progress" style="width: 95%"></div>
                  </div>
                  <span class="metric-value">95%</span>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="overall-score">
                <div class="score-circle excellent">
                  <span class="score-number">94</span>
                  <span class="score-label">TOTAL POIN</span>
                </div>
                <div class="score-change positive">
                  <i class="bi bi-arrow-up"></i>
                  <span>+3%</span>
                </div>
                <div class="game-badges">
                  <div class="badge-item hero">
                    <i class="bi bi-person-hearts"></i>
                    Problem Solver
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- RANK 2 & 3 - TWO COLUMNS -->
        <div class="row">
          <div class="col-md-6">
            <!-- RANK 2 - SILVER MEDAL -->
            <div class="employee-card rank-2 mb-3">
              <div class="rank-medal silver">2</div>
              <div class="row align-items-center">
                <div class="col-12">
                  <div class="employee-info-compact">
                    <div class="employee-avatar-small">
                      <img src="https://images.unsplash.com/photo-1494790108755-2616c6d73fe4?w=150&h=150&fit=crop&crop=face" alt="Rina Pramesti">
                    </div>
                    <div class="employee-details-compact">
                      <h6 class="employee-name">Rina Pramesti</h6>
                      <p class="employee-role">Customer Service</p>
                      <span class="employee-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        Sentul City
                      </span>
                    </div>
                  </div>
                  <div class="performance-metrics-compact">
                    <div class="metric-item-compact">
                      <span class="metric-label">Kehadiran</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 95%"></div>
                      </div>
                      <span class="metric-value">95%</span>
                    </div>
                    <div class="metric-item-compact">
                      <span class="metric-label">Pelayanan</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 88%"></div>
                      </div>
                      <span class="metric-value">88%</span>
                    </div>
                    <div class="metric-item-compact">
                      <span class="metric-label">Tugas</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 91%"></div>
                      </div>
                      <span class="metric-value">91%</span>
                    </div>
                  </div>
                  <div class="overall-score-compact">
                    <div class="score-circle-small excellent">
                      <span class="score-number">91</span>
                      <span class="score-label">POIN</span>
                    </div>
                    <div class="score-change positive">
                      <i class="bi bi-arrow-up"></i>
                      <span>+2%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <!-- RANK 3 - BRONZE MEDAL -->
            <div class="employee-card rank-3 mb-3">
              <div class="rank-medal bronze">3</div>
              <div class="row align-items-center">
                <div class="col-12">
                  <div class="employee-info-compact">
                    <div class="employee-avatar-small">
                      <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face" alt="Dimas Wahyu">
                    </div>
                    <div class="employee-details-compact">
                      <h6 class="employee-name">Dimas Wahyu</h6>
                      <p class="employee-role">Warehouse Staff</p>
                      <span class="employee-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        Kota Baru Parahyangan
                      </span>
                    </div>
                  </div>
                  <div class="performance-metrics-compact">
                    <div class="metric-item-compact">
                      <span class="metric-label">Kehadiran</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 92%"></div>
                      </div>
                      <span class="metric-value">92%</span>
                    </div>
                    <div class="metric-item-compact">
                      <span class="metric-label">Pelayanan</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 85%"></div>
                      </div>
                      <span class="metric-value">85%</span>
                    </div>
                    <div class="metric-item-compact">
                      <span class="metric-label">Tugas</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 88%"></div>
                      </div>
                      <span class="metric-value">88%</span>
                    </div>
                  </div>
                  <div class="overall-score-compact">
                    <div class="score-circle-small good">
                      <span class="score-number">88</span>
                      <span class="score-label">POIN</span>
                    </div>
                    <div class="score-change positive">
                      <i class="bi bi-arrow-up"></i>
                      <span>+1%</span>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- RANK 4 & 5 - TWO COLUMNS -->
        <div class="row">
          <div class="col-md-6">
            <!-- RANK 4 -->
            <div class="employee-card mb-3">
              <div class="row align-items-center">
                <div class="col-12">
                  <div class="employee-info-compact">
                    <div class="employee-avatar-small">
                      <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face" alt="Siska Lestari">
                    </div>
                    <div class="employee-details-compact">
                      <h6 class="employee-name">Siska Lestari</h6>
                      <p class="employee-role">Cashier</p>
                      <span class="employee-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        Bali
                      </span>
                    </div>
                  </div>
                  <div class="performance-metrics-compact">
                    <div class="metric-item-compact">
                      <span class="metric-label">Kehadiran</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 90%"></div>
                      </div>
                      <span class="metric-value">90%</span>
                    </div>
                    <div class="metric-item-compact">
                      <span class="metric-label">Pelayanan</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 80%"></div>
                      </div>
                      <span class="metric-value">80%</span>
                    </div>
                    <div class="metric-item-compact">
                      <span class="metric-label">Tugas</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 84%"></div>
                      </div>
                      <span class="metric-value">84%</span>
                    </div>
                  </div>
                  <div class="overall-score-compact">
                    <div class="score-circle-small average">
                      <span class="score-number">84</span>
                      <span class="score-label">POIN</span>
                    </div>
                    <div class="score-change negative">
                      <i class="bi bi-arrow-down"></i>
                      <span>-1%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <!-- RANK 5 -->
            <div class="employee-card mb-2">
              <div class="row align-items-center">
                <div class="col-12">
                  <div class="employee-info-compact">
                    <div class="employee-avatar-small">
                      <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=face" alt="Yudha Hermawan">
                    </div>
                    <div class="employee-details-compact">
                      <h6 class="employee-name">Yudha Hermawan</h6>
                      <p class="employee-role">Delivery Driver</p>
                      <span class="employee-location">
                        <i class="bi bi-geo-alt-fill"></i>
                        Surabaya
                      </span>
                    </div>
                  </div>
                  <div class="performance-metrics-compact">
                    <div class="metric-item-compact">
                      <span class="metric-label">Kehadiran</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 88%"></div>
                      </div>
                      <span class="metric-value">88%</span>
                    </div>
                    <div class="metric-item-compact">
                      <span class="metric-label">Pelayanan</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 78%"></div>
                      </div>
                      <span class="metric-value">78%</span>
                    </div>
                    <div class="metric-item-compact">
                      <span class="metric-label">Tugas</span>
                      <div class="metric-bar-small">
                        <div class="metric-progress" style="width: 80%"></div>
                      </div>
                      <span class="metric-value">80%</span>
                    </div>
                  </div>
                  <div class="overall-score-compact">
                    <div class="score-circle-small average">
                      <span class="score-number">80</span>
                      <span class="score-label">POIN</span>
                    </div>
                    <div class="score-change negative">
                      <i class="bi bi-arrow-down"></i>
                      <span>-2%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="../assets/js/jquery-3.6.0.min.js"></script>

<script src="../assets/js/feather.min.js"></script>

<script src="../assets/js/jquery.slimscroll.min.js"></script>

<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.bootstrap4.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/plugins/select2/js/select2.min.js"></script>

<script src="../assets/js/moment.min.js"></script>
<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="../assets/js/script.js"></script>
</body>
</html>