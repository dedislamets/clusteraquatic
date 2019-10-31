<!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="images/favicon.ico" type="image/ico" />
	    <title>Dashboard</title>
	    <link href="../public/template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../public/template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	    <link href="../public/template/vendors/nprogress/nprogress.css" rel="stylesheet">
	    <link href="../public/template/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	    <link href="../public/template/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
	    <link href="../public/template/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
	    <link href="../public/template/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	    <link href="../public/template/build/css/custom.min.css" rel="stylesheet">
        <link href="../public/template/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
        <link href="../public/template/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <link href="../public/template/vendors/nprogress/nprogress.css" rel="stylesheet">
        <link href="../public/template/vendors/normalize-css/normalize.css" rel="stylesheet">
        <link href="../public/template/vendors/starrr/dist/starrr.css" rel="stylesheet">
        <link href="../public/template/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <link href="../public/template/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <link href="../public/template/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">

	</head>
    <body class="nav-md">
        <div class="container body">
            <div class="container body">
                <div class="main_container">
                    <div class="col-md-3 left_col">
                        <div class="left_col scroll-view">
                            <div class="navbar nav_title" style="border: 0;">
                                <a class="site_title" href="index.html">
                                    <i class="fa fa-paw">
                                    </i>
                                    <span>
                                        Aquatic Cluster
                                    </span>
                                </a>
                            </div>
                            <br/>
                            <br/>
                            <br/>
                            <div class="main_menu_side hidden-print main_menu" id="sidebar-menu">
                                <div class="menu_section">
                                    <h3>
                                        General
                                    </h3>
                                    <ul class="nav side-menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-home">
                                                </i>
                                                Home
                                                <span class="fa fa-chevron-down">
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top_nav">
                        <div class="nav_menu">
                            <nav>
                                <div class="nav toggle">
                                    <a id="menu_toggle">
                                        <i class="fa fa-bars">
                                        </i>
                                    </a>
                                </div>
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="">
                                        <a aria-expanded="false" class="user-profile dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                                            <!-- <img alt="" src="public/images/img.jpg"> -->
                                                Akun
                                                <span class=" fa fa-angle-down">
                                                </span>
                                            </img>
                                        </a>
                                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                                            <li>
                                                <a href="login.html">
                                                    <i class="fa fa-sign-out pull-right">
                                                    </i>
                                                    Log Out
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="right_col" role="main">
                        <div class="row tile_count">
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                <br>
                                <div class="count">
                                    Dashboard
                                </div>
                                <br>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                                <span class="count_top">
                                    <i class="fa fa-user">
                                    </i>
                                    Total Warga
                                </span>
                                <div class="count" id="total_warga"></div>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-sm-3">
                                    Bulan
                                </div>
                                <div class="col-sm-3">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer>
                        <div class="pull-right">
                            Dashboard Aquatic Cluster
                        </div>
                        <div class="clearfix"></div>
                    </footer>
                </div>
            </div>
        </div>
        @yield('content')
        <script src="../public/template/vendors/jquery/dist/jquery.min.js"></script>
        <script src="../public/template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../public/template/vendors/fastclick/lib/fastclick.js"></script>
        <script src="../public/template/vendors/nprogress/nprogress.js"></script>
        <script src="../public/template/vendors/Chart.js/dist/Chart.min.js"></script>
        <script src="../public/template/vendors/gauge.js/dist/gauge.min.js"></script>
        <script src="../public/template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <script src="../public/template/vendors/iCheck/icheck.min.js"></script>
        <script src="../public/template/vendors/skycons/skycons.js"></script>
        <script src="../public/template/vendors/Flot/jquery.flot.js"></script>
        <script src="../public/template/vendors/Flot/jquery.flot.pie.js"></script>
        <script src="../public/template/vendors/Flot/jquery.flot.time.js"></script>
        <script src="../public/template/vendors/Flot/jquery.flot.stack.js"></script>
        <script src="../public/template/vendors/Flot/jquery.flot.resize.js"></script>
        <script src="../public/template/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="../public/template/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="../public/template/vendors/flot.curvedlines/curvedLines.js"></script>
        <script src="../public/template/vendors/DateJS/build/date.js"></script>
        <script src="../public/template/vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="../public/template/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="../public/template/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <script src="../public/template/vendors/moment/min/moment.min.js"></script>
        <script src="../public/template/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="../public/template/build/js/custom.js"></script>
	    <script src="../public/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	    <script src="../public/template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
	    <script src="../public/template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
	    <script src="../public/template/vendors/jszip/dist/jszip.min.js"></script>
	    <script src="../public/template/vendors/pdfmake/build/pdfmake.min.js"></script>
	    <script src="../public/template/vendors/pdfmake/build/vfs_fonts.js"></script>
        <script src="../public/template/vendors/echarts/dist/echarts.min.js"></script>
        <script src="../public/template/vendors/echarts/map/js/world.js"></script>
        <script src="../public/template/vendors/select2/dist/js/select2.full.min.js"></script>
        <script src="../public/template/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>

    </body>
</html>