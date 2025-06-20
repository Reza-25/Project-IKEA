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
    <title> IKEA</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.jpg" />

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="../assets/css/animate.css" />

    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />

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
      <!-- Include sidebar -->
      <?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
      <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->

      
      <!-- Page Wrapper -->
      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Transfer List</h4>
              <h6>Transfer your stocks to one store another store.</h6>
            </div>
            <div class="page-btn">
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
                    <a class="btn btn-searchset">
                      <img src="../assets/img/icons/search-white.svg" alt="img" />
                    </a>
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
                          <option>Choose Status</option>
                          <option>Inprogress</option>
                          <option>Complete</option>
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
                      <th>Date</th>
                      <th>Reference</th>
                      <th>From Branch</th>
                      <th>To Branch</th>
                      <th>Items Total</th>
                      <th>Money Spent</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>19 Nov 2022</td>
                      <td>TR0101</td>
                      <td>IKEA Alam Sutera</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>10</td>
                      <td>1500.00</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>19 Nov 2022</td>
                      <td>TR0102</td>
                      <td>IKEA Sentul City</td>
                      <td>IKEA Bali</td>
                      <td>20</td>
                      <td>45000.00</td>
                      <td><span class="badges bg-lightyellow">On Progress</span></td>                      
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>19 Nov 2022</td>
                      <td>TR0103</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>IKEA Mal Taman Anggrek</td>
                      <td>15</td>
                      <td>2400.00</td>
                      <td><span class="badges bg-lightyellow">On Progress</span></td>                      
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>19 Nov 2022</td>
                      <td>TR0104</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>IKEA Alam Sutera</td>
                      <td>34</td>
                      <td>2400.00</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>19 Nov 2022</td>
                      <td>TR0105</td>
                      <td>IKEA Bali</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>56</td>
                      <td>2400.00</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>19 Nov 2022</td>
                      <td>TR0106</td>
                      <td>IKEA Mal Taman Anggrek</td>
                      <td>IKEA Alam Sutera</td>
                      <td>23</td>
                      <td>8456.00</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>19 Nov 2022</td>
                      <td>TR0107</td>
                      <td>IKEA Sentul City</td>
                      <td>IKEA Mal Taman Anggrek</td>
                      <td>33</td>
                      <td>150.00</td>
                      <td><span class="badges bg-lightgreen">Completed</span></td>
                      
                    </tr>
                    <tr>
                      <td>8</td>
                      <td>19 Nov 2022</td>
                      <td>TR0108</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>44</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      
                    </tr>
                    <tr>
                      <td>9</td>
                      <td>19 Nov 2022</td>
                      <td>TR0109</td>
                      <td>IKEA Alam Sutera</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>12</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      
                    </tr>
                    <tr>
                      <td>10</td>
                      <td>19 Nov 2022</td>
                      <td>TR01010</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>IKEA Sentul City</td>
                      <td>33</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      
                    </tr>
                    <tr>
                      <td>11</td>
                      <td>19 Nov 2022</td>
                      <td>TR0111</td>
                      <td>IKEA Bali</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>10</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                      
                    </tr>
                    <tr>
                      <td>12</td>
                      <td>19 Nov 2022</td>
                      <td>TR0112</td>
                      <td>IKEA Mal Taman Anggrek</td>
                      <td>IKEA Bali</td>
                      <td>10</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightyellow">On Progress</span></td>
                      
                    </tr>
                    <tr>
                      <td>13</td>
                      <td>19 Nov 2022</td>
                      <td>TR0113</td>
                      <td>IKEA Alam Sutera</td>
                      <td>IKEA Bali</td>
                      <td>10</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightyellow">On Progress</span></td>
                      
                    </tr>
                    <tr>
                      <td>14</td>
                      <td>19 Nov 2022</td>
                      <td>TR0114</td>
                      <td>IKEA Sentul City</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>10</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightyellow">On Progress</span></td>
                      
                    </tr>
                    <tr>
                      <td>15</td>
                      <td>19 Nov 2022</td>
                      <td>TR0115</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>IKEA Sentul City</td>
                      <td>10</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightred">Not Started</span></td>
                      
                    </tr>
                    <tr>
                      <td>16</td>
                      <td>19 Nov 2022</td>
                      <td>TR0116</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>IKEA Bali</td>
                      <td>32</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightred">Not Started</span></td>
                      
                    </tr>
                    <tr>
                      <td>17</td>
                      <td>19 Nov 2022</td>
                      <td>TR0117</td>
                      <td>IKEA Bali</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>24</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightred">Not Started</span></td>
                      
                    </tr>
                    <tr>
                      <td>18</td>
                      <td>19 Nov 2022</td>
                      <td>TR0118</td>
                      <td>IKEA Mal Taman Anggrek</td>
                      <td>IKEA Sentul City</td>
                      <td>10</td>
                      <td>365.00</td>
                      <td><span class="badges bg-lightred">Not Started</span></td>
                      
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
