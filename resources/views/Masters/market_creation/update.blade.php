<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
<form action="javascript:insert_update_row('<?php echo $market_creation['id']; ?>',state_id.value,district_id1.value,area_name.value,description.value)">

        <div class="form-group">
               <label class="stl">State Name</label><label style="color: red">*</label>
            <select class="select2-search__field" id="state_id" name="state_id" onchange="getDistricts()" >
                <option value="">Select State</option>
                <?php
                $state_id=$market_creation['state_id'];
                foreach($state_name as $state){ ?>
                <option value="<?php echo $state['id']; ?>" <?php if($state_id==$state['id']){echo " selected";} ?>><?php echo $state['state_name']; ?></option>
                <?php } ?>
            </select>
            <div id="state_id_validate_div" class="mark_label_red"></div>
        </div>

                <div class="form-group">
                       <label class="stl">District Name</label><label style="color: red">*</label>
                    <select class="select2-search__field" id="district_id1" width="100%" >
                        <?php
                        $dist_id=$market_creation['district_id'];
                        foreach($district_creation as $district_creation1){ ?>
                        <option value="<?php echo $district_creation1['id']; ?>" <?php if($dist_id==$district_creation1['id']){echo " selected";} ?>><?php echo $district_creation1['district_name']; ?></option>
                        <?php } ?>
                    </select>
                    <div id="district_id_validate_div" class="mark_label_red"></div>
                </div>

                <div class="form-group">
                        <label class="stl">Market Name</label><label style="color: red">*</label>
                    <input type="text" id="area_name" class="form-control" value="<?php echo $market_creation['area_name']; ?>" >
                    <div id="area_name_validate_div" class="mark_label_red"></div>
                </div>

                <div class="form-group">
                        <label for="description" class="stl">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"><?php echo $market_creation['description']; ?></textarea>
                </div>

        {{-- <div class="row">
            <div class="col-md-12 text-right">
                <button class="btn btn-icon btn-success" type="submit">Submit</button>
                <button class="btn btn-icon btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-icon btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
            <div class="col-md-6 text-right">
                <button  class="btn btn-icon btn-success" type="submit"></i> Submit</button>

        </div>
    </div>

    </form>
      </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            $('#state_id').select2();
            $('#district_id1').select2();
        });
        </script>

        <style>
.select2-container--default .select2-selection--single .select2-selection__rendered{
        width: 350px;
        min-height: 42px;
        line-height: 42px;
        padding-left: 20px;
        padding-right: 20px;
        }
            </style>

