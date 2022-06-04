<?php 
    session_start();
    setlocale(LC_ALL, 'id-ID', 'id_ID');//set lokasi INDONESIA (id-ID, untuk di windows, id_ID untuk di linux)
    $login = isset($_SESSION["login"])?$_SESSION["login"] :false;
    $username = isset($_SESSION["username"])?$_SESSION["username"] :false;
    $user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"] :false;
    $nama_lengkap = isset($_SESSION["nama_lengkap"])?$_SESSION["nama_lengkap"] :false;
    $level = isset($_SESSION["level"])?$_SESSION["level"] :false;

    if(empty($login)){
        header("Location: /binusuniv/login.php");
    }else{
        if(empty($username) || $username == 'admin'){
            header("Location: /binusuniv/login.php");
        }
    }
    ?>
 <?php
    require_once("../function/function.php"); 
   

    $action = isset($_GET["action"]) ? $_GET["action"]:false;
    $page = isset($_GET["page"])?$_GET["page"]:false;
    $activity_id = isset($_GET["id"])?$_GET["id"]:false; 
    $employee_activity_id = isset($_GET["employee_activity_id"])?$_GET["employee_activity_id"]:false; 
 
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link rel="icon" href="../assets/img/binus.png">
        <!-- data tables -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
        <!-- end datatables -->
        <!-- css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
        <!-- end css -->
         <!-- font -->
         <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <!-- end font -->
        <!-- tip -->
         <!-- Development -->
         <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
        <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
        <!-- end tip -->
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
                    <nav style="background-color: #74EBD5;
background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);
"class="sb-topnav navbar navbar-expand navbar-dark bg-light">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 text-center" href="index.php"><h3>SmartBe</h3></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php $gambar = data("SELECT profile FROM user WHERE user_id = '$user_id'");?>
                <?php foreach($gambar as $g):?>
                    <img class="img-fluid rounded-circle" style="width: 30px; height:30px;" src="../admin/assets/upload/<?=$g["profile"]?>" alt="#"></a>
                <?php endforeach;?>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav style="background-color: #21D4FD;
background-image: linear-gradient(19deg, #21D4FD 0%, #d378ff 100%);

" class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link fw-bold" href="index.php?page=dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed fw-bold" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Activity
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link fw-bold" href="index.php?page=employee-activity">Create New Activity</a>
                                    
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <!-- <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Report
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    </div>
                                </nav>
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
                    include "page/dashboard.php";
                }
                ?>
                <footer style="" class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
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
        <!-- Tip -->
       
        <!-- Production -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <!-- Tip -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="easySelect/easySelect.js"></script>
        <script>
      
tippy('#myButton', {
    content: ' Data yang masing kosong <br> <?php foreach($employee_now as $ea):?>
                    <?= $status = empty($ea['status']) ? 'Status : - <br>' : null ; ?>
                    <?= $place = empty($ea['place']) ? 'Place : - <br>' : null ; ?>
                    <?= $berkelanjutan = empty($ea['dari_tanggal'] || $ea['sampai_tanggal']) ? 'Berkelanjutan : - <br>' : null ; ?>
                    <?= $documentation = empty($ea['documentation']) ? 'Documentation : - <br>' : null ; ?>
                    <?= $note = empty($ea['note']) ? 'Note : - <br>' : null ; ?>
            <?php endforeach; ?>',
            placement:'top-start',
            allowHTML: true
        });
            $(document).ready( function () {
                $('.table').DataTable({
                    responsive: true
                });
            } );
        </script>
    </body>
</html>