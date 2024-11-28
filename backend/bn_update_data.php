<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php 

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

    include('../db.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION["User"] = $username;

    if (empty($username)) {
        echo "<script>";
        echo "alert(\" กรุณากรอก username \");";
        echo "window.history.back()";
        echo "</script>";
    } else if (empty($password)) {
        echo '<script>
        setTimeout(function() {
            swal({
                title: "เกิดข้อผิดพลาด!", 
                text: "กรุณากรอก password!",
                type: "warning", 
                showConfirmButton: true 
            }, function() {
                window.history.back(); 
            });
        }, 100); 
        </script>';
        
    } else if (strlen($password) < 5) { // เช็คความยาวของรหัสผ่าน
        echo '<script>
        setTimeout(function() {
            swal({
                title: "เกิดข้อผิดพลาด!", 
                text: "รหัสผ่านต้องมีความยาวอย่างน้อย 5 ตัวอักษร",
                type: "warning", 
                showConfirmButton: true 
            }, function() {
                window.history.back(); 
            });
        }, 100); 
        </script>';
    } else if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) { // เช็คว่ามีทั้งตัวอักษรและตัวเลขหรือไม่
        echo '<script>
        setTimeout(function() {
            swal({
                title: "เกิดข้อผิดพลาด!", 
                text: "รหัสผ่านต้องประกอบด้วยตัวอักษรและตัวเลข",
                type: "warning", 
                showConfirmButton: true 
            }, function() {
                window.history.back(); 
            });
        }, 100); 
        </script>';
    } else {
        $check_query = "SELECT * FROM users WHERE username='$username' AND user_id != '".$_SESSION["UserID"]."'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0) {
            echo '<script>
        setTimeout(function() {
            swal({
                title: "เกิดข้อผิดพลาด!", 
                text: "Username '.$username .' มีผู้ใช้งานแล้ว",
                type: "error", 
                showConfirmButton: true 
            }, function() {
                window.location.href = "../index.php?id=edit";
            });
        }, 100); 
        </script>';
        } else {
            $sql = "UPDATE users SET  
            username='$username' ,
            password='$password'
            WHERE user_id='".$_SESSION["UserID"]."' ";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo '<script>
        setTimeout(function() {
            swal({
                title: "ยินดีด้วย :)", 
                text: "แก้ไขสำเร็จ!",
                type: "success", 
                timer: 1500,
                showConfirmButton: false 
            }, function() {
                window.location.href = "../index.php?id=user";
            });
        }, 100); 
        </script>';
               
            } else {
                echo '<script>
        setTimeout(function() {
            swal({
                title: "เสียใจด้วย ;(", 
                text: "แก้ไขไม่สำเร็จ!",
                type: "error", 
                showConfirmButton: true 
            }, function() {
                window.history.back(); 
            });
        }, 100); 
        </script>';
            }
        }
    }
} else {
    echo '<script>
        setTimeout(function() {
            swal({
                title: "เกิดข้อผิดพลาด!", 
                text: "มีค่าว่าง!",
                type: "warning", 
                showConfirmButton: true 
            }, function() {
                window.history.back(); 
            });
        }, 100); 
        </script>';
}
?>
