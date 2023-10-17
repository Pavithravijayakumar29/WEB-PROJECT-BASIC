<form action="javascript:insert_update_row('',category_id.value,group_name.value,hsn_code.value,description.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Category Name</label><b class="mark_label_red">*</b>
            <select class="form-control select2" id="category_id" width="100%" >
                <option value="">----Select Category---- </option>
                <?php foreach($categoryCreation as $categoryCreation1){ ?>
                <option value="<?php echo $categoryCreation1['id']; ?>"><?php echo $categoryCreation1['category_name']; ?></option>
                <?php } ?>
            </select>
            <div id="category_id_validate_div" style="color:red;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Group Name</label><b class="mark_label_red">*</b>
            <input type="text" id="group_name" class="form-control" >
            <div id="group_name_validate_div" style="color:red;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">HSN Code</label><b class="mark_label_red">*</b>
            <input type="text" id="hsn_code" class="form-control" >
            <div id="hsn_code_validate_div" style="color:red;"></div>

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
