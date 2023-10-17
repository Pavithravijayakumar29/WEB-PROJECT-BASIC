<form action="javascript:insert_update_row('<?php echo $district_creation['id']; ?>',country_id.value,state_id.value,district_name.value,description.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Country Name</label><b class="mark_label_red">*</b>
            <select class="form-control select2" id="country_id" onchange='find_state()' width="100%" >
                <?php
                $country_id=$district_creation['country_id'];
                foreach($country_creation as $country_creation1){ ?>
                <option value="<?php echo $country_creation1['id']; ?>" <?php if($country_id==$country_creation1['id']){echo " selected";} ?>><?php echo $country_creation1['country_name']; ?></option>
                <?php } ?>
            </select>
            <div id="country_id_validate_div" style="color:red;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">State Name</label><b class="mark_label_red">*</b>
            <select class="form-control select2" id="state_id" width="100%" >
                <?php
                $state_id=$district_creation['state_id'];
                foreach($state_creation as $state_creation1){ ?>
                <option value="<?php echo $state_creation1['id']; ?>" <?php if($state_id==$state_creation1['id']){echo " selected";} ?>><?php echo $state_creation1['state_name']; ?></option>
                <?php } ?>
            </select>
            <div id="state_id_validate_div" style="color:red;"></div>
        </div>
    </div>




    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">District Name</label><b class="mark_label_red">*</b>
            <input type="text" id="district_name" class="form-control" value="<?php echo $district_creation['district_name']; ?>" >
            <div id="district_name_validate_div" style="color:red;"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description" class="stl">Description</label>
          <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"><?php echo $district_creation['description']; ?></textarea>
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
