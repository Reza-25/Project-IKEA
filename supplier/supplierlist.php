<?php
require_once __DIR__ . '/../include/config.php'; // Import config.php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>IKEA</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="../assets/css/animate.css" />

    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />

    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="../assets/css/style.css" />
        <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            background: #f5f5f5;
            color: #1a1a1a;
        }
        
        .main-content {
            padding: 2rem;
        }
        
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .metric-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .metric-card:hover {
            transform: translateY(-4px);
        }
        
        .metric-title {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
        }
        
        .metric-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #003d7a;
            margin-bottom: 0.5rem;
        }
        
        .metric-change {
            font-size: 0.85rem;
            color: #28a745;
        }
        
        .metric-change.negative {
            color: #dc3545;
        }
        
        .chart-container {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #003d7a;
        }
        
        .chart {
            height: 300px;
            display: flex;
            align-items: end;
            gap: 1rem;
            padding: 1rem 0;
        }
        
        .chart-bar {
            flex: 1;
            background: linear-gradient(to top, #003d7a, #0066cc);
            border-radius: 8px 8px 0 0;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .chart-bar:hover {
            background: linear-gradient(to top, #ffda1a, #ffd700);
        }
        
        .chart-label {
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.8rem;
            color: #666;
        }
        
        .orders-section {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }
        
        .orders-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .orders-table th {
            text-align: left;
            padding: 1rem;
            border-bottom: 2px solid #f0f0f0;
            color: #666;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .orders-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .orders-table tr:hover {
            background-color: #f8f9fa;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-align: center;
            min-width: 80px;
        }
        
        .status-shipped {
            background: #d4edda;
            color: #155724;
        }
        
        .status-processing {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-delivered {
            background: #cce5ff;
            color: #004085;
        }
        
        .performance-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .performance-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            text-align: center;
        }
        
        .performance-value {
            font-size: 3rem;
            font-weight: bold;
            color: #28a745;
            margin: 1rem 0;
        }
        
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .metrics-grid {
                grid-template-columns: 1fr;
            }
            
            .performance-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

<div class="main-wrapper">
<!-- Include sidebar -->
<?php include BASE_PATH . '../include/sidebar.php'; ?>
<?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
</div>

      <div class="page-wrapper">
        <div class="content">
                  <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-title">Total Procurement Value</div>
                <div class="metric-value">€4.78M</div>
                <div class="metric-change">↗ 3.5% from last quarter</div>
            </div>
            <div class="metric-card">
                <div class="metric-title">Active Suppliers</div>
                <div class="metric-value">248</div>
                <div class="metric-change">↗ 2.1% from last quarter</div>
            </div>
            <div class="metric-card">
                <div class="metric-title">New Suppliers</div>
                <div class="metric-value">32</div>
                <div class="metric-change">↗ 4.3% from last quarter</div>
            </div>
            <div class="metric-card">
                <div class="metric-title">Sustainability Score</div>
                <div class="metric-value">87%</div>
                <div class="metric-change">↗ 1.8% from last quarter</div>
            </div>
        </div>
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Monthly Procurement Value</h3>
            </div>
            <div class="chart">
                <div class="chart-bar" style="height: 60%">
                    <div class="chart-label">Jan</div>
                </div>
                <div class="chart-bar" style="height: 45%">
                    <div class="chart-label">Feb</div>
                </div>
                <div class="chart-bar" style="height: 80%">
                    <div class="chart-label">Mar</div>
                </div>
                <div class="chart-bar" style="height: 55%">
                    <div class="chart-label">Apr</div>
                </div>
                <div class="chart-bar" style="height: 100%">
                    <div class="chart-label">May</div>
                </div>
                <div class="chart-bar" style="height: 35%">
                    <div class="chart-label">Jun</div>
                </div>
            </div>
        </div>
        <div class="performance-grid">
            <div class="performance-card">
                <div class="metric-title">On-time Delivery Rate</div>
                <div class="performance-value">98.2%</div>
                <div class="metric-change">↗ 1.2% improvement from last quarter</div>
            </div>
            <div class="performance-card">
                <div class="metric-title">Quality Acceptance Rate</div>
                <div class="performance-value">95.7%</div>
                <div class="metric-change">↗ 0.8% improvement from last quarter</div>
            </div>
        </div>
        <div class="orders-section">
            <div class="orders-header">
                <h3 class="chart-title">Recent Orders</h3>
            </div>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Product Category</th>
                        <th>Supplier Name</th>
                        <th>Order ID</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Sofas & Armchairs</strong></td>
                        <td>Nordic Furnishings AB</td>
                        <td>#IKEA-SUP-78945</td>
                        <td>250 units</td>
                        <td>€127,500</td>
                        <td><span class="status-badge status-shipped">Shipped</span></td>
                    </tr>
                    <tr>
                        <td><strong>Storage Solutions</strong></td>
                        <td>Baltic Woodworks Ltd</td>
                        <td>#IKEA-SUP-78946</td>
                        <td>1,200 units</td>
                        <td>€89,400</td>
                        <td><span class="status-badge status-processing">Processing</span></td>
                    </tr>
                    <tr>
                        <td><strong>Lighting</strong></td>
                        <td>Scandinavian Lights Co</td>
                        <td>#IKEA-SUP-78947</td>
                        <td>500 units</td>
                        <td>€45,000</td>
                        <td><span class="status-badge status-delivered">Delivered</span></td>
                    </tr>
                    <tr>
                        <td><strong>Kitchen Accessories</strong></td>
                        <td>Finnish Design House</td>
                        <td>#IKEA-SUP-78948</td>
                        <td>800 units</td>
                        <td>€32,000</td>
                        <td><span class="status-badge status-shipped">Shipped</span></td>
                    </tr>
                    <tr>
                        <td><strong>Textiles & Rugs</strong></td>
                        <td>Swedish Textile Mills</td>
                        <td>#IKEA-SUP-78949</td>
                        <td>2,000 units</td>
                        <td>€156,000</td>
                        <td><span class="status-badge status-processing">Processing</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
          <div class="page-header">
            <div class="page-title">
              <h4>Supplier List</h4>
              <h6>Manage your supplier</h6>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="table-top">
                <div class="search-set">
                  <div class="search-path">
                    <a class="btn btn-filter" id="filter_search">
                      <img src="../assets/img/icons/filter.svg" alt="img" />
                      <span><img src="../assets/img/icons/closes.svg" alt="img" /></span>
                    </a>
                  </div>
                  <div class="search-input">
                    <a class="btn btn-searchset"><img src="../assets/img/icons/search-white.svg" alt="img" /></a>
                  </div>
                </div>
                <div class="wordset">
                  <ul>
                    <li>
                      <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="../assets/img/icons/pdf.svg" alt="img" /></a>
                    </li>
                    <li>
                      <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="../assets/img/icons/excel.svg" alt="img" /></a>
                    </li>
                    <li>
                      <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="../assets/img/icons/printer.svg" alt="img" /></a>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Name" />
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Reference No" />
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Completed</option>
                          <option>Paid</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="form-group">
                        <a class="btn btn-filters ms-auto"><img src="../assets/img/icons/search-whites.svg" alt="img" /></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table datanew">
                  <thead>
                    <tr>
                      <th>
                        <label class="checkboxs">
                          <input type="checkbox" id="select-all" />
                          <span class="checkmarks"></span>
                        </label>
                      </th>
                      <th>Supplier Name</th>
                      <th>Date</th>
                      <th>Reference</th>
                      <th>Total</th>
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Biller</th>
                      <th>Status</th>
                      <th>Payment</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Delivery</td>
                      <td>19 Nov 2022</td>
                      <td>SL0101</td>
                      <td>0.00</td>
                      <td>0.00</td>
                      <td class="text-red">100.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      <td><span class="badges bg-lightgreen">Paid</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Supplier Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Delivery</td>
                      <td>19 Nov 2022</td>
                      <td>SL0102</td>
                      <td>0.00</td>
                      <td>0.00</td>
                      <td class="text-red">100.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      <td><span class="badges bg-lightgreen">Paid</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Delivery</td>
                      <td>19 Nov 2022</td>
                      <td>SL0103</td>
                      <td>0.00</td>
                      <td class="text-green">100.00</td>
                      <td>0.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      <td><span class="badges bg-lightgreen">Paid</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Fred C. Rasmussen</td>
                      <td>19 Nov 2022</td>
                      <td>SL0104</td>
                      <td>0.00</td>
                      <td class="text-green">100.00</td>
                      <td>0.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      <td><span class="badges bg-lightred">Due</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Thomas M. Martin</td>
                      <td>19 Nov 2022</td>
                      <td>SL0105</td>
                      <td>0.00</td>
                      <td>0.00</td>
                      <td class="text-green">100.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      <td><span class="badges bg-lightred">Due</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Thomas M. Martin</td>
                      <td>19 Nov 2022</td>
                      <td>SL0106</td>
                      <td>0.00</td>
                      <td>0.00</td>
                      <td class="text-red">100.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      <td><span class="badges bg-lightgreen">Paid</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Delivery</td>
                      <td>19 Nov 2022</td>
                      <td>SL0107</td>
                      <td>0.00</td>
                      <td>0.00</td>
                      <td class="text-red">100.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      <td><span class="badges bg-lightgreen">Paid</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Delivery</td>
                      <td>19 Nov 2022</td>
                      <td>SL0108</td>
                      <td>0.00</td>
                      <td class="text-green">100.00</td>
                      <td>0.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      <td><span class="badges bg-lightred">Due</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Delivery</td>
                      <td>19 Nov 2022</td>
                      <td>SL0109</td>
                      <td>0.00</td>
                      <td class="text-green">100.00</td>
                      <td>0.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      <td><span class="badges bg-lightred">Due</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Delivery</td>
                      <td>19 Nov 2022</td>
                      <td>SL0110</td>
                      <td>0.00</td>
                      <td class="text-green">100.00</td>
                      <td>0.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      <td><span class="badges bg-lightred">Due</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>Delivery</td>
                      <td>19 Nov 2022</td>
                      <td>SL0111</td>
                      <td>0.00</td>
                      <td>0.00</td>
                      <td>0.00</td>
                      <td>Store</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      <td><span class="badges bg-lightred">Due</span></td>
                      <td class="text-center">
                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="supplier-detail.php" class="dropdown-item"><img src="../assets/img/icons/eye1.svg" class="me-2" alt="img" />Sale Detail</a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showpayment"><img src="../assets/img/icons/dollar-square.svg" class="me-2" alt="img" />Show Payments</a>
                          </li>

                        </ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="showpayment" tabindex="-1" aria-labelledby="showpayment" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Show Payments</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Paid By</th>
                    <th>Paid By</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="bor-b1">
                    <td>2022-03-07</td>
                    <td>INV/SL0101</td>
                    <td>$ 0.00</td>
                    <td>Cash</td>
                    <td>
                      <a class="me-2" href="javascript:void(0);">
                        <img src="../assets/img/icons/printer.svg" alt="img" />
                      </a>
                      <a class="me-2" href="javascript:void(0);" data-bs-target="#editpayment" data-bs-toggle="modal" data-bs-dismiss="modal">
                        <img src="../assets/img/icons/edit.svg" alt="img" />
                      </a>
                      <a class="me-2 confirm-text" href="javascript:void(0);">
                        <img src="../assets/img/icons/delete.svg" alt="img" />
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="createpayment" tabindex="-1" aria-labelledby="createpayment" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Customer</label>
                  <div class="input-groupicon">
                    <input type="text" value="2022-03-07" class="datetimepicker" />
                    <div class="addonset">
                      <img src="../assets/img/icons/calendars.svg" alt="img" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Reference</label>
                  <input type="text" value="INV/SL0101" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Received Amount</label>
                  <input type="text" value="0.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Paying Amount</label>
                  <input type="text" value="0.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Payment type</label>
                  <select class="select">
                    <option>Cash</option>
                    <option>Online</option>
                    <option>Inprogress</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mb-0">
                  <label>Note</label>
                  <textarea class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-submit">Submit</button>
            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editpayment" tabindex="-1" aria-labelledby="editpayment" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Payment</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Customer</label>
                  <div class="input-groupicon">
                    <input type="text" value="2022-03-07" class="datetimepicker" />
                    <div class="addonset">
                      <img src="../assets/img/icons/datepicker.svg" alt="img" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Reference</label>
                  <input type="text" value="INV/SL0101" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Received Amount</label>
                  <input type="text" value="0.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Paying Amount</label>
                  <input type="text" value="0.00" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Payment type</label>
                  <select class="select">
                    <option>Cash</option>
                    <option>Online</option>
                    <option>Inprogress</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mb-0">
                  <label>Note</label>
                  <textarea class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-submit">Submit</button>
            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>

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
    <script> 
            // Interactive chart hover effects
        document.querySelectorAll('.chart-bar').forEach(bar => {
            bar.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
            });
            
            bar.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
        
        // Metric cards animation on scroll
        function animateOnScroll() {
            const cards = document.querySelectorAll('.metric-card, .performance-card');
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        }
        
        // Initialize card animations
        document.querySelectorAll('.metric-card, .performance-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
        
        // Table row hover effects
        document.querySelectorAll('.orders-table tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8f9fa';
                this.style.cursor = 'pointer';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });
    </script>
  </body>
</html>
