<?php 
    session_start();
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"] :false;
    $login = isset($_SESSION["login"])?$_SESSION["login"] :false;
    $username = isset($_SESSION["username"])?$_SESSION["username"] :false;

    if(empty($login)){
        header("Location: /binusuniv/login.php");
    }else{
        if($username !== 'admin'){
            header("Location: /binusuniv/login.php");
        }
    }


    require_once("../function/function.php");
    $page = isset($_GET["page"])?$_GET["page"]:false;
    $action = isset($_GET["action"]) ? $_GET["action"]:false;
    $user_id = isset($_GET["id"]) ? $_GET["id"]:false;
    $role_id = isset($_GET["role_id"]) ? $_GET["role_id"]:false;
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Admin</title>
        <link rel="icon" href="../assets/img/binus.png">
        <!-- data tables -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
        <!-- end datatables -->
        <!-- css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
        <!-- end css -->
        <!-- font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <!-- end font -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="easySelect/easySelectStyle.css">
        <style>
            *{
                font-family: 'Roboto', sans-serif;
            }
        </style>

    </head>
    <body class="sb-nav-fixed">
                    <nav style="border-bottom: 2px solid aqua;background-color: #21D4FD;
background-image: linear-gradient(19deg, #21D4FD 0%, #B721FF 100%);
" class="sb-topnav navbar navbar-expand navbar-dark bg-purple">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 text-center" href="index.php"><h3>SmartBe</h3></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    
                </div>
            </form>
            <!-- Navbar-->
            <ul  class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php $gambar = data("SELECT profile FROM user WHERE username = 'admin'");?>
                <?php foreach($gambar as $g):?>
                    <img class="img-fluid rounded-circle" style="width: 30px; height:30px;" src="assets/upload/<?=$g["profile"]?>" alt="#"></a>
                <?php endforeach;?>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav style=" background-color: #FF9A8B;
background-image: linear-gradient(90deg, #FF9A8B 0%, #FF6A88 55%, #FF99AC 100%);

"class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link fw-bold" href="index.php?page=view-dosen">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link fw-bold" href="index.php?page=grafik">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                                Chart
                            </a>
                            <a class="nav-link fw-bold" href="index.php?page=all-activity">
                                <div class="sb-nav-link-icon"><i class="fas fa-snowboarding"></i></div>
                                All Employee Activities
                            </a>
                            <a class="nav-link fw-bold" href="index.php?page=register-dosen">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Employee
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            </div>
                            
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                <?php 
                    if($page){
                            require_once("page/$page.php");
                    }else{
                        include "page/view-dosen.php";
                    }
                 ?>

                <footer style="background-color: #FAACA8;
background-image: linear-gradient(19deg, #FAACA8 0%, #DDD6F3 100%);
;" class="py-4 bg-light mt-5 fixed">
                    <div class="container-fluid px-4 ">
                        <div class="d-flex align-items-center justify-content-between small">
                           <div class="text-muted">Copyright &copy; SI PJJ</div>
                            <div>
                            Official Website
                            &middot;
                            <a href="https://onlinelearning.binus.ac.id/">onlinelearning.binus.ac.id</a>  
                            </div>
                        </div>
                    </div>
                </footer>
                       </main>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="easySelect/easySelect.js"></script>
        <script>
            $("#demo").easySelect({
         // options here
            });
            
            $(document).ready( function () {
                $('.table').DataTable({
                    responsive: true
                });
            } );
    </script>
    </body>
</html>