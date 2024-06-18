<?php
  include_once 'login_crud.php';
?>

<!DOCTYPE html>    
<html>    
<head>    
    <title>Meat Factory : Login</title>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <link href="css/login.css" rel="stylesheet">
</head>  
<body>    
<div class="container" id="container">

    <div class="form-container login-in-container">

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            <img id="currentPhoto" src="logo_mypt3.PNG" onerror="this.onerror=null; this.src='default.PNG'" style="height: 150px;"> 
            
            <?php 
            if (isset($_SESSION['error'])){
              echo "<script>Swal.fire({title:\"Error\",html:\"".$_SESSION['error']."\",confirmButtonText: \"Got it\",});</script>";
                    unset($_SESSION['error']);
                  }
             ?>

            <h1>Meat Factory</h1> 
            <h2>Login Page</h2>

            <input type="email" name="inputEmail" placeholder="Email" />
            <input type="password" name="inputPass" placeholder="Password" />
              
            <button type="submit" name="login" id="login" value="Login" class="buttons">Login</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right" style="background-color: #FF6347" >
                <h3>Hello, Visitors!</h3>
                <p>Refer hint to login this system!</p>
                <button class="ghost" id="hint" onclick="return hint();">Hint</button>
            </div>
        </div>
    </div>
</div>  
 
<script type="text/javascript">

    function hint(){
        Swal.fire({
          title: "<strong>Hint</strong>", 
          html: "<h1>Staff</h1><hr>payton.hobart@meatfactory.com<br>paytonhobart<br><h1> Supervisor</h1><hr>astrid.hudson@meatfactory.com<br>astridhudson<br><h1>Admin</h1><hr>ariana.grande@meatfactory.com<br>arianagrande<br>",
          confirmButtonText: "Got it", 
        });
    }
</script>   
</html> 