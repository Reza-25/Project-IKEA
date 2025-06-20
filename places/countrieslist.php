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
                        NO
                      </th>
                      <th>Store ID</th>
                      <th>Store Name</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>Telephone</th>
                      <th>Land Area</th>
                      <th>Establish</th>
                      <th>Status</th>
                      <th>Payment</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        1
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
  </body>
</html>
