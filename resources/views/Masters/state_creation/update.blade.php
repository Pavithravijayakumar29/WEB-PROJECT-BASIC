<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="javascript:insert_update_row('<?php echo $state_creation['id']; ?>', country_id.value, state_name.value, description.value)">
            <div class="form-group">
                  <label for="country_id" class="stl">Country Name</label><label style="color:red">*</label>
                <select class="form-control select2" id="country_id" required>
                    <?php
                    $country_id = $state_creation['country_name'];
                    foreach ($country_name as $country_name1) {
                        $country_name = ucfirst($country_name1['country_name']);
                        $selected = $country_id == $country_name1['country_name'] ? 'selected' : '';
                    ?>
                    <option value="<?php echo $country_name1['id']; ?>" <?php echo $selected; ?>><?php echo $country_name; ?></option>
                    <?php } ?>
                </select>
                <div id="country_id_validate_div" style="color:red;"></div>
            </div>

          <div class="form-group">
               <label class="stl">State Name</label><label style="color:red">*</label>
            <input type="text" id="state_name" class="form-control" value="<?php echo $state_creation['state_name']; ?>" >
            <div id="state_name_validate_div" style="color:red;"></div>
          </div>

          <div class="form-group">
               <label for="description" class="stl">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?php echo $state_creation['description']; ?></textarea>
          </div>

          {{-- <div class="row">
            <div class="col-md-12 text-right">
              <button class="btn btn-icon btn-success" type="submit">Update</button>
              <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
          </div> --}}
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
      </div>
    </div>
  </div>

    <script>
    $(document).ready(function() {
        $('#country_id').select2();


    });
</script>
    <style>
       .select2-container--default .select2-selection--single .select2-selection__rendered{
                width: 350px;
                min-height: 42px;
                line-height: 42px;

                padding-right: 20px;
                display: inline-block;
    overflow: hidden;
    padding-left: 8px;
    text-overflow: ellipsis;
    white-space: nowrap;
    /* background-color: #fdfdff;
    border-color: #e4e6fc; */
}
 </style>

