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
    <title>IKEA</title>
    <link href="../assets/img/favicon.jpg" rel="shortcut icon" type="image/x-icon" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/fontawesome.min.css" rel="stylesheet" />
    <link href="../assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
  </head>
  <body>
    <div id="global-loader">
      <div class="whirly-loader"></div>
    </div>

    <?php include __DIR__ . '/../include/header.php'; ?> <!-- Import header -->
    <div class="main-wrapper">
      <!-- Include sidebar -->
      <?php include BASE_PATH . '/include/sidebar.php'; ?> <!-- Import sidebar -->
      <!-- /Include sidebar -->
      
      <!-- Page Wrapper -->
      <div class="page-wrapper">
        <div class="content">
          <div class="page-header">
            <div class="page-title">
              <h4>Product List</h4>
              <h6>Manage your products</h6>
            </div>
            <div class="page-btn">
              <a class="btn btn-added" href="addproduct.php"><img alt="img" class="me-1" src="../assets/img/icons/plus.svg" />Add New Product</a>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="table-top">
                <div class="search-set">
                  <div class="search-path">
                    <a class="btn btn-filter" id="filter_search">
                      <img alt="img" src="../assets/img/icons/filter.svg" />
                      <span><img alt="img" src="../assets/img/icons/closes.svg" /></span>
                    </a>
                  </div>
                  <div class="search-input">
                    <a class="btn btn-searchset"><img alt="img" src="../assets/img/icons/search-white.svg" /></a>
                  </div>
                </div>
                <div class="wordset">
                  <ul>
                    <li>
                      <a data-bs-placement="top" data-bs-toggle="tooltip" title="pdf"><img alt="img" src="../assets/img/icons/pdf.svg" /></a>
                    </li>
                    <li>
                      <a data-bs-placement="top" data-bs-toggle="tooltip" title="excel"><img alt="img" src="../assets/img/icons/excel.svg" /></a>
                    </li>
                    <li>
                      <a data-bs-placement="top" data-bs-toggle="tooltip" title="print"><img alt="img" src="../assets/img/icons/printer.svg" /></a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card mb-0" id="filter_inputs">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-lg-12 col-sm-12">
                      <div class="row">
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Choose Product</option>
                              <option>Macbook pro</option>
                              <option>Orange</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Choose Category</option>
                              <option>Computers</option>
                              <option>Fruits</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Choose Sub Category</option>
                              <option>Computer</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Brand</option>
                              <option>N/D</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg col-sm-6 col-12">
                          <div class="form-group">
                            <select class="select">
                              <option>Price</option>
                              <option>150.00</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12">
                          <div class="form-group">
                            <a class="btn btn-filters ms-auto"><img alt="img" src="../assets/img/icons/search-whites.svg" /></a>
                          </div>
                        </div>
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
                          <input id="select-all" type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </th>
                      <th>Product Name</th>
                      <th>SKU</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>price</th>
                      <th>Unit</th>
                      <th>Qty</th>
                      <th>Created By</th>
                      <th>Action</th>
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
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product1.jpg" />
                        </a>
                        <a href="javascript:void(0);">Macbook pro</a>
                      </td>
                      <td>PT001</td>
                      <td>Computers</td>
                      <td>N/D</td>
                      <td>1500.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product2.jpg" />
                        </a>
                        <a href="javascript:void(0);">Orange</a>
                      </td>
                      <td>PT002</td>
                      <td>Fruits</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product3.jpg" />
                        </a>
                        <a href="javascript:void(0);">Pineapple</a>
                      </td>
                      <td>PT003</td>
                      <td>Fruits</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product4.jpg" />
                        </a>
                        <a href="javascript:void(0);">Strawberry</a>
                      </td>
                      <td>PT004</td>
                      <td>Fruits</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product5.jpg" />
                        </a>
                        <a href="javascript:void(0);">Avocat</a>
                      </td>
                      <td>PT005</td>
                      <td>Accessories</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>150.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product6.jpg" />
                        </a>
                        <a href="javascript:void(0);">Macbook Pro</a>
                      </td>
                      <td>PT006</td>
                      <td>Shoes</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product7.jpg" />
                        </a>
                        <a href="javascript:void(0);">Apple Earpods</a>
                      </td>
                      <td>PT007</td>
                      <td>Shoes</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product8.jpg" />
                        </a>
                        <a href="javascript:void(0);">iPhone 11 </a>
                      </td>
                      <td>PT008</td>
                      <td>Fruits</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product9.jpg" />
                        </a>
                        <a href="javascript:void(0);">samsung </a>
                      </td>
                      <td>PT009</td>
                      <td>Earphones</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>pc</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product11.jpg" />
                        </a>
                        <a href="javascript:void(0);">Banana</a>
                      </td>
                      <td>PT0010</td>
                      <td>Health Care</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>kg</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td class="productimgname">
                        <a class="product-img" href="javascript:void(0);">
                          <img alt="product" src="../assets/img/product/product17.jpg" />
                        </a>
                        <a href="javascript:void(0);">Limon</a>
                      </td>
                      <td>PT0011</td>
                      <td>Health Care</td>
                      <td>N/D</td>
                      <td>10.00</td>
                      <td>kg</td>
                      <td>100.00</td>
                      <td>Admin</td>
                      <td>
                        <a class="me-3" href="../product-details.php">
                          <img alt="img" src="../assets/img/icons/eye.svg" />
                        </a>
                        <a class="me-3" href="../editproduct.php">
                          <img alt="img" src="../assets/img/icons/edit.svg" />
                        </a>
                        <a class="confirm-text" href="javascript:void(0);">
                          <img alt="img" src="../assets/img/icons/delete.svg" />
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
    </div>
    <!-- /Page Wrapper -->
     
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
