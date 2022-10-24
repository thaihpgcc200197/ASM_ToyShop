<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/icon-web.png">
    <title>children's toy world</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Tao menu cap -->
    <link href="csseshop/font-awesome.min.css" rel="stylesheet">
    <link href="csseshop/prettyPhoto.css" rel="stylesheet">
    <link href="csseshop/price-range.css" rel="stylesheet">
    <link href="csseshop/animate.css" rel="stylesheet">
    <link href="csseshop/main.css" rel="stylesheet">
    <link href="csseshop/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="css/salomon.css" rel="stylesheet">

    <!--datatable-->
    <script src="js/jquery-3.2.0.min.js"/></script>
    <script src="js/jquery.dataTables.min.js"/></script>
    <script src="js/dataTables.bootstrap.min.js"/></script>
    <style>
        a{
            color: whitesmoke!important;
        }
    </style>
</head>
<body>

<?php
if(session_id() == '') {
    session_start();
}
include_once("connection.php");
if(isset($_GET['page']))
{
    $page = $_GET['page'];
} else{
    $page = 'home';
}
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="height: 5rem;position: fixed;width: 100%;z-index: 100;background-color: rgb(2, 95, 148)!important">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img style="width: 4rem" src="./images/logo-nav.png" alt="Bootstrap" width="30" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="" id="navbarNavDropdown" style="">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php if($page == 'home' || $page == 'view_detail_product' || $page == 'login' || $page == 'register') {?>animate-character<?php } ?>" href="index.php">Home</a>
                </li>
                <?php
                    if(isset($_SESSION["role"]) && $_SESSION["role"] == '1'){
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php if($page == 'category_management' || $page == 'add_category' || $page == 'update_category') {?>animate-character <?php } ?>" href="?page=category_management">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($page == 'supplier_management' || $page == 'add_supplier' || $page == 'update_supplier') {?>animate-character <?php } ?>" href="?page=supplier_management">Supplier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($page == 'product_management' || $page == 'update_product' || $page == 'add_product') {?>animate-character <?php } ?>"  href="?page=product_management">Product</a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="action-user">
            <?php
            if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item" style="color: #FFFFFF">
                            <i class="fa fa-user"></i>Welcome <?php echo $_SESSION['us'] ?>
                    </li class="nav-item">
                    <li>
                        <a href="?page=logout" style="margin-left: 3rem;;color:#FFF">
                            <i class="fa fa-crosshairs"></i>Logout
                        </a>
                    </li>
                </ul>
                <?php
            }
            else
            {
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="?page=login" style="color:#FFF">
                            <i class="fa fa-lock"></i>Login</a></li>
                    <li class="nav-item"><a href="?page=register" style="margin-left: 3rem;;color:#FFF">
                            <i class="fa fa-star"></i>Register</a></li>
                </ul>
                <?php
            }
            ?>
        </div>
    </div>
</nav>
<div style="padding-top: 4.7rem;min-height: 60rem;">
    <?php
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
        if($page=="register"){
            include_once("Register.php");
        }
        elseif($page=="login"){
            include_once("Login.php");
        }
        elseif($page=="category_management"){
            include_once("Category_Management.php");
        }
        elseif($page=="add_category"){
            include_once("Add_Category.php");
        }
        elseif($page=="update_category"){
            include_once("Update_Category.php");
        }
        elseif($page=="supplier_management"){
            include_once("Supplier_Management.php");
        }
        elseif($page=="add_supplier"){
            include_once("Add_Supplier.php");
        }
        elseif($page=="update_supplier"){
            include_once("Update_Supplier.php");
        }
        elseif($page=="product_management"){
            include_once("Product_Management.php");
        }
        elseif($page=="logout"){
            include_once("Logout.php");
        }
        elseif($page=="update_customer"){
            include_once("Update_customer.php");
        }
        elseif($page=="add_product"){
            include_once("Add_Product.php");
        }
        elseif($page=="update_product"){
            include_once("Update_Product.php");
        } elseif($page=="view_detail_product"){
            include_once("ViewDetailPro.php");
        }
    }
    else{
        include("Content.php");
    }
    ?>
</div>
<div class="footer-bottom-area" style="background-color: rgb(2, 95, 148)!important">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>©2022 Walmart. All Rights Reserved. ATN</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->

<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- jQuery sticky menu -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.sticky.js"></script>

<!-- jQuery easing -->
<script src="js/jquery.easing.1.3.min.js"></script>

<!-- Main Script -->
<script src="js/main.js"></script>

<!-- Slider -->
<script type="text/javascript" src="js/bxslider.min.js"></script>
<script type="text/javascript" src="js/script.slider.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--data table-->
<script src="js/jquery.dataTables.min.js"/></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/dataTables.bootstrap.min.js"/></script>

</body>
</html>