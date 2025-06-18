<?php
// Pastikan BASE_URL sudah terdefinisi sebelumnya
if (!defined('BASE_URL')) {
    die('BASE_URL not defined. Please include config.php before this file.');
}

// Dapatkan nama file saat ini
$current_file = basename($_SERVER['PHP_SELF']);

// Fungsi untuk mengecek halaman aktif
function is_active($pages) {
    global $current_file;
    return in_array($current_file, (array)$pages) ? 'active' : '';
}
?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- Dashboard -->
                <li class="<?= is_active(['index.php']) ?>">
                    <a href="../index.php"><img src="../assets/img/icons/dashboard.svg" alt="img" /><span> Dashboard</span> </a>
                </li>
                
                <!-- Product -->
                <li class="submenu <?= is_active(['productlist.php', 'categorylist.php', 'brandlist.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/product.svg" alt="img" /><span> Product</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['productlist.php']) ?>"><a href="../product/productlist.php">Product List</a></li>
                        <li class="<?= is_active(['categorylist.php']) ?>"><a href="../product/categorylist.php">Category List</a></li>
                        <li class="<?= is_active(['brandlist.php']) ?>"><a href="../product/brandlist.php">Brand List</a></li>
                    </ul>
                </li>
                
                <!-- Supplier -->
                <li class="submenu <?= is_active(['supplierlist.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/sales1.svg" alt="img" /><span> Supplier</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['supplierlist.php']) ?>"><a href="../supplier/supplierlist.php">Supplier List</a></li>
                    </ul>
                </li>
                
                <!-- Revenue -->
                <li class="submenu <?= is_active(['revenue.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/purchase1.svg" alt="img" /><span> Revenue</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['revenue.php']) ?>"><a href="../revenue/revenue.php">Revenue</a></li>
                    </ul>
                </li>
                
                <!-- Expense -->
                <li class="submenu <?= is_active(['expenselist.php', 'createexpense.php', 'expensecategory.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/expense1.svg" alt="img" /><span> Expense</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['expenselist.php']) ?>"><a href="../expense/expenselist.php">Expense List</a></li>
                        <li class="<?= is_active(['createexpense.php']) ?>"><a href="../expense/createexpense.php">Add Expense</a></li>
                        <li class="<?= is_active(['expensecategory.php']) ?>"><a href="../expense/expensecategory.php">Expense Category</a></li>
                    </ul>
                </li>
                
                <!-- Quotation -->
                <li class="submenu <?= is_active(['quotationList.php', 'addquotation.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/quotation1.svg" alt="img" /><span> Quotation</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['quotationList.php']) ?>"><a href="../quotation/quotationList.php">Quotation List</a></li>
                        <li class="<?= is_active(['addquotation.php']) ?>"><a href="../quotation/addquotation.php">Add Quotation</a></li>
                    </ul>
                </li>
                
                <!-- Inventory -->
                <li class="submenu <?= is_active(['transferlist.php', 'suplierreturn.php', 'customerreturn.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/transfer1.svg" alt="img" /><span> Inventory</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['transferlist.php']) ?>"><a href="../inventory/transferlist.php">Transfer List</a></li>
                        <li class="<?= is_active(['suplierreturn.php']) ?>"><a href="../inventory/suplierreturn.php">Supplier Return</a></li>
                        <li class="<?= is_active(['customerreturn.php']) ?>"><a href="../inventory/customerreturn.php">Customer Return</a></li>
                    </ul>
                </li>
                
                <!-- People -->
                <li class="submenu <?= is_active(['customerlist.php', 'addcustomer.php', 'supplierlist.php', 'addsupplier.php', 'userlist.php', 'adduser.php', 'storelist.php', 'addstore.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/users1.svg" alt="img" /><span> People</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['customerlist.php']) ?>"><a href="../people/customerlist.php">Customer List</a></li>
                        <li class="<?= is_active(['addcustomer.php']) ?>"><a href="../people/addcustomer.php">Add Customer</a></li>
                        <li class="<?= is_active(['supplierlist.php']) ?>"><a href="../people/supplierlist.php">Supplier List</a></li>
                        <li class="<?= is_active(['addsupplier.php']) ?>"><a href="../people/addsupplier.php">Add Supplier</a></li>
                        <li class="<?= is_active(['userlist.php']) ?>"><a href="../people/userlist.php">User List</a></li>
                        <li class="<?= is_active(['adduser.php']) ?>"><a href="../people/adduser.php">Add User</a></li>
                        <li class="<?= is_active(['storelist.php']) ?>"><a href="../people/storelist.php">Store List</a></li>
                        <li class="<?= is_active(['addstore.php']) ?>"><a href="../people/addstore.php">Add Store</a></li>
                    </ul>
                </li>
                
                <!-- Places -->
                <li class="submenu <?= is_active(['newcountry.php', 'countrieslist.php', 'newstate.php', 'statelist.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/places.svg" alt="img" /><span> Places</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['newcountry.php']) ?>"><a href="../places/newcountry.php">New Country</a></li>
                        <li class="<?= is_active(['countrieslist.php']) ?>"><a href="../places/countrieslist.php">Countries list</a></li>
                        <li class="<?= is_active(['newstate.php']) ?>"><a href="../places/newstate.php">New State</a></li>
                        <li class="<?= is_active(['statelist.php']) ?>"><a href="../places/statelist.php">State list</a></li>
                    </ul>
                </li>
                
                <!-- Components -->
                <li class="<?= is_active(['components.php']) ?>">
                    <a href="../components.php"><i data-feather="layers"></i><span> Components</span> </a>
                </li>
                
                <!-- Blank Page -->
                <li class="<?= is_active(['blankpage.php']) ?>">
                    <a href="../blankpage.php"><i data-feather="file"></i><span> Blank Page</span> </a>
                </li>
                
                <!-- Error Pages -->
                <li class="submenu <?= is_active(['error-404.php', 'error-500.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="alert-octagon"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['error-404.php']) ?>"><a href="../error-404.php">404 Error </a></li>
                        <li class="<?= is_active(['error-500.php']) ?>"><a href="../error-500.php">500 Error </a></li>
                    </ul>
                </li>
                
                <!-- Elements -->
                <li class="submenu <?= is_active(['sweetalerts.php', 'tooltip.php', 'popover.php', 'ribbon.php', 'clipboard.php', 'drag-drop.php', 'rangeslider.php', 'rating.php', 'toastr.php', 'text-editor.php', 'counter.php', 'scrollbar.php', 'spinner.php', 'notification.php', 'lightbox.php', 'stickynote.php', 'timeline.php', 'form-wizard.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="box"></i> <span>Elements </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['sweetalerts.php']) ?>"><a href="../sweetalerts.php">Sweet Alerts</a></li>
                        <li class="<?= is_active(['tooltip.php']) ?>"><a href="../tooltip.php">Tooltip</a></li>
                        <li class="<?= is_active(['popover.php']) ?>"><a href="../popover.php">Popover</a></li>
                        <li class="<?= is_active(['ribbon.php']) ?>"><a href="../ribbon.php">Ribbon</a></li>
                        <li class="<?= is_active(['clipboard.php']) ?>"><a href="../clipboard.php">Clipboard</a></li>
                        <li class="<?= is_active(['drag-drop.php']) ?>"><a href="../drag-drop.php">Drag & Drop</a></li>
                        <li class="<?= is_active(['rangeslider.php']) ?>"><a href="../rangeslider.php">Range Slider</a></li>
                        <li class="<?= is_active(['rating.php']) ?>"><a href="../rating.php">Rating</a></li>
                        <li class="<?= is_active(['toastr.php']) ?>"><a href="../toastr.php">Toastr</a></li>
                        <li class="<?= is_active(['text-editor.php']) ?>"><a href="../text-editor.php">Text Editor</a></li>
                        <li class="<?= is_active(['counter.php']) ?>"><a href="../counter.php">Counter</a></li>
                        <li class="<?= is_active(['scrollbar.php']) ?>"><a href="../scrollbar.php">Scrollbar</a></li>
                        <li class="<?= is_active(['spinner.php']) ?>"><a href="../spinner.php">Spinner</a></li>
                        <li class="<?= is_active(['notification.php']) ?>"><a href="../notification.php">Notification</a></li>
                        <li class="<?= is_active(['lightbox.php']) ?>"><a href="../lightbox.php">Lightbox</a></li>
                        <li class="<?= is_active(['stickynote.php']) ?>"><a href="../stickynote.php">Sticky Note</a></li>
                        <li class="<?= is_active(['timeline.php']) ?>"><a href="../timeline.php">Timeline</a></li>
                        <li class="<?= is_active(['form-wizard.php']) ?>"><a href="../form-wizard.php">Form Wizard</a></li>
                    </ul>
                </li>
                
                <!-- Charts -->
                <li class="submenu <?= is_active(['chart-apex.php', 'chart-js.php', 'chart-morris.php', 'chart-flot.php', 'chart-peity.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="bar-chart-2"></i> <span> Charts </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['chart-apex.php']) ?>"><a href="../chart-apex.php">Apex Charts</a></li>
                        <li class="<?= is_active(['chart-js.php']) ?>"><a href="../chart-js.php">Chart Js</a></li>
                        <li class="<?= is_active(['chart-morris.php']) ?>"><a href="../chart-morris.php">Morris Charts</a></li>
                        <li class="<?= is_active(['chart-flot.php']) ?>"><a href="../chart-flot.php">Flot Charts</a></li>
                        <li class="<?= is_active(['chart-peity.php']) ?>"><a href="../chart-peity.php">Peity Charts</a></li>
                    </ul>
                </li>
                
                <!-- Icons -->
                <li class="submenu <?= is_active(['icon-fontawesome.php', 'icon-feather.php', 'icon-ionic.php', 'icon-material.php', 'icon-pe7.php', 'icon-simpleline.php', 'icon-themify.php', 'icon-weather.php', 'icon-typicon.php', 'icon-flag.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="award"></i><span> Icons </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['icon-fontawesome.php']) ?>"><a href="../icon-fontawesome.php">Fontawesome Icons</a></li>
                        <li class="<?= is_active(['icon-feather.php']) ?>"><a href="../icon-feather.php">Feather Icons</a></li>
                        <li class="<?= is_active(['icon-ionic.php']) ?>"><a href="../icon-ionic.php">Ionic Icons</a></li>
                        <li class="<?= is_active(['icon-material.php']) ?>"><a href="../icon-material.php">Material Icons</a></li>
                        <li class="<?= is_active(['icon-pe7.php']) ?>"><a href="../icon-pe7.php">Pe7 Icons</a></li>
                        <li class="<?= is_active(['icon-simpleline.php']) ?>"><a href="../icon-simpleline.php">Simpleline Icons</a></li>
                        <li class="<?= is_active(['icon-themify.php']) ?>"><a href="../icon-themify.php">Themify Icons</a></li>
                        <li class="<?= is_active(['icon-weather.php']) ?>"><a href="../icon-weather.php">Weather Icons</a></li>
                        <li class="<?= is_active(['icon-typicon.php']) ?>"><a href="../icon-typicon.php">Typicon Icons</a></li>
                        <li class="<?= is_active(['icon-flag.php']) ?>"><a href="../icon-flag.php">Flag Icons</a></li>
                    </ul>
                </li>
                
                <!-- Forms -->
                <li class="submenu <?= is_active(['form-basic-inputs.php', 'form-input-groups.php', 'form-horizontal.php', 'form-vertical.php', 'form-mask.php', 'form-validation.php', 'form-select2.php', 'form-fileupload.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['form-basic-inputs.php']) ?>"><a href="../form-basic-inputs.php">Basic Inputs </a></li>
                        <li class="<?= is_active(['form-input-groups.php']) ?>"><a href="../form-input-groups.php">Input Groups </a></li>
                        <li class="<?= is_active(['form-horizontal.php']) ?>"><a href="../form-horizontal.php">Horizontal Form </a></li>
                        <li class="<?= is_active(['form-vertical.php']) ?>"><a href="../form-vertical.php"> Vertical Form </a></li>
                        <li class="<?= is_active(['form-mask.php']) ?>"><a href="../form-mask.php">Form Mask </a></li>
                        <li class="<?= is_active(['form-validation.php']) ?>"><a href="../form-validation.php">Form Validation </a></li>
                        <li class="<?= is_active(['form-select2.php']) ?>"><a href="../form-select2.php">Form Select2 </a></li>
                        <li class="<?= is_active(['form-fileupload.php']) ?>"><a href="../form-fileupload.php">File Upload </a></li>
                    </ul>
                </li>
                
                <!-- Table -->
                <li class="submenu <?= is_active(['tables-basic.php', 'data-tables.php']) ?>">
                    <a href="javascript:void(0);"><i data-feather="layout"></i> <span> Table </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['tables-basic.php']) ?>"><a href="../tables-basic.php">Basic Tables </a></li>
                        <li class="<?= is_active(['data-tables.php']) ?>"><a href="../data-tables.php">Data Table </a></li>
                    </ul>
                </li>
                
                <!-- Application -->
                <li class="submenu <?= is_active(['chat.php', 'calendar.php', 'email.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/product.svg" alt="img" /><span> Application</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['chat.php']) ?>"><a href="../chat.php">Chat</a></li>
                        <li class="<?= is_active(['calendar.php']) ?>"><a href="../calendar.php">Calendar</a></li>
                        <li class="<?= is_active(['email.php']) ?>"><a href="../email.php">Email</a></li>
                    </ul>
                </li>
                
                <!-- Report -->
                <li class="submenu <?= is_active(['purchaseorderreport.php', 'inventoryreport.php', 'salesreport.php', 'invoicereport.php', 'purchasereport.php', 'supplierreport.php', 'customerreport.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/time.svg" alt="img" /><span> Report</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['purchaseorderreport.php']) ?>"><a href="../purchaseorderreport.php">Purchase order report</a></li>
                        <li class="<?= is_active(['inventoryreport.php']) ?>"><a href="../inventoryreport.php">Inventory Report</a></li>
                        <li class="<?= is_active(['salesreport.php']) ?>"><a href="../salesreport.php">Sales Report</a></li>
                        <li class="<?= is_active(['invoicereport.php']) ?>"><a href="../invoicereport.php">Invoice Report</a></li>
                        <li class="<?= is_active(['purchasereport.php']) ?>"><a href="../purchasereport.php">Purchase Report</a></li>
                        <li class="<?= is_active(['supplierreport.php']) ?>"><a href="../supplierreport.php">Supplier Report</a></li>
                        <li class="<?= is_active(['customerreport.php']) ?>"><a href="../customerreport.php">Customer Report</a></li>
                    </ul>
                </li>
                
                <!-- Users -->
                <li class="submenu <?= is_active(['newuser.php', 'userlists.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/users1.svg" alt="img" /><span> Users</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['newuser.php']) ?>"><a href="../newuser.php">New User </a></li>
                        <li class="<?= is_active(['userlists.php']) ?>"><a href="../userlists.php">Users List</a></li>
                    </ul>
                </li>
                
                <!-- Settings -->
                <li class="submenu <?= is_active(['generalsettings.php', 'emailsettings.php', 'paymentsettings.php', 'currencysettings.php', 'grouppermissions.php', 'taxrates.php']) ?>">
                    <a href="javascript:void(0);"><img src="../assets/img/icons/settings.svg" alt="img" /><span> Settings</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li class="<?= is_active(['generalsettings.php']) ?>"><a href="../generalsettings.php">General Settings</a></li>
                        <li class="<?= is_active(['emailsettings.php']) ?>"><a href="../emailsettings.php">Email Settings</a></li>
                        <li class="<?= is_active(['paymentsettings.php']) ?>"><a href="../paymentsettings.php">Payment Settings</a></li>
                        <li class="<?= is_active(['currencysettings.php']) ?>"><a href="../currencysettings.php">Currency Settings</a></li>
                        <li class="<?= is_active(['grouppermissions.php']) ?>"><a href="../grouppermissions.php">Group Permissions</a></li>
                        <li class="<?= is_active(['taxrates.php']) ?>"><a href="../taxrates.php">Tax Rates</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>