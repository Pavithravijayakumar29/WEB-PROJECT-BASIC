<form action="javascript:insert_update_row('<?php echo $dealer_creation['id']; ?>',sales_rep_id.value,dealer_name.value,mobile_no.value,whatsapp_no.value,address.value,place.value,pan_no.value,gst_no.value,aadhar_no.value,driving_licence.value,bank_name.value,check_no.value,state_id.value,district_id.value,area_id.value,manager_id.value)" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
           <label class="stl">Manager Name</label>
           <select class="select2-search__field" id="manager_id" name="manager_id">
           <option value="">Select Manager Name</option>
            <?php foreach ($manager as $manager1){
                $manager_id=$dealer_creation['manager_name'];?>
                <option value="<?php echo $manager1['id']; ?>"<?php if($manager_id==$manager1['id']){echo "selected";}?>><?php echo $manager1['manager_name']; ?></option>
           <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
           <label class="stl">Sales Executive Name</label>
           <select class="select2-search__field" id="sales_rep_id" name="sales_rep_id">
           <option value="">Select Sales Executive</option>
            <?php
                 $sales_rep_id=$dealer_creation['sales_rep_id'];
                 foreach($sales_rep_name as $sales_rep_name1){ ?>
                 <option value="<?php echo $sales_rep_name1['id']; ?>" <?php if($sales_rep_id==$sales_rep_name1['id']){echo "selected";}?>><?php echo $sales_rep_name1['sales_ref_name']; ?></option>
                 <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Dealer Name<b class="mark_label_red">*</b></label>
            <input type="text" id="dealer_name" class="form-control" value="<?php echo $dealer_creation['dealer_name']; ?>">
            <div id="dealer_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Mobile No</label>
            <input type="text" id="mobile_no" maxlength="10" class="form-control" value="<?php echo $dealer_creation['mobile_no']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">WhatsApp No<b class="mark_label_red">*</b></label>
            <input type="text" id="whatsapp_no" maxlength="10" class="form-control" value="<?php echo $dealer_creation['whatsapp_no']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div id="whatsapp_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Address<b class="mark_label_red">*</b></label>
            <textarea id="address" class="form-control"><?php echo $dealer_creation['address']; ?></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Place<b class="mark_label_red"></b></label>
            <input type="text" id="place" class="form-control" value="<?php echo $dealer_creation['place']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">State Name</label><br>
            <select class="form-control form-control-md state_name_options" style="width:250px;" id="state_id" name="state_id[]" multiple="" onchange="getDistricts()">
                <option value="">Select State</option>
                <?php
                $state_id=explode(',',$dealer_creation['state_id']);
                foreach($state_name as $state_name1){ ?>
                <option value="<?php echo $state_name1['id']; ?>" <?php echo (in_array($state_name1['id'],$state_id)?" selected":""); ?>><?php echo $state_name1['state_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">District Name</label><br>
            <select class="form-control form-control-md district_name_options" style="width:250px;" id="district_id" name="district_id[]" multiple="" onchange="getArea()">
                <?php
                $dist_id=explode(',',$dealer_creation['district_id']);
                foreach($district_name as $district_name1){ ?>
                <option value="<?php echo $district_name1['id']; ?>" <?php echo (in_array($district_name1['id'],$dist_id)?" selected":""); ?>><?php echo $district_name1['district_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Market Name</label><br>
            <select class="form-control form-control-md area_name_options" style="width:250px;" id="area_id" name="area_id[]" multiple="">
                <?php
                $area_id=explode(',',$dealer_creation['area_id']);
                foreach($area_name as $area_name1){ ?>
                <option value="<?php echo $area_name1['id']; ?>" <?php echo (in_array($area_name1['id'],$area_id)?" selected":""); ?>><?php echo $area_name1['area_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Pan No</label>
            <input type="text" id="pan_no" class="form-control" value="<?php echo $dealer_creation['pan_no']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">GST No</label>
            <input type="text" id="gst_no" class="form-control" value="<?php echo $dealer_creation['gst_no']; ?>">
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Aadhar No</label>
            <input type="text" id="aadhar_no" class="form-control" value="<?php echo $dealer_creation['aadhar_no']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Driving Licence No</label>
            <input type="text" id="driving_licence" class="form-control" value="<?php echo $dealer_creation['driving_licence']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Bank Name</label>
            <input type="text" id="bank_name" class="form-control" value="<?php echo $dealer_creation['bank_name']; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Security Cheque</label>
            <input type="text" id="check_no" class="form-control" value="<?php echo $dealer_creation['check_no']; ?>">
        </div>
    </div>


</div>
<div class="row">
     {{-- Image Upload --}}
     <div class="col-md-3">
        <div class="form-group">
             <label for="phone_number" class="stl">Image upload</label>
            <input type="file" class="form-control" id="image_name" name="image_name" onchange="previewImage(event)">
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-2">
        <div class="form-group">
            <img id="image_preview" src="{{ $dealer_creation['image_name'] != '' ? asset('storage/dealer_img/' . $dealer_creation['image_name']) : asset('storage/default/default_image.png') }}" width="100" height="100" alt="Image Preview">
        </div>
    </div>
    {{-- End --}}
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

<script>
$(function () {
    $("#sales_rep_id").select2();
    $(".state_name_options").select2();
    $(".district_name_options").select2();
    $(".area_name_options").select2();
    $("#manager_id").select2();
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
            imagePreview.setAttribute('src', "{{ asset('storage/default /default_image.png') }}");
        }
    }
</script>
<style>
.select2-container--default .select2-selection--single .select2-selection__rendered{
    width: 250px;
    min-height: 42px;
    line-height: 42px;
    padding-left: 20px;
    padding-right: 20px;
}
</style>
