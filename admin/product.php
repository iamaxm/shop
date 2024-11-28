<?php
$all_product = 0;
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<style>
    /* Your existing CSS styles */
    .popup {
      display: none;
      /* Hide the popup by default */
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #fff;
      border: 2px solid #ddd;
      border-radius: 5px;
      padding: 50px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
      z-index: 150;
      max-width: 100%;
      max-height: 100%;
      overflow: auto;
      text-align: auto;
      width: 400px;
      height: 400px;

    }


    #popupImage {

      width: 100%;
      height: 100%;
      object-fit: cover;
    }
 .table td {
  /* จัดการกับข้อความที่เกินขอบเขตของเซลล์ */
  word-wrap: break-word; /* ตัดคำให้พอดี */
 
  white-space: normal; /* แสดงข้อความในบรรทัดใหม่หากเกินขอบเขตของเซลล์ */
}
  </style>

  <div class="card mt-5" style="padding-top:3rem; margin:2rem 2rem;">
    <div class="container" style="padding-bottom:3rem;">
      <div class="row">
        <div class="col-md-6">
          <div class="input-group rounded">
            <input type="search" id="myInput" onkeyup="myFunction()" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
              <i class="fas fa-search"></i>
            </span>
          </div>
        </div>


        <div class="col-md-6">
          <div class="input-group">
            <select class="form-select" id="inputGroupSelect02" onchange="location = this.value;">
              <option selected disabled hidden>ค้นหาประเภท...</option>
              <option value="home_admin.php?admin=product">สินค้าทั้งหมด</option>
              <option value="home_admin.php?admin=product&type=ผัก">ผัก</option>
              <option value="home_admin.php?admin=product&type=ผลไม้">ผลไม้</option>
            </select>
            <label class="input-group-text" for="inputGroupSelect02">ค้นหา</label>
          </div>
        </div>

      </div>
    </div>

    <div class="table-responsive text-nowrap">
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th style="font-size: 16px;">ชื่อสินค้า</th>
            <th style="font-size: 16px;">รายละเอียด</th>
            <th style="font-size: 16px;">รูปภาพ</th>
            <th style="font-size: 16px;"><center>ราคาสินค้า</center></th>
            <th style="font-size: 16px;">ประเภท</th>
            <th style="font-size: 16px;"><center>แก้ไข</center></th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('../db.php');

          $product_type = isset($_GET['type']) ? $_GET['type'] : '';

          $sql = "SELECT * FROM `products`";

          if (!empty($product_type)) {
            $sql .= " WHERE `product_type` = '$product_type'";
          }

          $result = $conn->query($sql);

          while ($row = mysqli_fetch_array($result)) {  ?>
            <tr>
              <td> <strong><?php echo $row['product_name']; ?></strong></td>
              <td><?php echo $row['product_detail']; ?></td>
              <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="<?php echo $row['product_name']; ?>" style="margin-top: -10px;" onmouseover="showPopup('<?php echo $row['img']; ?>')" onmouseout="hidePopup()">
                    <img src="product_img/<?php echo $row['img']; ?>" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                  </li>

                  <div id="popup" class="popup">
                    <!-- Popup content goes here -->
                    <img id="popupImage" src="" alt="Popup Image">
                  </div>
                </ul>
              </td>
              <td><center><span class="badge bg-label-primary me-1" style="font-size: 16px;"><?php echo $row['product_price']; ?></span></center></td>
              <td><strong><?php echo $row['product_type']; ?></strong></td>
              <td>
                <center>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a href="home_admin.php?admin=edit_product&product_id=<?php echo $row['product_id']; ?>" class="dropdown-item">แก้ไข</a>
                    <button type="button" class="btn align-items-center dropdown-item delete-product" data-bs-toggle="modal" data-bs-toggle="dropdown"
                     data-bs-target="#exampleModal" data-product-id="<?php echo $row['product_id']; ?>" onclick="confirmDelete(this)">ลบ</button>
                  </div>
                </div>
                </center>
              </td>
            </tr>
            <?php $all_product += 1; ?>
          <?php } ?>
          <span class="badge rounded-pill bg-dark" style="font-size: 16px; margin : 1rem 1rem;">รวมสินค้าทั้งหมด <?php echo number_format($all_product); ?> รายการ</span>
        </tbody>
      </table>
    </div>
  </div>

  <script>
function confirmDelete(button) {
    var productId = button.getAttribute('data-product-id');
    Swal.fire({
        title: "คุณแน่ใจที่จะลบใช่ไหม?",
        text: "เมื่อลบแล้วจะไม่สามารถย้อนกลับได้!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ลบสินค้า"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to delete_product_form.php with product_id
            window.location.href = "backNe/delete_product_form.php?product_id=" + productId;
        }
    });
}
</script>
  <!-- Modal -->
  <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="backNe/delete_product_form.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ลบสินค้า</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>คุณต้องการลบสินค้านี้ใช่หรือไม่?</p>
            <input type="hidden" id="delete_product_id" name="product_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ไม่</button>
            <button type="submit" class="btn btn-primary">ใช่</button>
          </div>
        </form>
      </div>
    </div>
  </div> -->

  <!-- Bootstrap Bundle with Popper -->

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

  <!-- Font Awesome JS -->

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const deleteButtons = document.querySelectorAll(".delete-product");
      deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
          const productId = this.getAttribute("data-product-id");
          document.getElementById("delete_product_id").value = productId;
        });
      });
    });
  </script> -->



<script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>

<script>
  function showPopup(imageUrl) {
    var popup = document.getElementById('popup');
    var image = document.getElementById('popupImage');
    image.src = 'product_img/' + imageUrl; // Set the image source
    popup.style.display = 'block'; // Show the popup
  }

  function hidePopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'none'; // Hide the popup
  }
</script>