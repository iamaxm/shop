<div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">เพิ่มรายการสินค้า</h5>
                      <small class="text-muted float-end">Default label</small>
                    </div>
                    <div class="card-body">
                      <form method="post" action="backNe/add_product.php">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">ประเภทสินค้า</label>
                          <div class="col-sm-10">
                            <input list="cars"  class="form-control" name="product_type" placeholder=>
                         <datalist id="cars">
                           <option value="ผัก" >
                           <option value="ผลไม้" >  
                           </datalist>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-company">ชื่อสินค้า</label>
                          <div class="col-sm-10">
                            <input name="product_name" type="text" class="form-control" id="basic-default-company" >
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-email">รายละเอียดสินค้า</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <input name="product_detail" type="text" id="basic-default-email" class="form-control" placeholder=>
                            
                            </div>
                            <div class="form-text"></div>
                          </div>	
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-phone" >ราคาสินค้า</label>
                          <div class="col-sm-10">
                            <input name="product_price" type="text" id="basic-default-phone" class="form-control phone-mask" placeholder=>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-phone">รูปภาพ</label>
                          <div class="col-sm-10">
                            <input name="img"  type="file" id="basic-default-phone" class="form-control phone-mask" placeholder=>
                          </div>
                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            
                          </div>
                        </div>
                        <button  type="submit" class="btn btn-primary">บันทึก</button>
                      </form>
                    </div>
                  </div>


                  