<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="public/images/favicon.ico" type="image/ico" />

    <title>Aquatic Cluster</title>

    <link href="public/template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="public/template/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="public/template/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="public/template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="public/template/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="public/template/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="public/template/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="public/template/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="public/template/build/css/custom.css" rel="stylesheet">
    <link href="public/vendors/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="public/template/production/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                  </li>
                  <li><a><i class="fa fa-table"></i> Excel <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/import_data') }}">Import</a></li>
                      <li><a href="tables_dynamic.html">Export</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Dashboard
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12">
                <select id="selectpicker" multiple data-actions-box="true"></select>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <select id="selectmonth" multiple data-actions-box="true">
                  <option value="jan" selected>Januari</option>
                  <option value="feb" selected>Februari</option>
                  <option value="mar" selected>Maret</option>
                  <option value="apr" selected>April</option>
                  <option value="mei" selected>Mei</option>
                  <option value="juni" selected>Juni</option>
                  <option value="jul" selected>Juli</option>
                  <option value="agust" selected>Agustus</option>
                  <option value="sep" selected>September</option>
                  <option value="okt" selected>Oktober</option>
                  <option value="nov" selected>November</option>
                  <option value="des" selected>Desember</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <select id="selectstatus" multiple data-actions-box="true">
                  <option value="sudah" selected>Sudah Bayar</option>
                  <option value="belum" selected>Belum Bayar</option>
                </select>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>By Status</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="iuranChart" style="height:350px;"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Iuran Warga</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="tableIuran"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Report PPL</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="tableReport"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Dashboard Aquatic<a href="#"></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="public/template/vendors/jquery/dist/jquery.min.js"></script>
    <script src="public/template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="public/template/vendors/fastclick/lib/fastclick.js"></script>
    <script src="public/template/vendors/nprogress/nprogress.js"></script>
    <script src="public/template/vendors/iCheck/icheck.min.js"></script>
    <script src="public/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="public/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="public/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="public/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="public/template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="public/template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="public/template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="public/template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="public/template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="public/template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="public/template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="public/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="public/template/vendors/jszip/dist/jszip.min.js"></script>
    <script src="public/template/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="public/template/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="public/template/vendors/echarts/dist/echarts.min.js"></script>
    <script src="public/template/vendors/echarts/map/js/world.js"></script>
    <script src="public/template/build/js/custom.js"></script>
    <script src="public/vendors/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="public/vendors/bootstrap-select/dist/js/i18n/defaults-id_ID.min.js"></script>
  </body>
</html>