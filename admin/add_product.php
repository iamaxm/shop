<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
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
    text-align: center;
    font-size: 18px;
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
  }

  th,
  td {
    border: none;
    padding: 8px;
    text-align: fixed;
  }

  .modal-title {
    margin: auto;
    text-align: right;
  }

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
    max-height: 100%;
    overflow: auto;
    text-align: auto;
  }

  .close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 25px;
    cursor: pointer;
    color: #333;
    margin: -3px;
  }

  .popup img {
    max-width: 100%;
    max-height: 100%;
    margin: auto;
    display: block;
    border: 5px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  p {
    margin-bottom: -4px;
  }

  .table th,
  .table td {
    text-align: left;
  }

  .grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    grid-gap: 20px;
    padding: 20px;
  }

  .grid-item {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
  }

  .grid-item h1 {
    text-align: center;
  }
</style>

<body>
  <div class="card mt-5" style="padding-top:3rem; margin:2rem 2rem;">
    <h1>เพิ่มรายการสินค้า</h1>
    <div class="card-body">
      <form method="post" action="backNe/add_product.php" enctype="multipart/form-data">
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name" style="font-size:16px">ประเภทสินค้า</label>
          <div class="col-sm-10">
            
            <select class="form-control" id="product_type" name="product_type" aria-label="Default select example" >
              <option selected disabled hidden></option>
              <option value="ผัก">ผัก</option>
              <option value="ผลไม้">ผลไม้</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-company" style="font-size:16px">ชื่อสินค้า</label>
          <div class="col-sm-10">
            <input name="product_name" type="text" class="form-control" id="basic-default-company">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-email" style="font-size:16px">รายละเอียดสินค้า</label>
          <div class="col-sm-10">
            <div class="input-group input-group-merge">
              <input name="product_detail" type="text" id="basic-default-email" class="form-control">
            </div>
            <div class="form-text"></div>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-phone" style="font-size:16px">ราคาสินค้า</label>
          <div class="col-sm-10">
            <input name="product_price" type="text" id="basic-default-phone" class="form-control phone-mask">
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="imgInput" style="font-size:16px">รูปภาพ</label>
          <div class="col-sm-10">
            <input name="img" type="file" id="imgInput" class="form-control phone-mask">
          </div>
        </div>
        <div style="display: flex; justify-content: center;">
          <img id="imgPreview" src="#" alt="รูปภาพที่เลือก" style="max-width: 100%; max-height: 300px; margin-top: 10px; border-radius: 10px; display: none;">
        </div>

        <div class="row justify-content-end">
          <div class="col-sm-10 text-end">
            <button type="submit" class="btn rounded-pill btn-outline-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
              </svg>&nbsp;บันทึก</button>
          </div>
        </div>

      </form>
    </div>
  </div>

  <script>
    function previewImage(input) {
      var imgPreview = document.getElementById('imgPreview');
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          imgPreview.style.display = 'block';
          imgPreview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    var imgInput = document.getElementById('imgInput');
    imgInput.addEventListener('change', function() {
      previewImage(this);
    });
  </script>
</body>