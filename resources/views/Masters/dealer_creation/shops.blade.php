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
select{
  border:none;
  padding: 10px 20px;
  border-radius:5px;
}

select:focus{
  outline:none;
}
</style>
<form  action="javascript:shop_insert_update_row('',shop_type_id.value,shop_name.value,beats_id.value,dealer_id.value,mobile_no.value,whatsapp_no.value,address.value,gst_no.value,language.value)" enctype="multipart/form-data">

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="shop_type_id" class="stl">Shops Type</label>
            <select class="form-control select2" id="shop_type_id" width="100%">
            <option value="">Select</option>
            <?php foreach($shops_type as $shops_type1){ ?>
            <option value="<?php echo $shops_type1['id']; ?>"><?php echo $shops_type1['shops_type']; ?></option>
            <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Shop Name<b class="mark_label_red">*</b></label>
            <input type="text" id="shop_name" class="form-control">
            <input type="hidden" id="beats_id" class="form-control" value="<?php echo $beats_id; ?>">
            <input type="hidden" id="dealer_id" class="form-control" value="<?php echo $dealer_id; ?>">
            <div id="shop_name_validate_div" class="mark_label_red"></div>
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
            <label class="stl">WhatsApp No</label>
            <input type="text" id="whatsapp_no" maxlength="10" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div id="whatsapp_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
                <label for="" class="stl">Select Day</label>
                <select class="form-control select2" name="language" id="language">
                    <option value="0">Select</option>
                    <option value="Sunday">Sunday</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wenesday">Wenesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Address</label>
            <textarea id="address" class="form-control"></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">GST No</label>
            <input type="text" id="gst_no" class="form-control">
        </div>
    </div>
    {{-- Image Upload --}}
    <div class="col-md-3">
        <div class="form-group">
        <label for="image" class="stl">Image upload</label>
            <input type="file" class="form-control" id="image_name" name="image_name"  onchange="previewImage(event)">
        </div>
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
        <span class="label info small" onclick="open_beats('Beats Creation',dealer_id.value);" style="cursor: pointer"><i class="fas fa-chevron-left"></i>  Go To Beat</span>
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
