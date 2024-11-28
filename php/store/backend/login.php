
<?php 
Header("Location: ../index.php?id=home");
session_start();
        if(isset($_POST['email'])){
				//connection
                include('../db.php');
				//รับค่า user & password
                  $email = $_POST['email'];
                  $password = $_POST['password'];
				//query 
                $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` ='$password'";

                  $result = mysqli_query($conn,$sql);
				
                  if(mysqli_num_rows($result)==1){

                      $row = mysqli_fetch_array($result);

                      $_SESSION["UserID"] = $row["user_id"];
                      $_SESSION["User"] = $row["username"];
                      $_SESSION["status"] = $row["role"];
                     
                      Header("Location: ../index.php?id=home");
                      if($_SESSION["status"]=="admin"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php

                        Header("Location: ../admin/home_admin.php");

                      }

                      else if ($_SESSION["status"]=="user"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        Header("Location: ../index.php?id=user");

                      }else{
                        echo "<script>";
                            echo "alert(\" Username หรือ  Password ไม่ถูกต้อง\");"; 
                            echo "window.history.back()";
                        echo "</script>";
                      }

                  }else{
                    echo "<script>";
                        echo "alert(\" Username หรือ  Password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";

                  }

        }else{
             Header("Location: form_login.php"); //user & password incorrect back to login again
        }
?>