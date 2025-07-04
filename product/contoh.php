<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=0" name="viewport" />
    <meta content="POS - Bootstrap Admin Template" name="description" />
    <meta content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" name="keywords" />
    <meta content="Dreamguys - Bootstrap Admin Template" name="author" />
    <meta content="noindex, nofollow" name="robots" />
    <title>IKEA Brand Management</title>
    <link href="../assets/img/favicon.jpg" rel="shortcut icon" type="image/x-icon" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
      :root {
        --ikea-blue: #0051BA;
        --ikea-yellow: #FFCC00;
        --light-gray: #f8f9fa;
        --dark-gray: #343a40;
      }
      
      body {
        background-color: #f5f7fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      
      .ikea-header {
        background-color: var(--ikea-blue) !important;
      }
      
      .dashboard-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
        margin-bottom: 24px;
      }
      
      .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      }
      
      .card-header {
        border-radius: 12px 12px 0 0 !important;
        background-color: var(--ikea-blue);
        color: white;
        padding: 15px 20px;
      }
      
      .card-header h5 {
        margin-bottom: 0;
        font-size: 1.1rem;
      }
      
      /* Chart containers */
      .chart-container {
        position: relative;
        height: 250px;
      }
      
      .small-chart-container {
        position: relative;
        height: 200px;
      }
      
      /* Dynamic notes for line chart */
      .chart-notes {
        display: flex;
        justify-content: space-between;
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
        border-left: 4px solid var(--ikea-blue);
      }
      
      .chart-note-item {
        text-align: center;
        flex: 1;
      }
      
      .chart-note-item i {
        font-size: 1.2rem;
        color: var(--ikea-blue);
        margin-bottom: 5px;
      }
      
      .chart-note-item strong {
        display: block;
        font-size: 0.9rem;
        margin-bottom: 5px;
      }
      
      .chart-note-item span {
        font-size: 0.85rem;
        color: #495057;
      }
      
      /* Metric cards */
      .metric-card {
        padding: 15px;
        border-left: 4px solid var(--ikea-blue);
        background-color: white;
        border-radius: 8px;
        height: 100%;
      }
      
      .metric-card .metric-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--ikea-blue);
        margin-bottom: 5px;
      }
      
      .metric-card .metric-label {
        font-size: 0.85rem;
        color: #6c757d;
      }
      
      /* Alert items */
      .alert-item {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
      }
      
      .alert-item i {
        margin-right: 12px;
        font-size: 1.2rem;
      }
      
      /* Table styling */
      .data-table th {
        background-color: #f8f9fa;
        font-weight: 600;
      }
      
      /* Animation */
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }
      
      .animate-fadein {
        animation: fadeIn 0.6s ease-out forwards;
      }
      
      /* Responsive adjustments */
      @media (max-width: 768px) {
        .chart-notes {
          flex-wrap: wrap;
        }
        
        .chart-note-item {
          flex: 50%;
          margin-bottom: 10px;
        }
      }
      
      .card-header {
  background-color: #0d47a1 !important; /* Biru navy tua */
  color: white !important; /* Agar teks tetap terlihat */
  border-radius: 12px 12px 0 0;
}

    </style>
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>
    
    <div class="main-wrapper">
      <?php include BASE_PATH . '/include/sidebar.php'; ?>
      
      <div class="page-wrapper">
        <?php include __DIR__ . '/../include/header.php'; ?>
        
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Brand Management System</h4>
              <h6>Comprehensive brand performance analysis</h6>
            </div>
          </div>
          
          <!-- Brand Charts Section -->
          <div class="row animate-fadein">
            <!-- Bar Chart - Top 5 Brands -->
            <div class="col-md-6">
              <div class="dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="card-title mb-0">Top 5 Brands by Sales</h5>
                  <select id="barYearSelect" class="form-select form-select-sm" style="width: 100px;">
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025" selected>2025</option>
                  </select>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="barChartTopBrands"></canvas>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Pie Chart - Brand Contribution -->
            <div class="col-md-6">
              <div class="dashboard-card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Brand Contribution to Sales</h5>
                </div>
                <div class="card-body">
                  <div class="small-chart-container">
                    <canvas id="pieChartBrandContribution"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Line Chart - Brand Growth Trend -->
          <div class="row animate-fadein" style="animation-delay: 0.2s">
            <div class="col-12">
              <div class="dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="card-title mb-0">Brand Growth Trend</h5>
                  <select id="lineYearSelect" class="form-select form-select-sm" style="width: 100px;">
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025" selected>2025</option>
                  </select>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="lineChartBrandGrowth"></canvas>
                  </div>
                  <div class="chart-notes">
                    <div class="chart-note-item">
                      <i class="bi bi-tag"></i>
                      <strong>Brand</strong>
                      <span id="noteBrand">-</span>
                    </div>
                    <div class="chart-note-item">
                      <i class="bi bi-calendar3"></i>
                      <strong>Month</strong>
                      <span id="noteMonth">-</span>
                    </div>
                    <div class="chart-note-item">
                      <i class="bi bi-bar-chart-line"></i>
                      <strong>Sales</strong>
                      <span id="noteSales">-</span>
                    </div>
                    <div class="chart-note-item">
                      <i class="bi bi-graph-up"></i>
                      <strong>Avg/Month</strong>
                      <span id="noteAvg">-</span>
                    </div>
                    <div class="chart-note-item">
                      <i class="bi bi-activity"></i>
                      <strong>Trend</strong>
                      <span id="noteTrend">-</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Brand Performance Matrix -->
          <div class="row animate-fadein" style="animation-delay: 0.4s">
            <div class="col-md-6">
              <div class="dashboard-card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Brand Performance Matrix</h5>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="bubbleChartBrandMatrix"></canvas>
                  </div>
                  <div class="mt-3">
                    <div class="d-flex align-items-center mb-2">
                      <div class="legend-color" style="background-color: #26c6da; width: 15px; height: 15px; border-radius: 50%; margin-right: 8px;"></div>
                      <small>High Growth - High Revenue</small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                      <div class="legend-color" style="background-color: #ffb443; width: 15px; height: 15px; border-radius: 50%; margin-right: 8px;"></div>
                      <small>High Growth - Low Revenue</small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                      <div class="legend-color" style="background-color: #d05ce4; width: 15px; height: 15px; border-radius: 50%; margin-right: 8px;"></div>
                      <small>Low Growth - High Revenue</small>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="legend-color" style="background-color: #8884d8; width: 15px; height: 15px; border-radius: 50%; margin-right: 8px;"></div>
                      <small>Low Growth - Low Revenue</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Brand Inventory Health -->
            <div class="col-md-6">
              <div class="dashboard-card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Brand Inventory Health</h5>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="radarChartInventory"></canvas>
                  </div>
                  <div class="mt-3 text-center">
                    <small class="text-muted">Score: 1 (Poor) - 5 (Excellent)</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Brand Statistics Section -->
          <div class="row animate-fadein" style="animation-delay: 0.6s">
            <div class="col-md-3 col-6">
              <div class="metric-card">
                <div class="metric-value">36</div>
                <div class="metric-label">Total Brands</div>
                <small class="text-muted">Active in system</small>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="metric-card">
                <div class="metric-value">124</div>
                <div class="metric-label">Most Products</div>
                <small class="text-muted">HEMNES</small>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="metric-card">
                <div class="metric-value">4.8</div>
                <div class="metric-label">Top Rating</div>
                <small class="text-muted">SKÅDIS</small>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="metric-card">
                <div class="metric-value">17x</div>
                <div class="metric-label">Most Restocked</div>
                <small class="text-muted">LACK (3 months)</small>
              </div>
            </div>
          </div>
          
          <!-- Brand Comparison Table -->
          <div class="row animate-fadein" style="animation-delay: 0.8s">
            <div class="col-12">
              <div class="dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="card-title mb-0">Brand Comparison Analysis</h5>
                  <div>
                    <select id="tableYearSelect" class="form-select form-select-sm d-inline-block" style="width: 120px;">
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025" selected>2025</option>
                    </select>
                    <button class="btn btn-sm btn-outline-primary ms-2">
                      <i class="fas fa-download"></i> Export
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover data-table">
                      <thead>
                        <tr>
                          <th>Brand</th>
                          <th>Revenue</th>
                          <th>Growth</th>
                          <th>Market Share</th>
                          <th>Inventory Turn</th>
                          <th>Customer Rating</th>
                          <th>Profit Margin</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>HEMNES</td>
                          <td>$1.2M</td>
                          <td class="text-success">+12%</td>
                          <td>18%</td>
                          <td>3.2x</td>
                          <td>4.5</td>
                          <td>22%</td>
                        </tr>
                        <tr>
                          <td>SKÅDIS</td>
                          <td>$980K</td>
                          <td class="text-success">+15%</td>
                          <td>15%</td>
                          <td>3.8x</td>
                          <td>4.8</td>
                          <td>25%</td>
                        </tr>
                        <tr>
                          <td>LACK</td>
                          <td>$850K</td>
                          <td class="text-warning">+5%</td>
                          <td>13%</td>
                          <td>2.9x</td>
                          <td>4.2</td>
                          <td>18%</td>
                        </tr>
                        <tr>
                          <td>VITTSJÖ</td>
                          <td>$720K</td>
                          <td class="text-success">+8%</td>
                          <td>11%</td>
                          <td>3.5x</td>
                          <td>4.6</td>
                          <td>20%</td>
                        </tr>
                        <tr>
                          <td>KALLAX</td>
                          <td>$680K</td>
                          <td class="text-danger">-2%</td>
                          <td>10%</td>
                          <td>2.7x</td>
                          <td>4.3</td>
                          <td>15%</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Action Items and Forecast -->
          <div class="row animate-fadein" style="animation-delay: 1s">
            <div class="col-md-6">
              <div class="dashboard-card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Brand Action Items</h5>
                </div>
                <div class="card-body">
                  <div class="alert-item alert alert-warning">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                      <strong>LACK</strong> needs promotional support - Growth slowing to 5%
                    </div>
                  </div>
                  <div class="alert-item alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <div>
                      <strong>KALLAX</strong> requires inventory optimization - Negative growth detected
                    </div>
                  </div>
                  <div class="alert-item alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>
                      <strong>SKÅDIS</strong> performing well - Consider expanding product line
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="dashboard-card">
                <div class="card-header">
                  <h5 class="card-title mb-0">6-Month Brand Forecast</h5>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="forecastChart"></canvas>
                  </div>
                  <div class="mt-3">
                    <small class="text-muted">Forecast based on current trends and seasonal factors</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Data for charts
      const chartData = {
        // Bar chart data
        barDataByYear: {
          2023: [2200, 2000, 1800, 1600, 1400],
          2024: [2500, 2300, 1900, 1700, 1500],
          2025: [3210, 2740, 2110, 1840, 1630]
        },
        
        // Line chart data
        lineDataByYear: {
          2023: [
            { label: 'HEMNES', data: [120,130,125,140,150,145,160,155,165,170,175,180], borderColor: '#26c6da', backgroundColor: 'rgba(38,198,218,0.1)', tension: 0.4, fill: true },
            { label: 'SKÅDIS', data: [100,105,110,115,120,125,130,135,140,145,150,155], borderColor: '#d05ce4', backgroundColor: 'rgba(208,92,228,0.1)', tension: 0.4, fill: true },
            { label: 'LACK', data: [90,85,95,100,105,110,115,120,125,130,135,140], borderColor: '#ffb443', backgroundColor: 'rgba(255,180,67,0.1)', tension: 0.4, fill: true },
            { label: 'VITTSJÖ', data: [80,88,92,97,102,108,115,121,128,135,142,150], borderColor: '#36e2d1', backgroundColor: 'rgba(54,226,209,0.1)', tension: 0.4, fill: true },
            { label: 'KALLAX', data: [75,78,82,85,89,93,97,101,105,110,115,120], borderColor: '#8884d8', backgroundColor: 'rgba(136,132,216,0.1)', tension: 0.4, fill: true }
          ],
          2024: [
            { label: 'HEMNES', data: [130,135,140,145,150,155,160,165,170,175,180,185], borderColor: '#26c6da', backgroundColor: 'rgba(38,198,218,0.1)', tension: 0.4, fill: true },
            { label: 'SKÅDIS', data: [110,115,120,125,130,135,140,145,150,155,160,165], borderColor: '#d05ce4', backgroundColor: 'rgba(208,92,228,0.1)', tension: 0.4, fill: true },
            { label: 'LACK', data: [95,98,102,106,110,114,118,122,126,130,134,138], borderColor: '#ffb443', backgroundColor: 'rgba(255,180,67,0.1)', tension: 0.4, fill: true },
            { label: 'VITTSJÖ', data: [85,90,94,99,104,109,114,119,124,129,134,139], borderColor: '#36e2d1', backgroundColor: 'rgba(54,226,209,0.1)', tension: 0.4, fill: true },
            { label: 'KALLAX', data: [80,84,88,92,96,100,104,108,112,116,120,124], borderColor: '#8884d8', backgroundColor: 'rgba(136,132,216,0.1)', tension: 0.4, fill: true }
          ],
          2025: [
            { label: 'HEMNES', data: [140,145,150,155,160,165,170,175,180,185,190,195], borderColor: '#26c6da', backgroundColor: 'rgba(38,198,218,0.1)', tension: 0.4, fill: true },
            { label: 'SKÅDIS', data: [120,125,130,135,140,145,150,155,160,165,170,175], borderColor: '#d05ce4', backgroundColor: 'rgba(208,92,228,0.1)', tension: 0.4, fill: true },
            { label: 'LACK', data: [100,105,110,115,120,125,130,135,140,145,150,155], borderColor: '#ffb443', backgroundColor: 'rgba(255,180,67,0.1)', tension: 0.4, fill: true },
            { label: 'VITTSJÖ', data: [90,95,100,105,110,115,120,125,130,135,140,145], borderColor: '#36e2d1', backgroundColor: 'rgba(54,226,209,0.1)', tension: 0.4, fill: true },
            { label: 'KALLAX', data: [85,89,93,97,101,105,109,113,117,121,125,129], borderColor: '#8884d8', backgroundColor: 'rgba(136,132,216,0.1)', tension: 0.4, fill: true }
          ]
        },
        
        // Pie chart data
        pieData: {
          labels: ['HEMNES', 'SKÅDIS', 'LACK', 'VITTSJÖ', 'Others'],
          datasets: [{
            data: [30, 25, 20, 15, 10],
            backgroundColor: ['#26c6da', '#d05ce4', '#ffb443', '#36e2d1', '#8884d8']
          }]
        }
      };

      // Initialize charts
      const months = [...Array(12).keys()].map(i => new Date(0, i).toLocaleString('default', { month: 'short' }));
      let currentBarYear = '2025';
      let currentLineYear = '2025';
      
      // Bar Chart - Top 5 Brands
      const barCtx = document.getElementById('barChartTopBrands').getContext('2d');
      const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
          labels: ['HEMNES', 'SKÅDIS', 'LACK', 'VITTSJÖ', 'KALLAX'],
          datasets: [{
            label: 'Sales (Units)',
            data: chartData.barDataByYear[currentBarYear],
            backgroundColor: 'rgba(0, 81, 186, 0.7)',
            borderColor: 'rgba(0, 81, 186, 1)',
            borderWidth: 1,
            borderRadius: 8
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return context.raw.toLocaleString() + ' units';
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  return value.toLocaleString();
                }
              }
            }
          }
        }
      });
      
      // Pie Chart - Brand Contribution
      const pieCtx = document.getElementById('pieChartBrandContribution').getContext('2d');
      const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: chartData.pieData,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'right'
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  const label = context.label || '';
                  const value = context.raw || 0;
                  const total = context.dataset.data.reduce((a, b) => a + b, 0);
                  const percentage = Math.round((value / total) * 100);
                  return `${label}: ${percentage}% (${value} units)`;
                }
              }
            }
          }
        }
      });
      
      // Line Chart - Brand Growth Trend
      const lineCtx = document.getElementById('lineChartBrandGrowth').getContext('2d');
      let lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
          labels: months,
          datasets: chartData.lineDataByYear[currentLineYear]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom'
            }
          },
          onClick: (e, elements) => {
            if (elements.length > 0) {
              const point = elements[0];
              const dataset = lineChart.data.datasets[point.datasetIndex];
              const month = lineChart.data.labels[point.index];
              const value = dataset.data[point.index];
              const avg = (dataset.data.reduce((a, b) => a + b, 0) / dataset.data.length).toFixed(1);
              const prev = dataset.data[point.index - 1];
              const trend = prev !== undefined ? (value > prev ? 'Up 📈' : value < prev ? 'Down 📉' : 'Stable ➖') : '-';
              
              // Update notes
              document.getElementById('noteBrand').textContent = dataset.label;
              document.getElementById('noteMonth').textContent = month;
              document.getElementById('noteSales').textContent = value + ' units';
              document.getElementById('noteAvg').textContent = avg + ' units';
              document.getElementById('noteTrend').textContent = trend;
            }
          }
        }
      });
      
      // Bubble Chart - Brand Performance Matrix
      const bubbleCtx = document.getElementById('bubbleChartBrandMatrix').getContext('2d');
      new Chart(bubbleCtx, {
        type: 'bubble',
        data: {
          datasets: [
            {
              label: 'HEMNES',
              data: [{x: 12, y: 1200000, r: 20}],
              backgroundColor: '#26c6da'
            },
            {
              label: 'SKÅDIS',
              data: [{x: 15, y: 980000, r: 18}],
              backgroundColor: '#26c6da'
            },
            {
              label: 'LACK',
              data: [{x: 5, y: 850000, r: 16}],
              backgroundColor: '#ffb443'
            },
            {
              label: 'VITTSJÖ',
              data: [{x: 8, y: 720000, r: 14}],
              backgroundColor: '#d05ce4'
            },
            {
              label: 'KALLAX',
              data: [{x: -2, y: 680000, r: 12}],
              backgroundColor: '#8884d8'
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            tooltip: {
              callbacks: {
                label: function(context) {
                  return [
                    context.dataset.label,
                    `Growth: ${context.raw.x}%`,
                    `Revenue: $${context.raw.y.toLocaleString()}`,
                    `Market Share: ${context.raw.r/2}%`
                  ];
                }
              }
            }
          },
          scales: {
            x: {
              title: {
                display: true,
                text: 'Growth Rate (%)'
              }
            },
            y: {
              title: {
                display: true,
                text: 'Revenue ($)'
              },
              ticks: {
                callback: function(value) {
                  return '$' + (value/1000).toLocaleString() + 'K';
                }
              }
            }
          }
        }
      });

      // Radar Chart - Inventory Health
      const radarCtx = document.getElementById('radarChartInventory').getContext('2d');
      new Chart(radarCtx, {
        type: 'radar',
        data: {
          labels: ['Stock Level', 'Turnover', 'Availability', 'Restock Freq', 'Carry Cost'],
          datasets: [
            {
              label: 'HEMNES',
              data: [4, 3.2, 4.5, 3, 3.8],
              backgroundColor: 'rgba(38, 198, 218, 0.2)',
              borderColor: '#26c6da',
              pointBackgroundColor: '#26c6da'
            },
            {
              label: 'SKÅDIS',
              data: [4.5, 3.8, 4.8, 4, 4.2],
              backgroundColor: 'rgba(208, 92, 228, 0.2)',
              borderColor: '#d05ce4',
              pointBackgroundColor: '#d05ce4'
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            r: {
              angleLines: {
                display: true
              },
              suggestedMin: 0,
              suggestedMax: 5
            }
          }
        }
      });

      // Forecast Chart
      const forecastCtx = document.getElementById('forecastChart').getContext('2d');
      new Chart(forecastCtx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
          datasets: [
            {
              label: 'HEMNES',
              data: [120, 125, 130, 135, 140, 145],
              borderColor: '#26c6da',
              tension: 0.4,
              fill: false
            },
            {
              label: 'SKÅDIS',
              data: [100, 110, 115, 120, 125, 130],
              borderColor: '#d05ce4',
              tension: 0.4,
              fill: false
            },
            {
              label: 'LACK',
              data: [90, 92, 95, 98, 100, 102],
              borderColor: '#ffb443',
              tension: 0.4,
              fill: false
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom'
            }
          },
          scales: {
            y: {
              title: {
                display: true,
                text: 'Sales (Units in 1000s)'
              }
            }
          }
        }
      });

      // Year selection handlers
      document.getElementById('barYearSelect').addEventListener('change', function() {
        currentBarYear = this.value;
        barChart.data.datasets[0].data = chartData.barDataByYear[currentBarYear];
        barChart.update();
      });
      
      document.getElementById('lineYearSelect').addEventListener('change', function() {
        currentLineYear = this.value;
        lineChart.destroy();
        lineChart = new Chart(lineCtx, {
          type: 'line',
          data: {
            labels: months,
            datasets: chartData.lineDataByYear[currentLineYear]
          },
          options: lineChart.options
        });
      });

      // Table year selector
      document.getElementById('tableYearSelect').addEventListener('change', function() {
        // In a real implementation, this would fetch new data for the selected year
        console.log('Selected year:', this.value);
      });

      // Animation for elements when they come into view
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('animate-fadein');
          }
        });
      }, { threshold: 0.1 });
      
      document.querySelectorAll('.dashboard-card').forEach(card => {
        observer.observe(card);
      });
    </script>

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