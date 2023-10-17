<form  action="javascript:insert_update_row('',sales_rep_id.value,dealer_name.value,mobile_no.value,whatsapp_no.value,address.value,place.value,pan_no.value,gst_no.value,aadhar_no.value,driving_licence.value,bank_name.value,check_no.value,state_id.value,district_id.value,area_id.value,manager_id.value)" enctype="multipart/form-data">

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
           <label class="stl">Manager Name</label>
           <select class="select2-search__field" id="manager_id" name="manager_id">
           <option value="">Select Manager Name</option>
            @foreach ($manager as $manager1)
                <option value="{{ $manager1->id }}">{{ $manager1->manager_name }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
           <label class="stl">Sales Executive Name</label>
           <select class="select2-search__field" id="sales_rep_id" name="sales_rep_id">
           <option value="">Select Sales Executive</option>
            @foreach ($sales_rep_name as $sales_rep_name1)
                <option value="{{ $sales_rep_name1->id }}">{{ $sales_rep_name1->sales_ref_name }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Dealer Name<b class="mark_label_red">*</b></label>
            <input type="text" id="dealer_name" class="form-control">
            <div id="dealer_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Mobile No</label>
            <input type="text" id="mobile_no" maxlength="10" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">WhatsApp No<b class="mark_label_red">*</b></label>
            <input type="text" id="whatsapp_no" maxlength="10" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div id="whatsapp_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Address<b class="mark_label_red">*</b></label>
            <textarea id="address" class="form-control"></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Place<b class="mark_label_red"></b></label>
            <input type="text" id="place" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
           <label class="stl">State Name</label><br>
           <select class="form-control form-control-md state_name_options" style="width:250px;" id="state_id" name="state_id[]" multiple="" onchange="getDistricts()">
            @foreach ($state_name as $state)
                <option value="{{ $state->id }}">{{ $state->state_name }}</option>
            @endforeach
            </select>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">District Name</label><br>
            <select class="form-control form-control-md district_name_options" style="width:250px;" id="district_id" name="district_id[]" multiple="" onchange="getArea()">
            @foreach ($district_name as $district)
                <option value="{{ $district->id }}">{{ $district->district_name }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
        <label class="stl">Market Name</label><br>
        <select class="form-control form-control-md area_name_options" style="width:250px;" id="area_id" name="area_id[]" multiple="">
            @foreach ($area_name as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Pan No</label>
            <input type="text" id="pan_no" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">GST No</label>
            <input type="text" id="gst_no" class="form-control">
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Aadhar No</label>
            <input type="text" id="aadhar_no" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Driving Licence No</label>
            <input type="text" id="driving_licence" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Bank Name</label>
            <input type="text" id="bank_name" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Security Cheque</label>
            <input type="text" id="check_no" class="form-control">
        </div>
    </div>

</div>
<div class="row">
    {{-- Image Upload --}}
    <div class="col-md-3">
        <div class="form-group">
        <label for="image" class="stl">Image upload</label>
            <input type="file" class="form-control" id="image_name" name="image_name"  onchange="previewImage(event)">
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-1">
        <div class="form-group">
            <img id="image_preview" src="{{ asset('storage/default/default_image.png') }}" width="100" height="100" alt="Image Preview">
        </div>
    </div>
    {{-- Image Upload End --}}
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
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        width: 245px;
        min-height: 42px;
        line-height: 42px;
        padding-left: 20px;
        padding-right: 20px;
    }
    /* .black{
        color: #2c2b2b;
    } */
</style>
<script>
function previewImage(event) {
const file = event.target.files[0];
if (file) {
    const reader = new FileReader();
    reader.onload = function(event) {
        const imageUrl = event.target.result;
        const imagePreview = document.getElementById('image_preview');
        imagePreview.src = imageUrl;
    };
    reader.readAsDataURL(file);
    }
}

$(function () {
    $("#sales_rep_id").select2();
    $(".state_name_options").select2();
    $(".district_name_options").select2();
    $(".area_name_options").select2();
    $("#manager_id").select2();

});
</script>
