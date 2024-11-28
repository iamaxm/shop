<?php 

session_start();


if($_SESSION["user"]==""){

    Header("Location: ../admin/home_admin.php");

  }



?>