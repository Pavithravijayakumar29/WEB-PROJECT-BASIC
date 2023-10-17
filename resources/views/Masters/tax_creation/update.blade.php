<form action="javascript:insert_update_row('<?php echo $tax_creation['id']; ?>',tax_name.value,percentage.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Tax Name</label><b class="mark_label_red">*</b>
            <input type="text" id="tax_name" class="form-control" value="<?php echo $tax_creation['tax_name']; ?>" >
            <div id="tax_name_validate_div" style="color:red;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Tax Percentage</label><b class="mark_label_red">*</b>
            <input type="text" id="percentage" class="form-control" value="<?php echo $tax_creation['percentage']; ?>" >
            <div id="percentage_validate_div" style="color:red;"></div>
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
        <span class="fas fa-check"></span>Update
      </button>
    </div>
  </div>
</form>
