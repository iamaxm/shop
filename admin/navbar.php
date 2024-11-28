<?php @session_start();
include('../db.php');
$user_id = $_SESSION['UserID'];
$role = "SELECT * FROM `users` WHERE user_id = $user_id";
$result = $conn->query($role);
$row = $result->fetch_assoc();
?>

<style>
  .capitalize {
    text-transform: capitalize;
  }
</style>

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>
  <div style="display: flex; align-items: center;">
    <img src="../img/lg.png" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 5px;" />
  </div>

  <ul class="navbar-nav flex-row align-items-center ms-auto">
  <li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" style="display: flex; align-items: center;">
      <div class="avatar avatar-online" style="margin-right: 10px;">
        <i class="bi bi-person-circle" alt="" class="w-px-40 h-auto rounded-circle"></i>
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
        </svg>
      </div>
      <div>
      <span class="fw-semibold d-block"><?php echo @$_SESSION["User"] ?></span>
      </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="#">
          <div class="d-flex">
            <div class="flex-shrink-0 me-3">
              <div class="avatar avatar-online" style="margin-right: 10px;">
                <i class="bi bi-person-circle" alt="" class="w-px-40 h-auto rounded-circle"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
              </div>
            </div>
            <div class="flex-grow-1">
              <span class="fw-semibold d-block"><?php echo @$_SESSION["User"] ?></span>
              <small class="capitalize <?php echo ($row['role'] == 'superadmin') ? 'text-danger' : (($row['role'] == 'admin') ? 'text-info' : ''); ?>">
                <?php echo $row['role']; ?>
              </small>
            </div>
          </div>
        </a>
      </li>
      <li>
        <div class="dropdown-divider"></div>
      </li>
      <li>
        <a class="dropdown-item" href="home_admin.php?admin=all_member">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
          </svg>
          <span class="align-middle">&nbsp;&nbsp;&nbsp;รายชื่อสมาชิกทั้งหมด</span>
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="home_admin.php?admin=all_admin">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
          </svg>
          <span class="align-middle">&nbsp;&nbsp;&nbsp;รายชื่อผู้ดูแลระบบทั้งหมด</span>
        </a>
      </li>
      <?php if (isset($_SESSION['User']) && $_SESSION['status'] == 'superadmin') { ?>
      <li>
        <a class="dropdown-item" href="home_admin.php?admin=add_admin">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
          </svg>
          <span class="align-middle">&nbsp;&nbsp;&nbsp;เพิ่มผู้ดูแลระบบ</span>
        </a>
      </li>
      <?php } ?>
      <li>
        <a class="dropdown-item" href="../index.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
            <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
          </svg>
          <span class="align-middle">&nbsp;&nbsp;&nbsp;Go to shop</span>
        </a>
      </li>

      <li>
        <hr class="dropdown-divider">
      </li>
      <li>
        <a class="dropdown-item" href="../logout.php">
          <i class="bx bx-power-off me-2"></i>
          <span class="align-middle">Log Out</span>
        </a>
      </li>
    </ul>
  </li>
  </ul>
  <!-- user end -->
</nav>