<form action="javascript:insert_update_row('<?php echo $sales_rep_creation['id']; ?>', manager_id.value, sales_ref_name.value, mobile_no.value, phone_no.value, pin_gst_no.value, aadhar_no.value, driving_licence.value, address.value, state_id.value, district_id.value)" enctype="multipart/form-data">
<div class="row">

<div class="col-md-4">
        <div class="form-group">
              <label>Market Manager Name<b class="mark_label_red">*</b></label>
            <div id="manager_id_validate_div" class="mark_label_red"></div>
            <select class="select2-search__field" id="manager_id" name="manager_id" >
                <option value="">Select Manager Name</option>
                <?php
                $manager_id=$sales_rep_creation['manager_id'];
                foreach($market_manager_creations as $market_manager_creation){ ?>
                <option value="<?php echo $market_manager_creation['id']; ?>" <?php if($manager_id==$market_manager_creation['id']){echo "selected";}?>><?php echo $market_manager_creation['manager_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>




    <div class="col-md-4">
        <div class="form-group">
               <label for="name">Sales Rep Name<b class="mark_label_red">*</b></label>
            <div id="sales_ref_name_validate_div" class="mark_label_red"></div>
            <input type="text" class="form-control" id="sales_ref_name" value="<?php echo $sales_rep_creation['sales_ref_name']; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
             <label for="mobile_number">Mobile Number<b class="mark_label_red">*</b></label>
            <div id="mobile_no_validate_div" class="mark_label_red"></div>
            <input type="text" class="form-control" id="mobile_no" value="<?php echo $sales_rep_creation['mobile_no']; ?>">
        </div>
    </div>
    


<div class="col-md-4">
        <div class="form-group">
              <label for="phone_number">WhatsApp Number</label>
            <input type="text" class="form-control" id="phone_no" value="<?php echo $sales_rep_creation['phone_no']; ?>">
        </div>
    </div>  


    <div class="col-md-4">
        <div class="form-group">

        <label for="address">Address</label>
            <div id="address_validate_div" class="mark_label_red"></div>
            <textarea class="form-control" id="address" name="address" rows="3"><?php echo $sales_rep_creation['address']; ?></textarea>



             
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
              <label>State Name</label>
            <div id="state_id_validate_div" class="mark_label_red"></div>
            <select class="select2-search__field" id="state_id" name="state_id" onchange="getDistricts()">
                <option value="">Select State</option>
                <?php
                $state_id=$sales_rep_creation['state_id'];
                foreach($state_name as $state){ ?>
                <option value="<?php echo $state['id']; ?>" <?php if($state_id==$state['id']){echo "selected";}?>><?php echo $state['state_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
             <label>District Name</label>
            <div id="district_id1_validate_div" class="mark_label_red"></div>
            <select class="select2-search__field" id="district_id" width="100%" >
                <?php
                $dist_id=$sales_rep_creation['district_id'];
                foreach($district_creation as $district_creation1){ ?>
                <option value="<?php echo $district_creation1['id']; ?>" <?php if($dist_id==$district_creation1['id']){echo "selected";}?>><?php echo $district_creation1['district_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Aadhar No</label>
            <input type="text" id="aadhar_no" class="form-control" value="<?php echo $sales_rep_creation['aadhar_no']; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Driving Licence No</label>
            <input type="text" id="driving_licence" class="form-control" value="<?php echo $sales_rep_creation['driving_licence']; ?>">
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
        <label for="pan_gst_number">PAN No</label>
            <input type="text" class="form-control" id="pin_gst_no" value="<?php echo $sales_rep_creation['pin_gst_no']; ?>">
             
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
             <label for="phone_number">Image upload</label>
            <input type="file" class="form-control" id="image_name" name="image_name" onchange="previewImage(event)" value="<?php echo $sales_rep_creation['image_name']; ?>">
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-2">
        <div class="form-group">
            <img id="image_preview" src="{{ $sales_rep_creation['image_name'] != '' ? asset('storage/barang/' . $sales_rep_creation['image_name']) : asset('storage/default/default_image.png') }}" width="100" height="100" alt="Image Preview">
        </div>
    </div>
    <div class="col-md-1"></div>

    
  
</div>
<div class="row">
    <div class="col-md-6">
        <button class="btn btn-icon btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
    </div>
    <div class="col-md-6 text-right">
        <button  class="btn btn-icon btn-success" type="submit"></i> Update</button>

</div>
</div>
</form>

<script>
    $(document).ready(function() {
        $('#manager_id').select2();
        $('#state_id').select2();
        $('#district_id').select2();
        
    });

    function previewImage(event) {
        const imagePreview = document.getElementById('image_preview');
        const fileInput = event.target;

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.setAttribute('src', e.target.result);
            }

            reader.readAsDataURL(fileInput.files[0]);
        } else {
            imagePreview.setAttribute('src', "{{ asset('storage/default/default_image.png') }}");
        }
    }

</script>

<style>
    /* Existing style for select2 containers */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        width: 350px;
        min-height: 42px;
        line-height: 42px;
        padding-left: 20px;
        padding-right: 20px;
    }

    /* Your custom styles */
    .invalid-feedback {
        color: red;
        font-size: 14px;
        margin-top: 4px;
    }

    .is-invalid {
        border-color: red;
    }
</style>
