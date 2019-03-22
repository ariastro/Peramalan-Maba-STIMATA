<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: login/error.php");    
}
else {

    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
}
?>

<?php
ob_start();
require_once('config/+koneksi.php');
require_once('models/database.php');

$connection = new Database($host, $user, $pass, $database);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>STIMATA</title>

    <link rel="stylesheet" href="dataTables/datatables.min.css">

    <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.12.1custom/jquery-ui.css">

    <!-- Bootstrap Core CSS -->
    <link href="hoome/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="hoome/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="hoome/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="hoome/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" type="image/png" href="img/bemm.png"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color: #337ab7;" href=""><strong>STIMATA</strong></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Admin</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="?page=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-users"></i> Mahasiswa<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?page=data_mahasiswa"><i class="fa fa-address-card-o"></i> Data Jumlah Mahasiswa Baru</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

            <?php
                if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
                    include 'views/dashboard.php';
                }elseif (@$_GET['page'] == 'data_mahasiswa') {
                    include 'views/data_mahasiswa.php';
                }elseif (@$_GET['page'] == 'project' ) {
                    include 'views/project.php';
                }elseif (@$_GET['page'] == 'galeri') {
                    include 'views/galeri.php';
                }elseif (@$_GET['page'] == 'event') {
                    include 'views/event.php';
                }
            ?>
           
        </div><!-- /.page-wrapper -->

    <!-- jQuery -->
    <script src="hoome/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.12.1custom/jquery-ui.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="hoome/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="hoome/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="hoome/dist/js/sb-admin-2.js"></script>

    <script src="dataTables/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#datatables').DataTable();
        });
    </script>

</body>

</html>
