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
    <link href="public/template/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="public/template/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="public/template/vendors/normalize-css/normalize.css" rel="stylesheet">
    <link href="public/template/vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="public/template/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="public/template/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="public/template/vendors/cropper/dist/cropper.min.css" rel="stylesheet">
    <link href="public/template/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <link href="public/template/build/css/custom.min.css" rel="stylesheet">
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
                  <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-table"></i> Excel <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('/import_data') }}">Import</a></li>
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 style="display: block;width: 100%;">
                      <div style="float: left;padding-top: 7px">Upload</div>
                      
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- <div class="dropzone" id="drop1">
                        <div class="dz-message">
                            <h3> Click or Drop Excel Here</h3>
                        </div>
                    </div> -->
                    <form action="{{ url('api/import') }}" method="POST" class="dropzone">
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <select id="jenis" name="jenis" class="form-control" style="width: 100%">
                          <option value="iuran">Iuran Warga</option>
                          <option value="ppl">PPL</option>
                        </select>
                      </div>
                    </form>
                    <br />
                    <br />
                    <br />
                    <br />
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

    <script src="public/template/vendors/jquery/dist/jquery.min.js"></script>
    <script src="public/template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="public/template/vendors/fastclick/lib/fastclick.js"></script>
    <script src="public/template/vendors/nprogress/nprogress.js"></script>
    <script src="public/template/vendors/moment/min/moment.min.js"></script>
    <script src="public/template/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="public/template/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="public/template/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <script src="public/template/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="public/template/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="public/template/vendors/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="public/template/vendors/cropper/dist/cropper.min.js"></script>
    <script src="public/template/vendors/dropzone/dist/min/dropzone.min.js"></script>
    <script src="public/template/build/js/custom.js"></script>
    
    <!-- Initialize datetimepicker -->
<script>
    $('#myDatepicker').datetimepicker();
    
    $('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
    
    $('#myDatepicker3').datetimepicker({
        format: 'hh:mm A'
    });
    
    $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });

    $('#datetimepicker6').datetimepicker();
    
    $('#datetimepicker7').datetimepicker({
        useCurrent: false
    });
    
    $("#datetimepicker6").on("dp.change", function(e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    
    $("#datetimepicker7").on("dp.change", function(e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });

    // Dropzone.autoDiscover = false;
    // var excel_upload= new Dropzone("#drop1",{
    //     url: "api/import",
    //     maxFilesize: 10,
    //     method:"post",
    //     acceptedFiles: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel',
    //     paramName:"userfile",
    //     dictInvalidFileType:"Type file ini tidak dizinkan",
    //     addRemoveLinks:true,
    //     autoProcessQueue:true,
    //     //params: {jenis: $("#jenis").val() },                    
    //     init: function() {  
    //         var thisDropzone = this; 
    //     }    
    // });

    // excel_upload.on("sending",function(a,b,c){         
    //     c.append("jenis", $("#jenis").val()); 
    // });

    
</script>
  </body>
</html>
