<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php

@session_start();
include('../db.php');

$user_sql = "SELECT * FROM `users` WHERE role = 'user'";
$result = $conn->query($user_sql);

$all_member = 0;
$No = 1;

?>
<div class="container" style="margin : 2rem 0rem;">
    <div class="card">
        <center>
            <h2 class="card-header">รายชื่อสมาชิกทั้งหมด</h2>
        </center>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>user_id</th>
                        <th>username</th>
                        <th>email</th>
                        <th>role</th>
                        <?php if (isset($_SESSION['User']) && $_SESSION['status'] == 'superadmin') { ?>
                            <th>
                                <center>delete</center>
                            </th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php while ($row = $result->fetch_assoc()) : ?>

                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php echo number_format($No); ?></strong></td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php echo $row['user_id']; ?></strong></td>
                            <td><strong class="fab fa-angular fa-lg me-3"><?php echo $row['username']; ?></strong></td>
                            <td><strong class="fab fa-angular fa-lg me-3"><?php echo $row['email']; ?></strong></td>
                            <td class="<?php echo ($row['role'] == 'admin') ? 'text-info' : (($row['role'] == 'superadmin') ? 'text-danger' : 'text-dark'); ?>">
                                <strong class="fab fa-angular fa-lg me-3"><?php echo $row['role']; ?></strong>
                            </td>
                            <?php if (isset($_SESSION['User']) && $_SESSION['status'] == 'superadmin') { ?>
                                <td>
                                    <button type="button" class="btn align-items-center dropdown-item delete-user" data-bs-toggle="modal" data-bs-toggle="dropdown" data-bs-target="#exampleModal" data-user-id="<?php echo $row['user_id']; ?>">
                                        <center><svg xmlns="http://www.w3.org/2000/svg" color="#697a8d" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                            </svg></center>
                                    </button>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php $No += 1; ?>
                        <?php $all_member += 1; ?>
                    <?php endwhile ?>


                </tbody>
                <h4 style="margin-left: 1rem;"><span class="badge rounded-pill bg-info">รวมสมาชิกทั้งหมด <?php echo number_format($all_member); ?> คน</span></h4><br>

            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".delete-user").click(function() {
            Swal.fire({
                title: "คุณต้องการลบสมาชิกใช่หรือไม่?",
                text: "เมื่อลบแล้วคุณจะไม่สามารถย้อนกลับได้!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "ย้อนกลับ",
                confirmButtonText: "ใช่, ลบสมาชิก!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var userId = $(this).data('user-id');
                    window.location.href = "backNe/BN_delete_user.php?user_id=" + userId;
                }
            });
        });
    });
</script>