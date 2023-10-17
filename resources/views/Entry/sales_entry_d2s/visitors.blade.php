<style>
    .small, small {
    font-size: 103%;
    font-weight: 400;
}

.label {
    display: inline-block;
    padding: 8px 11px;
    border-radius: 7px;
}
</style>
<input type="hidden" id="_token" value="{{ csrf_token() }}" />
<form  action="javascript:visitors_insert_update_row('',d2s_id.value,order_date.value,order_no.value,visitor_name.value,sales_exec.value,mobile_no.value,description.value,address.value)" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Visited Date </label>
            <input type="date" id="order_date" class="form-control" value="<?php echo $order_date; ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">New Dealer Name</label>
            <input type="text" id="visitor_name" class="form-control">
            <input type="hidden" id="d2s_id" class="form-control" readonly value="<?php echo $d2s_id; ?>">
            <input type="hidden" id="order_no" class="form-control" placeholder="Order Number" readonly value="<?php echo $order_no; ?>">
            <input type="hidden" id="sales_exec" class="form-control" value="<?php echo $sales_exec; ?>">
            <div id="vistor_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Mobile No</label>
            <input type="text" id="mobile_no" maxlength="10" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Description</label>
            <textarea id="description" class="form-control"></textarea>
            <div id="description_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Address</label>
            <textarea id="address" class="form-control"></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
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
            <img id="image_preview" src="{{ asset('storage/default/default_image.png') }}" width="75" height="75" alt="Image Preview">
        </div>
    </div>
    <div class="col-md-1"></div>
    {{-- Image Upload End --}}
</div>
<div class="row">
    <div class="col-md-6">
        <span class="label info small" onclick="open_model('Secondary Sales (D -> S)','<?php echo $d2s_id; ?>');" style="cursor: pointer"><i class="fas fa-chevron-left"></i>  Go To Entry</span>
    </div>
    <div class="col-md-6 text-right">
        <button class="btn btn-icon icon-left btn-success" type="submit">
            <span class="fas fa-check"></span>Submit
        </button>
    </div>
</div>
<div id="sublist_div" style="width:100%;"></div>
</form>
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
</script>
