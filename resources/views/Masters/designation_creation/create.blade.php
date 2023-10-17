<form action="javascript:insert_update_row('',designation_name.value,description.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Designation Name</label><b class="mark_label_red">*</b>
            <input type="text" id="designation_name" class="form-control" >
            <div id="designation_name_validate_div" style="color:red;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description" class="stl">Description</label>
          <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"></textarea>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
      <button class="btn btn-icon icon-left btn-danger" data-dismiss="modal" aria-label="Close">
        <span class="fas fa-times"></span>Cancel
      </button>
    </div>
    <div class="col-md-6 text-right">
      <button class="btn btn-icon icon-left btn-success" type="submit">
        <span class="fas fa-check"></span>Submit
      </button>
    </div>
  </div>
</form>
