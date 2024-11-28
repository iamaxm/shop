<?php
session_start();
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Login and Register</title>

    <meta name="description" content="" />

   <?php
    include("head.php");
    ?>
  </head>

  <body>
         <!-- Navbar start -->
     <?php ?>
        <!-- Navbar End -->
   <?php
    $favcolor = @$_GET['id'];

    switch ($favcolor) {
      case "login":

        include("login.php");
        break;
      case "register":
        include("register.php");
        break;
      case "shop":
        include("navbar.php");
        include("shop.php");
        break;
      case "shop-detail":
        include("navbar.php");
        include("shop-detail.php");
        break;
      case "cart":
        include("navbar.php");
        include("cart.php");
        break;
      case "checkout":
        include("navbar.php");
        include("checkout.php");
        break;
      case "testimonial":
        include("navbar.php");
        include("testimonial.php");
        break;
      case "404":
        include("navbar.php");
        include("404.php");
        break;
      case "contact":
        include("navbar.php");
        include("contact.php");
        break;
      case "admin":
        include("admin/admin_page.php");
        break;
      case "user":
        include("navbar.php");
        include("show_product.php");
        break;
      case "edit":
        include("edit_user.php");
        break;
      case "shopping_cart":
    
        include("shopping_cart.php");
        break;
      case "show_product":
        include("navbar.php");
        include("show_product.php");
        break;

      default:
        include("navbar.php");
        include("show_product.php");
    }
    ?>
        <?php
        include("script.php");
        ?>

        
  </body>
</html>