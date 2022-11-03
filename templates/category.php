
<div class="modal fade" id="form_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      

      <!-- -------------------------------ISKACUCA FORMA ZA DODAVANJE KATEGORIJE--------------------------- -->
        <form id="category_form" onsubmit="return false">
          <div class="form-group">
            <label >Category Name</label>
            <input type="text" class="form-control" name="category_name"  id="category_name" >
            <small id="cat_error" class="form-text text-muted"></small>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- ----------------------------------------------------------------------------------------- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
