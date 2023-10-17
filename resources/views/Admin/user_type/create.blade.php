<form action="javascript:insert_update_row('',user_type.value,status1.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">User Type <b class="mark_label_red">*</b></label>
            <input type="text" id="user_type" class="form-control">
            <div id="user_type_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Status <b class="mark_label_red">*</b></label>
            <select id="status1" class="form-control">
            <option value="1" class="stl">Active</option>
            <option value="0" class="stl">In Active</option>
            </select>
            <div id="status1_validate_div" class="mark_label_red"></div>
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
