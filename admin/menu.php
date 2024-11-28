<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="home_admin.php?admin=dashboard" class="app-brand-link">
      <span class="app-brand-logo demo">

      </span>
      <i class="menu-icon" style="margin-left: -40px;"></i>
      <img src="   ../img/lg.png " width="40" height="40" alt="" class="img-small">
      </i>
      <span class="app-brand-text demo menu-text fw-bolder ms-2" style="margin-left: -150px;">shop</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item <?php echo ($_GET['admin'] == 'dashboard') ? 'active' : ''; ?>">
        <a href="home_admin.php?admin=dashboard" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item <?php echo ($_GET['admin'] == 'addproduct') ? 'active' : ''; ?>">
        <a href="home_admin.php?admin=addproduct" class="menu-link">
            <i class="menu-icon tf-iconsbi bi-boxes"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
                    <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z" />
                </svg></i>
            <div data-i18n="Layouts">เพิ่มรายการสินค้า</div>
        </a>
    </li>
    <li class="menu-item <?php echo ($_GET['admin'] == 'product') ? 'active' : ''; ?>">
      <a href="home_admin.php?admin=product" class="menu-link">
        <i class="menu-icon">
          <img src="https://cdn-icons-png.flaticon.com/512/5990/5990466.png " width="18" height="18" alt="" title="" class="img-small">
        </i>
        <div data-i18n="Layouts">รายการสินค้า</div>
      </a>
    </li>
    <li class="menu-item <?php echo ($_GET['admin'] == 'all_order') ? 'active' : ''; ?>">
      <a href="home_admin.php?admin=all_order" class="menu-link">
        <i class="menu-icon tf-icons bi bi-box2-heart"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5" />
          </svg></i>
        <div data-i18n="Account Settings">รายการคำสั่งซื้อทั้งหมด</div>
      </a>
    </li>
    <li class="menu-item <?php echo ($_GET['admin'] == 'order') ? 'active' : ''; ?>">
      <a href="home_admin.php?admin=order" class="menu-link">
        <i class="menu-icon">
          <img src="https://cdn-icons-png.flaticon.com/512/2666/2666469.png" width="18" height="18" alt="" title="" class="img-small" style="filter: grayscale(100%);">
        </i>
        <div data-i18n="Layouts">ตรวจสอบคำสั่งซื้อ</div>
      </a>
    </li>
    <li class="menu-item <?php echo ($_GET['admin'] == 'delivery') ? 'active' : ''; ?>">
      <a href="home_admin.php?admin=delivery" class="menu-link">
        <i class="menu-icon tf-iconsbi bi-box-seam-fill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2-heart" viewBox="0 0 16 16">
            <path d="M8 7.982C9.664 6.309 13.825 9.236 8 13 2.175 9.236 6.336 6.31 8 7.982" />
            <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zm0 1H7.5v3h-6zM8.5 4V1h3.75l2.25 3zM15 5v10H1V5z" />

          </svg></i>
        <div data-i18n="Account Settings">รายการที่ต้องจัดส่ง</div>
      </a>
    </li>
    <li class="menu-item <?php echo ($_GET['admin'] == 'finish_product') ? 'active' : ''; ?>">
      <a href="home_admin.php?admin=finish_product" class="menu-link">
        <i class="menu-icon tf-iconsbi bi-clipboard-check"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
          </svg></i>
        <div data-i18n="Account Settings">จัดส่งสินค้าแล้ว</div>
      </a>
    </li>
    <li class="menu-item <?php echo ($_GET['admin'] == 'complete_product') ? 'active' : ''; ?>">
      <a href="home_admin.php?admin=complete_product" class="menu-link">
        <i class="menu-icon tf-iconsbi bi-clipboard-check"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0" />
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
          </svg></i>
        <div data-i18n="Account Settings">ที่ลูกค้าได้รับแล้ว</div>
      </a>
    </li>
  </ul>
</aside>