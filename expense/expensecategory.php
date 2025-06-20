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
    <title>Dreams Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />

    <link rel="stylesheet" href="../assets/css/animate.css" />

    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />

    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="../assets/css/style.css" />
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
    <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
      <!-- Include sidebar -->
      <?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->


      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Expenses Category</h4>
              <h6>Manage your purchases</h6>
            </div>
          </div>

        <!-- CHART SECTION -->
<div class="row mt-4">
  <!-- BAR CHART -->
  <div class="col-md-8">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center py-2 px-3" style="background-color: rgb(64, 90, 138);">
        <h6 class="card-title mb-0 text-white small">Expense Categories Chart</h6>
        <div class="d-flex align-items-center">
          <div class="btn-group btn-group-sm me-2" role="group">
            <button type="button" class="btn btn-outline-light rounded-pill" id="monthlyBtn">Monthly</button>
            <button type="button" class="btn btn-light rounded-pill" id="yearlyBtn">Yearly</button>
          </div>
          <select id="monthSelector" class="form-select form-select-sm d-none rounded-pill">
            <option value="january">January</option>
            <option value="february">February</option>
            <option value="march">March</option>
            <option value="april">April</option>
            <option value="may">May</option>
            <option value="june">June</option>
            <option value="july">July</option>
            <option value="august">August</option>
            <option value="september">September</option>
            <option value="october">October</option>
            <option value="november">November</option>
            <option value="december">December</option>
          </select>
        </div>
      </div>
      <div class="card-body p-2">
        <div id="expenseBarChart"></div>
      </div>
    </div>
  </div>

  <!-- EXPENSE TOTAL CARD -->
  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-header text-center text-white py-2" style="background-color: rgb(53, 53, 220);">
        <h6 class="card-title mb-0 small">Total Expenses</h6>
      </div>
      <div class="card-body d-flex flex-column justify-content-center align-items-center p-3">
        <div class="text-center">
          <h3 class="text-primary mb-2" id="totalExpenseAmount">-</h3>
          <p class="text-muted mb-2 small">Total Amount <span id="periodText">This Year</span></p>
          <div class="row text-center">
            <div class="col-6">
              <div class="border-end">
                <h6 class="text-success mb-1" id="activeCount">9</h6>
                <small class="text-muted">DONE</small>
              </div>
            </div>
            <div class="col-6">
              <h6 class="text-danger mb-1" id="inactiveCount">3</h6>
              <small class="text-muted">Inactive</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CHART SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const monthlyDataPerMonth = {
    january: { categories: ['Food', 'Transport'], amounts: [300000, 150000] },
    february: { categories: ['Food', 'Shopping'], amounts: [400000, 200000] },
    march: { categories: ['Utilities', 'Food'], amounts: [100000, 250000] },
    april: { categories: ['Transport', 'Entertainment'], amounts: [200000, 180000] },
    may: { categories: ['Food', 'Transport'], amounts: [350000, 120000] },
    june: { categories: ['Food', 'Shopping'], amounts: [500000, 200000] },
    july: { categories: ['Utilities', 'Shopping'], amounts: [160000, 210000] },
    august: { categories: ['Food', 'Transport'], amounts: [450000, 100000] },
    september: { categories: ['Entertainment', 'Utilities'], amounts: [250000, 120000] },
    october: { categories: ['Shopping', 'Transport'], amounts: [300000, 140000] },
    november: { categories: ['Food', 'Utilities'], amounts: [420000, 110000] },
    december: { categories: ['Transport', 'Food'], amounts: [180000, 280000] }
  };

  const yearlyData = {
    categories: ['2022', '2023', '2024', '2025'],
    amounts: [8000000, 7500000, 9000000, 6500000]
  };

  const chart = new ApexCharts(document.querySelector("#expenseBarChart"), {
    chart: {
      type: 'bar',
      height: 250
    },
    plotOptions: {
      bar: {
        horizontal: true,
        barHeight: '50%'
      }
    },
    series: [{
      name: 'Amount',
      data: yearlyData.amounts
    }],
    xaxis: {
      categories: yearlyData.categories,
      labels: {
        style: { fontSize: '12px' }
      }
    }
  });

  chart.render();

  document.getElementById("monthlyBtn").addEventListener("click", () => {
    document.getElementById("monthSelector").classList.remove("d-none");
    const selectedMonth = document.getElementById("monthSelector").value;
    updateMonthlyChart(selectedMonth);
    toggleButtons('monthly');
  });

  document.getElementById("yearlyBtn").addEventListener("click", () => {
    document.getElementById("monthSelector").classList.add("d-none");
    chart.updateOptions({
      xaxis: { categories: yearlyData.categories },
      series: [{ name: 'Amount', data: yearlyData.amounts }]
    });
    toggleButtons('yearly');
    updateTotalExpense(yearlyData.amounts, "This Year");
  });

  document.getElementById("monthSelector").addEventListener("change", function () {
    const selectedMonth = this.value;
    updateMonthlyChart(selectedMonth);
  });

  function updateMonthlyChart(month) {
    const data = monthlyDataPerMonth[month];
    if (data) {
      chart.updateOptions({
        xaxis: { categories: data.categories },
        series: [{ name: 'Amount', data: data.amounts }]
      });
      const monthCapitalized = month.charAt(0).toUpperCase() + month.slice(1);
      updateTotalExpense(data.amounts, monthCapitalized);
    }
  }

  function updateTotalExpense(amounts, labelText) {
    const total = amounts.reduce((sum, val) => sum + val, 0);
    document.getElementById("totalExpenseAmount").textContent = `Rp ${total.toLocaleString('id-ID')}`;
    document.getElementById("periodText").textContent = labelText;
  }

  function toggleButtons(DONE) {
    const monthlyBtn = document.getElementById("monthlyBtn");
    const yearlyBtn = document.getElementById("yearlyBtn");

    if (DONE === 'monthly') {
      monthlyBtn.classList.remove("btn-outline-light");
      monthlyBtn.classList.add("btn-light");
      yearlyBtn.classList.remove("btn-light");
      yearlyBtn.classList.add("btn-outline-light");
    } else {
      yearlyBtn.classList.remove("btn-outline-light");
      yearlyBtn.classList.add("btn-light");
      monthlyBtn.classList.remove("btn-light");
      monthlyBtn.classList.add("btn-outline-light");
    }
  }

  // Init: set yearly total first
  updateTotalExpense(yearlyData.amounts, "This Year");
});
</script>


          <div class="card mt-4">
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
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" class="datetimepicker cal-icon" placeholder="Choose Date" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <input type="text" placeholder="Enter Reference" />
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Category</option>
                          <option>Computers</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Status</option>
                          <option>Complete</option>
                          <option>Inprogress</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-1 col-sm-6 col-12 ms-auto">
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
                      <th>No</th>
                      <th>Category name</th>
                      <th>Date</th>
                      <th>Reference</th>
                      <th>Amount</th>
                      <th>Description</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Employee Benefits</td>
                      <td>2/27/2022-2/04/2022</td>
                      <td>PT001</td>
                      <td>120</td>
                      <td>Employee Vehicle</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Foods & Snacks</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT002</td>
                      <td>250</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Entertainment</td>
                      <td>3/24/2022-4/24/2022</td>
                      <td>PT003</td>
                      <td>120</td>
                      <td>Office Vehicle</td>
                      <td><span class="badges bg-lightred">ON PROGRESS</span></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Office Expenses & Postage</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT004</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Office Expenses & Postage</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT004</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>Office Expenses & Postage</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT004</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>Office Expenses & Postage</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT004</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>8</td>
                      <td>Office Expenses & Postage</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT004</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>9</td>
                      <td>Office Expenses & Postage</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT004</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>10</td>
                      <td>Office Expenses & Postage</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT004</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>11</td>
                      <td>Office Expenses & Postage</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT004</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                    <tr>
                      <td>12</td>
                      <td>Office Expenses & Postage</td>
                      <td>1/15/2022-3/16/2022</td>
                      <td>PT004</td>
                      <td>320</td>
                      <td>Employee Foods</td>
                      <td><span class="badges bg-lightgreen">DONE</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
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

    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="../assets/plugins/select2/js/select2.min.js"></script>

    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="../assets/js/script.js"></script>
  </body>
</html>
