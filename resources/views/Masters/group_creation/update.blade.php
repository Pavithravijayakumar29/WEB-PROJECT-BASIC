<form action="javascript:insert_update_row('<?php echo $group_creation['id']; ?>',category_id.value,group_name.value,hsn_code.value,description.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Category Name <?php echo $group_creation['id']; ?></label><b class="mark_label_red">*</b>
            <select class="form-control select2" id="category_id" width="100%" >
                <?php
                $group_id=$group_creation['category_id'];
                foreach($category_creation as $category_creation1){ ?>
                <option value="<?php echo $category_creation1['id']; ?>" <?php if($group_id==$category_creation1['id']){echo " selected";} ?>><?php echo $category_creation1['category_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Group Name</label><b class="mark_label_red">*</b>
            <input type="text" id="group_name" class="form-control" value="<?php echo $group_creation['group_name']; ?>" >
            <div id="group_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">HSN Code</label><b class="mark_label_red">*</b>
            <input type="text" id="hsn_code" class="form-control" value="<?php echo $group_creation['hsn_code']; ?>" >
            <div id="hsn_code_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label for="description" class="stl">Description</label>
          <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"> <?php echo $group_creation['description']; ?></textarea>
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
