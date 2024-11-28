<div class="card mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="input-group">
          <button class="btn btn-outline-primary" type="button" id="button-addon1">ค้นหา</button>
          <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
        </div>

      </div>
      <div class="col-md-6">
        <div class="input-group">
          <select class="form-select" id="inputGroupSelect02">
            <option selected="">Choose...</option>
            <option value="1">ผัก</option>
            <option value="2">ผลไม้</option>
          </select>
          <label class="input-group-text" for="inputGroupSelect02">ประเภท</label>
        </div>
      </div>

    </div>
  </div>

  </datalist>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <caption class="ms-4">
        List of Projects
      </caption>
      <thead>
        <tr>
          <th>ชื่อสินค้า</th>
          <th>รายละเอียด</th>
          <th>รูปภาพ</th>
          <th>ราคาสินค้า</th>
          <th>ประเภท</th>
          <th>แก้ไข</th>
        </tr>
      </thead>
      <tbody>

        <?php

        include('backNe/db.php');
        $sql = "SELECT * FROM products";

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {  ?>

          <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php    echo $row['product_name']; ?></strong></td>
          <td><?php    echo $row['product_detail']; ?></strong></td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                <img src="../shop/img/fruite-item-6.jpg" alt="Avatar" class="rounded-circle">
              </li>

            </ul>
          </td>
          <td><span class="badge bg-label-primary me-1"><?php    echo $row['product_price']; ?></strong></td>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php    echo $row['product_type']; ?></strong></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>

              <div class="dropdown-menu">
              <a type="button" class="btn btn-primary" href="home_admin.php?admin=edit_product">
                                Edit
                                </a>
                                <br>
                                <br>
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color:white">
                                Delete
                                </a>
            </div>
          </td>
        </tr>
       
       <?php }

        ?>

         <!-- echo $i;
  $i++; -->
<?php 
?>  

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ต้องการลบใช่ไหม</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-primary">Yes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
      </tbody>
    </table>
  </div>
</div>