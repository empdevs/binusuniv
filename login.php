<?php session_start();?>
<?php 
//   $level = isset($_SESSION["level"])?$_SESSION["level"] :false;
  $login = isset($_SESSION["login"])?$_SESSION["login"] :false;
  $username = isset($_SESSION["username"])?$_SESSION["username"] :false;
  $alert = isset($_GET["alert"])?$_GET["alert"] : false; 

    if(!empty($login)){
        if($username == "admin"){
            header("Location: admin/index.php");
            exit;
        }else{
            header("Location: employee/index.php");
            exit;
        }
    }
?>
<?php require_once("function/function.php");?>

<?php
if(isset($_POST["login"])){
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    
    $data = data("SELECT * FROM user WHERE username = '$username'");

    if(!empty($data)){
        foreach($data as $d){
            $d["user_id"];
            $d["password"];
            $d["username"];
            $d["nama_lengkap"];
        }
            if(password_verify($password,$d["password"])){
                $_SESSION["username"] = $d["username"];//validasi untuk admin
                $_SESSION["user_id"] = $d["user_id"];
                $_SESSION["nama_lengkap"] = $d["nama_lengkap"];
                $_SESSION["login"] = true;
                    if($_SESSION["username"] == "admin"){
                        header("Location: admin/index.php");
                        exit;
                    }else{
                        header("Location: employee/index.php");
                        exit;
                    }
            }else{
                $alert = $_GET["alert"] = "error";
            }
    }else{
            $alert = $_GET["alert"] = "error";
    }
}
   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>LOGIN BINUS E-ACTIVITY</title>
        <link rel="icon" href="assets/img/binus.png">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
<style>
    
    
    body{
        background-image: url(assets/img/bg.jpeg) ;
        background-size: cover;
        min-height:auto ;
        backdrop-filter: blur(15px);
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>
    <body  class="bg-primary">
        <div id="layoutAuthentication">
  
            <div id="layoutAuthentication_content" class="my-2">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header bg-light"><h3 class="text-center font-weight-light my-4"><img class="img-fluid" src="assets/img/logo.png" style="margin:10px; width:50%;"></h3></div>
                                    <div class="card-body">
                                    <?php if($alert == "error"):?>
                                    <div class="alert alert-danger" role="alert">
                                        Username atau password salah !
                                    </div>
                                    <?php endif;?>
                                        <form action="" method="POST">
                                        
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" type="text" name="username" placeholder="Username"/>
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password"/>
                                            <label for="password">Password</label>
                                        </div>
                                            <div class="d-flex align-items-center justify-content-between ">
                                      
                                                <button type="submit"  class="btn btn-primary" style="width:100%;" name="login">Login</button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    
                                </div><br>
                                <a href="index.php"><button type="submit" style="width:100%; border:none; color:white; background:none;" name="home">Back To Home</button></a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
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
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
