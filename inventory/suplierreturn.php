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
      <!-- Include sidebar -->
      <?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
      <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->

      <!-- Page Wrapper -->
      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Supplier Return List</h4>
              <h6>Manage your Returns</h6>
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
                          <option>Choose Supplier</option>
                          <option>Supplier</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Status</option>
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
                      <th>
                       NO
                      </th>
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
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        1
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product1.jpg" alt="product" />
                        </a>
                      </td>
                      <td>2/27/2022</td>
                      <td>Apex Computers</td>
                      <td>IKEA Alam Sutera</td>
                      <td>PT001</td>
                      <td>550</td>
                      <td>120</td>
                      <td>550</td>
                      <td><span class="badges bg-lightgreen">Paid</span></td>
                      <td><span class="badges bg-lightgreen">Received</span></td>

                    </tr>
                    <tr>
                      <td>
                        2
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product2.jpg" alt="product" />
                        </a>
                      </td>
                      <td>1/15/2022</td>
                      <td>Modern Automobile</td>
                      <td>IKEA Sentul City</td>
                      <td>PT002</td>
                      <td>550</td>
                      <td>120</td>
                      <td>550</td>
                      <td><span class="badges bg-lightyellow">Partial</span></td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>

                    </tr>
                    <tr>
                      <td>
                        3
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product3.jpg" alt="product" />
                        </a>
                      </td>
                      <td>3/24/2022</td>
                      <td>AIM Infotech</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>PT003</td>
                      <td>210</td>
                      <td>120</td>
                      <td>210</td>
                      <td><span class="badges bg-lightred">Unpaid</span></td>
                      <td><span class="badges bg-lightred">Pending</span></td>

                    </tr>
                    <tr>
                      <td>
                        4
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product4.jpg" alt="product" />
                        </a>
                      </td>
                      <td>1/15/2022</td>
                      <td>Best Power Tools</td>
                      <td>IKEA Sentul City</td>
                      <td>PT004</td>
                      <td>210</td>
                      <td>120</td>
                      <td>210</td>
                      <td><span class="badges bg-lightgreen">Paid</span></td>
                      <td><span class="badges bg-lightgreen">Received</span></td>

                    </tr>
                    <tr>
                      <td>
                        5
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product5.jpg" alt="product" />
                        </a>
                      </td>
                      <td>1/15/2022</td>
                      <td>AIM Infotech</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>PT005</td>
                      <td>210</td>
                      <td>120</td>
                      <td>210</td>
                      <td><span class="badges bg-lightred">UnPaid</span></td>
                      <td><span class="badges bg-lightred">Pending</span></td>

                    </tr>
                    <tr>
                      <td>
                        6
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product6.jpg" alt="product" />
                        </a>
                      </td>
                      <td>3/24/2022</td>
                      <td>Best Power Tools</td>
                      <td>IKEA Bali</td>
                      <td>PT006</td>
                      <td>210</td>
                      <td>120</td>
                      <td>210</td>
                      <td><span class="badges bg-lightgreen">paid</span></td>
                      <td><span class="badges bg-lightgreen">Received</span></td>

                    </tr>
                    <tr>
                      <td>
                        7
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product7.jpg" alt="product" />
                        </a>
                      </td>
                      <td>1/15/2022</td>
                      <td>Apex Computers</td>
                      <td>IKEA Sentul City</td>
                      <td>PT007</td>
                      <td>1000</td>
                      <td>500</td>
                      <td>1000</td>
                      <td><span class="badges bg-lightyellow">Partial</span></td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>

                    </tr>
                    <tr>
                      <td>
                        8
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product8.jpg" alt="product" />
                        </a>
                      </td>
                      <td>3/24/2022</td>
                      <td>Best Power Tools</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>PT008</td>
                      <td>210</td>
                      <td>120</td>
                      <td>210</td>
                      <td><span class="badges bg-lightgreen">paid</span></td>
                      <td><span class="badges bg-lightgreen">Received</span></td>

                    </tr>
                    <tr>
                      <td>
                        9
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product9.jpg" alt="product" />
                        </a>
                      </td>
                      <td>3/24/2022</td>
                      <td>Hatimi Hardware & Tools</td>
                      <td>IKEA Mal Taman Anggrek</td>
                      <td>PT009</td>
                      <td>5500</td>
                      <td>550</td>
                      <td>5500</td>
                      <td><span class="badges bg-lightred">Unpaid</span></td>
                      <td><span class="badges bg-lightred">Pending</span></td>

                    </tr>
                    <tr>
                      <td>
                        9
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product10.jpg" alt="product" />
                        </a>
                      </td>
                      <td>3/24/2022</td>
                      <td>Best Power Tools</td>
                      <td>IKEA Sentul City</td>
                      <td>PT0010</td>
                      <td>2580</td>
                      <td>1250</td>
                      <td>2580</td>
                      <td><span class="badges bg-lightred">Unpaid</span></td>
                      <td><span class="badges bg-lightred">Pending</span></td>

                    </tr>
                    <tr>
                      <td>
                        10
                      </td>
                      <td>
                        <a class="product-img">
                          <img src="../assets/img/product/product5.jpg" alt="product" />
                        </a>
                      </td>
                      <td>3/24/2022</td>
                      <td>Best Power Tools</td>
                      <td>IKEA Bali</td>
                      <td>PT0011</td>
                      <td>2580</td>
                      <td>1250</td>
                      <td>2580</td>
                      <td><span class="badges bg-lightred">Unpaid</span></td>
                      <td><span class="badges bg-lightred">Pending</span></td>

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
