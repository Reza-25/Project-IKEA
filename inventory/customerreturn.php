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
              <h4>Sales Return List</h4>
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
                          <option>Choose Customer</option>
                          <option>Customer</option>
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
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="form-group">
                        <select class="select">
                          <option>Choose Payment Status</option>
                          <option>Payment Status</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
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
                      <th>NO
                      </th>
                      <th>Category Name</th>
                      <th>Date</th>
                      <th>Branch</th>
                      <th>Supplier</th>
                      <th>Revund Total</th>
                      <th>Percentage</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        1
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Furniture</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Sentul City</td>
                      <td>Apex Computers</td>
                      <td>1200</td>
                      <td>10.1%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        2
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product2.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Lighting</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Mal Taman Anggrek</td>
                      <td>Modern Automobile</td>
                      <td>800</td>
                      <td>6.7%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>
                    
                    <tr>
                      <td>
                        3
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product3.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Storage</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>AIM Infotech</td>
                      <td>950</td>
                      <td>8.0%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        4
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product4.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Bedroom</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>Best Power Tools</td>
                      <td>1000</td>
                      <td>8.4%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        5
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product5.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Living Room</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Sentul City</td>
                      <td>AIM Infotech</td>
                      <td>1100</td>
                      <td>9.2%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        6
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product6.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Kitchen</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Bali</td>
                      <td>Best Power Tools</td>
                      <td>700</td>
                      <td>5.9%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        7
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product7.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Dining</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>Apex Computers</td>
                      <td>600</td>
                      <td>5.0%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
                    </tr>

                    <tr>
                      <td>
                        8
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product1.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Office</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Sentul City</td>
                      <td>Best Power Tools</td>
                      <td>550</td>
                      <td>4.6%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        9
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product2.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Outdoor</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Mal Taman Anggrek</td>
                      <td>Hatimi Hardware & Tools</td>
                      <td>400</td>
                      <td>3.4%</td>
                      <td><span class="badges bg-lightyellow">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        10
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product3.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Textiles</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>Best Power Tools</td>
                      <td>650</td>
                      <td>5.5%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        11
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product4.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Decoration</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>Modern Automobile</td>
                      <td>300</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        12
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product5.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Bathroom</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Sentul City</td>
                      <td>Apex Computers</td>
                      <td>480</td>
                      <td>4.0%</td>
                      <td><span class="badges bg-lightred">Pending</span></td>
                    </tr>

                    <tr>
                      <td>
                        13
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product6.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Children</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Bali</td>
                      <td>Modern Automobile</td>
                      <td>500</td>
                      <td>4.2%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                      14
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product7.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Appliances</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>Modern Automobile</td>
                      <td>320</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
                    </tr>

                    <tr>
                      <td>
                        15
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product2.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Rugs</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Sentul City</td>
                      <td>Modern Automobile</td>
                      <td>430</td>
                      <td>3.6%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        16
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product7.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Curtains</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>Best Power Tools</td>
                      <td>290</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
                    </tr>

                    <tr>
                      <td>
                        17
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product6.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Tableware</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Alam Sutera</td>
                      <td>AIM Infotech</td>
                      <td>510</td>
                      <td>4.3%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        18
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product5.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Cookware</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Sentul City</td>
                      <td>Hatimi Hardware & Tools</td>
                      <td>620</td>
                      <td>5.2%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        19
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product4.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Laundry</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Jakarta Garden City</td>
                      <td>Best Power Tools</td>
                      <td>230</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
                    </tr>

                    <tr>
                      <td>
                        20
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product3.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Cleaning</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Sentul City</td>
                      <td>Hatimi Hardware & Tools</td>
                      <td>190</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightgreen">Received</span></td>
                    </tr>

                    <tr>
                      <td>
                        21
                      </td>
                      <td class="productimgname">
                        <a href="javascript:void(0);" class="product-img">
                          <img src="../assets/img/product/product2.jpg" alt="product" />
                        </a>
                        <a href="javascript:void(0);">Pet</a>
                      </td>
                      <td>19 Nov 2022</td>
                      <td>IKEA Kota Baru Parahyangan</td>
                      <td>Modern Automobile</td>
                      <td>100</td>
                      <td>1.9%</td>
                      <td><span class="badges bg-lightyellow">Ordered</span></td>
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
