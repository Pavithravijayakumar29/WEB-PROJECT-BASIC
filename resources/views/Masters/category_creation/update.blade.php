<form action="javascript:insert_update_row('<?php echo $category_creation['id']; ?>',category_name.value,description.value,status1.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Category Name</label><b class="mark_label_red">*</b>
            <input type="text" id="category_name" class="form-control" value="<?php echo $category_creation['category_name']; ?>">
            <div id="category_name_validate_div" style="color:red;"></div>
        </div>
    </div>

    <div class="col-md-6">
               <div class="form-group">
            <label for="description" class="stl">Description</label>
          <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"><?php echo $category_creation['description']; ?></textarea>
      </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Status<?php echo $category_creation['status']; ?></label>
            <select id="status1" class="form-control">
            <option value="1" <?php if($category_creation['status']==1){echo " selected";} ?>>Active</option>
            <option value="0" <?php if($category_creation['status']==0){echo " selected";} ?>>In Active</option>
            </select>
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
