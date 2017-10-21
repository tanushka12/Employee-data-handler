<?php
include_once("common.php");
if(isset($_SESSION['cpf']) && isset($_SESSION['name'])){
    header("location:home.php");
}
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-1.12.3.min.js"> </script>
    <script src="js/bootstrap.min.js"> </script>
    <script src="js/verify.notify.min.js"> </script>
    <title> CUBE - Goa </title>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"> CUBE </a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#signup-modal" data-target="#signup-modal" data-toggle="modal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </nav>

    <center>
        <br /><br /><br /><br /> <img src="images/cube.png" height="200" width="200" class="img-thumbnail">
        <br /><br />
        <h2> Employee Assistant - CUBE</h2>
        <br /><br />
        <div class="container-fluid">
            <form role="form" style="width: 30%" action="account.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Id No.">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <input type="hidden" id="action" name="action" value="login" />
                <input type="submit" class="btn btn-default" value="Login"/>
            </form>
        </div>
    </center>

    <div id="signup-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> <h3 class="modal-title">CUBE Signup</h3> </center>
                </div>
                <div class="modal-body">
                    <form role="form" action="account.php" method="post">
                        <div class="form-group">
                            <label> First Name </label>
                            <input type="text" class="form-control" id="first_name" name="first_name">
                        </div>
                        <div class="form-group">
                            <label> Last Name </label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group">
                            <label> ID No. </label>
                            <input type="text" class="form-control" id="cpf" name="cpf">
                        </div>
                        <input type="hidden" id="action" name="action" value="signup" />
                        <center> <input type="submit" class="btn btn-default" value="Signup" /> </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(isset($_SESSION['status']) && isset($_SESSION['msg'])){
            $status = $_SESSION['status'];
            $msg = $_SESSION['msg'];
            echo "<script> $.notify('$msg', { className: '$status', globalPosition: 'right middle', autoHideDelay: 7000 }); </script>";
            unset($_SESSION['status']);
            unset($_SESSION['msg']);
        }
    ?>

</body>
</html>