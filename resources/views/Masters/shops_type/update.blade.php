<form action="javascript:insert_update_row('<?php echo $shops_type['id']; ?>',shops_type.value,status1.value,description.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Shops Type<b class="mark_label_red">*</b></label>
            <input type="text" id="shops_type" class="form-control" value="<?php echo $shops_type['shops_type']; ?>">
            <div id="shops_type_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Status</label>
            <select id="status1" class="form-control">
            <option value="1" <?php if($shops_type['status1']=="1"){echo " selected";} ?>>Active</option>
            <option value="0" <?php if($shops_type['status1']!="1"){echo " selected";} ?>>In Active</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="stl">Description</label>
            <textarea id="description" class="form-control"><?php echo $shops_type['description']; ?></textarea>
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
