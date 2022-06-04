<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <!--Stylesheet-->
    <link rel="stylesheet" href="assets/plug/style.css">
    <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
</head>
<style>
    
.preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background-color: #fff;
}
.preloader .loading {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
  font: 14px arial;
}
        
    </style>
    
<body>
    <div class="container">
  
         <div class="preloader">
  <div class="loading">
    <img src="assets/img/loading.gif" width="80px">
    <p>Harap Tunggu</p>
  </div>
</div>
 
         <img src="assets/img/logo.png">
        <div class="image-container">
            <img src="assets/img/image1.jpg" id="content1" class="active">
            <img src="assets/img/image2.jpg" id="content2">
            <img src="assets/img/image3.jpg" id="content3">
            <img src="assets/img/image4.jpg" id="content4">
        </div>
        <div class="dot-container">
            <button onclick = "dot(1)"></button>
            <button onclick = "dot(2)"></button>
            <button onclick = "dot(3)"></button>
            <button onclick = "dot(4)"></button>
        </div>
        <button id="prev" onclick="prev()"> &lt; </button>
        <button id="next" onclick="next()"> &gt; </button>
          <div class="button">
             <br>
        <center><a style="background:white; color:purple; padding:10px; text-decoration:none; margin:50px; margin-top:100px;" class="login" href="login.php">Login - E-Activity Employee (Binus Online Learning)</a></center>
              
              
    </div>
    </div>
    <script src="assets/plug/script.js"></script>
    <script>
    
        $(document).ready(function(){
        $(".preloader").fadeOut();
        })

    </script>
 
</body>
</html>