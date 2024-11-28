<div class="card">
  <h1>รายการที่ต้องจัดส่ง</h1>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap">
          <th>ลำดับ</th>
          <th>ชื่อผู้สั่งซื้อ</th>
          <th>จำนวนที่สั่งซื้อ</th>
          <th>ราคา</th>
          <th>ราคารวม</th>
          <th>ตรวจสอบ</th>
          <th>สถานะ</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>คุณภัทรนันท์</td>
          <td>3</td>
          <td>60</td>
          <td>60</td>
          <td>
            <div class="mt-3">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCenter1">ตรวจสอบ</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalCenter1" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">จัดส่งสำเร็จ</h5>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ซื้อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>ผักชี</td>
                        <td>1</td>
                        <td>20</td>
                      </tr>
                      <tr>
                        <td>ผักบุ้งจีน</td>
                        <td>1</td>
                        <td>20</td>
                      </tr>
                      <tr>
                        <td>ผักกาด</td>
                        <td>1</td>
                        <td>20</td>
                      </tr>
                      <tr>
                      <td>ราคารวมทั้งหมด</td>
                      <td>110</td>
                      </tr>
                    </tbody>
                  </table>
                  <div style="display: flex; justify-content: center; align-items: center; height:  10%;">
                    <img src="../img/slip.jpg" style="width: 50%; margin-top: 0px;">
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td>
          <div style="display: inline-block;">
            <select class="form-select" aria-label="Default select example" style="width: auto;">
                <option selected>อัปเดตสถานะการจัดส่ง</option>
                <option value="1">กำลังจัดส่ง</option>
                
            </select>
            </div>
        <div style="display: inline-block;">
            <a href="home_admin.php?admin=finish_product"><button type="submit" class="btn btn-outline-success">ส่งสินค้าแล้ว</button></a>
        </div>
        </select>
    </td>
</tr>
        
        <tr>
            
          
  </td>
</tr>

      </tbody>
    </table>
  </div>
</div>
<tr class="border-bottom">
  <th scope="row"></th>
  <td></td>
  <td></td>
  <td></td>
  <td>
  </td>
</tr>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
  }

  .container {
    max-width: 2000px;
    margin: 10px auto;
    padding: 50px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h1 {
    text-align: center;
  }

  table {
    width: 100%;
    border-collapse: fixed;
    margin-top: 30px;
  }

  th,
  td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: fixed;
  }

  th {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #f9f9f9;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
    border: none;
    /* หรือ border: 0; */
  }

  th,
  td {
    border: none;
    /* หรือ border: 0; */
    padding: 8px;
    text-align: fixed;
  }
</style>
<tbody>
  <tr class="border-bottom">
    <style>
      /* Styling for the popup container */
      .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border: 2px solid #ddd;
        border-radius: 5px;
        padding: 25px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        z-index: 150;
        max-width: 20%;
        /* ขนาดสูงสุดของ Popup เป็น 80% ของหน้าจอ */
        max-height: 100%;
        /* ขนาดสูงสุดของ Popup เป็น 80% ของหน้าจอ */
        overflow: auto;
        text-align: auto;
      }

      /* Styling for the close button */
      /* CSS for the close button */
      .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 25px;
        cursor: pointer;
        color: #333;
        margin: -3px;
        /* ขนาดกากบาต */
      }


      /* Styling for the image inside the popup */
      .popup img {
        max-width: 100%;
        /* ขนาดรูปภาพสูงสุดเท่ากับความกว้างของ Popup */
        max-height: 100%;
        /* ขนาดรูปภาพสูงสุดเท่ากับความสูงของ Popup */
        margin: auto;
        /* จัดการย่อหน้าต่างตามศูนย์กลาง */
        display: auto;
        /* ทำให้รูปภาพอยู่กลางตามแนวนอน */
      }
    </style>


    <!-- Button to open the popup -->

    <script>
      function openPopup(imageUrl) {
        // Create the popup container
        var popup = document.createElement('div');
        popup.classList.add('popup');

        // Create the close button
        var closeBtn = document.createElement('span');
        closeBtn.classList.add('close');
        closeBtn.innerHTML = '&times;';
        closeBtn.onclick = function() {
          document.body.removeChild(popup);
        };
        popup.appendChild(closeBtn);

        // Create the image element
        var img = document.createElement('img');
        img.src = imageUrl;
        popup.appendChild(img);

        // Add the popup to the body
        document.body.appendChild(popup);
      }
    </script>
    <!-- สลิป -->
  </tr>