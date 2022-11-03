<div class="modal fade" id="form_products" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!------------------------  FORMA ZA UNOS NOVOG PROIZVODA ------------------------------------------->

        <form id="update_product_form" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
                <input type="hidden" name="pid" id="pid" value="">
              <label >Product name</label>
              <input type="text" class="form-control" name="update_product" id="update_product"  placeholder="Enter product name" required>
              <small id="pro_error" class="form-text text-muted"></small>
            </div>

            <div class="form-group col-md-6">
              <label>Category</label>
              <select class="form-control" id="select_cat" name="select_cat" required>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label>Product price</label>
            <input type="text" class="form-control" id="product_price" name="product_price">
          </div>

          <div class="form-group">
            <label >Product stock</label>
            <input type="text" class="form-control" id="product_stock" name="product_stock">
          </div>


        <button type="submit" class="btn btn-primary">Update product</button>
      </form>

<!-- ------------------------------------------------------------------------------------------------------------ -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
