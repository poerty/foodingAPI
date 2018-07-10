<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Pages - Admin Dashboard UI Kit - Tables</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="pages/css/themes/modern.css?ver=1" rel="stylesheet" type="text/css" />
  </head>
  <body class="fixed-header horizontal-menu horizontal-app-menu ">
    <!-- START PAGE-CONTAINER -->
    <div class="header p-r-0 bg-primary">
      <div class="header-inner header-md-height">
        <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu text-white" data-toggle="horizontal-menu"></a>
        <div class="">
          <div class="brand inline no-border hidden-xs-down">
            <a href="index.html" style="font-size:23px; font-weight:bold; color:white;">Fooding</a>
          </div>
        </div>
        <div class="d-flex align-items-center">
          <!-- START User Info-->
          <div class="dropdown pull-right">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="thumbnail-wrapper d32 circular inline sm-m-r-5">
                <img src="assets/img/profiles/bb.jpg" alt="" width="32" height="32">
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
              <a href="#" class="dropdown-item"><i class="pg-settings_small"></i> Settings</a>
              <a href="#" class="dropdown-item"><i class="pg-outdent"></i> Feedback</a>
              <a href="#" class="dropdown-item"><i class="pg-signals"></i> Help</a>
              <a href="#" class="clearfix bg-master-lighter dropdown-item">
                <span class="pull-left">Logout</span>
                <span class="pull-right"><i class="pg-power"></i></span>
              </a>
            </div>
          </div>
          <!-- END User Info-->
        </div>
      </div>
      <div class="bg-white">
        <div class="container">
          <div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
            <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu">
            </a>
            <ul>
              <li>
                <a href="index.html">Home</a>
              </li>
              <li class=" active">
                <a href="Ingredient.php"><span class="title">Ingredients</span></a>
              </li>
              <li>
                <a href="Recipe.php"><span class="title">Recipes</span></a>
              </li>
              <li>
                <a href="Company.php"><span class="title">Companies</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="page-container ">
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content ">
          <div class="bg-white">
            <div class="container">
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Ingredients</li>
              </ol>
            </div>
          </div>
          <!-- START CONTAINER FLUID -->
          <div class=" no-padding    container-fixed-lg bg-white">
            <div class="container">
              <!-- START card -->
              <div class="card card-transparent">
                <div class="card-header ">
                  <div class="card-title">
                    <h1>원재료 리스트</h1>
                  </div>
                </div>
                <div class="card-block">
                  <div class="table-responsive">
                    <table class="table table-hover" id="basicTable">
                      <thead>
                        <tr>
                          <!-- NOTE * : Inline Style Width For Table Cell is Required as it may differ from user to user
    										Comman Practice Followed
    										-->
                          <th style="width:1%" >
                            <button class="btn btn-link"><i class="pg-trash"></i>
                            </button>
                          </th>
                          <th style="width:24%">Name</th>
                          <th style="width:12%">English</th>
                          <th style="width:4%">Cal</th>
                          <th style="width:4%">Carbo</th>
                          <th style="width:4%">Protein</th>
                          <th style="width:4%">Fat</th>
                          <th style="width:4%">Sugar</th>
                          <th style="width:4%">Na</th>
                          <th style="width:8%">Choles</th>
                          <th style="width:8%">FatAcid</th>
                          <th style="width:8%">TransFat</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        require_once("../config.php");
                        require_once("../db.php");
                        $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

                        $sql = "SELECT * FROM F_Ingredient R LIMIT 1000";
                        
                        //query 에 변수(POST, get 등으로부터 받은 값들) 사용하는 예시
                        //$sql = "DELETE from m_unadmit_students WHERE uid=".$_GET['uid'];
                        $result  = mysqli_query($conn, $sql);
                        $i = 0;
                        while($row=mysqli_fetch_assoc($result)){
                          $i++;
                          echo "
                          <tr>
                          <td class='v-align-middle'>
                            <div class='checkbox text-center'>
                              <input type='checkbox' value='".$i."' id='checkbox".$i."'>
                              <label for='checkbox".$i."' class='no-padding no-margin'></label>
                            </div>
                          </td>
                          <td class='v-align-middle '>
                            <p>".$row['NAME']."</p>
                          </td>
                          <td class='v-align-middle'>
                            <p>".$row['English_NAME']."</p>
                          </td>
                          <td class='v-align-middle'>
                            <p>".$row['Calorie']."</p>
                          </td>
                          <td class='v-align-middle'>
                            <p>".$row['Carbohydrate']."</p>
                          </td>
                          <td class='v-align-middle '>
                            <p>".$row['Protein']."</p>
                          </td>
                          <td class='v-align-middle'>
                            <p>".$row['Fat']."</p>
                          </td>
                          <td class='v-align-middle'>
                            <p>".$row['Sugar']."</p>
                          </td>
                          <td class='v-align-middle'>
                            <p>".$row['Na']."</p>
                          </td>
                          <td class='v-align-middle'>
                            <p>".$row['Cholesterol']."</p>
                          </td>
                          <td class='v-align-middle'>
                            <p>".$row['FattyAcid']."</p>
                          </td>
                          <td class='v-align-middle'>
                            <p>".$row['TransFattyAcid']."</p>
                          </td>
                      </tr>
                      
                          "
                          ;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- END card -->
            </div>
          </div>
          <!-- END CONTAINER FLUID -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->

    <!-- BEGIN VENDOR JS -->
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/tether/js/tether.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="assets/plugins/classie/classie.js"></script>
    <script src="assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="pages/js/pages.min.js"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/js/tables.js" type="text/javascript"></script>
    <script src="assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
  </body>
</html>
