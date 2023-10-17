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
<form  action="javascript:shop_insert_update_row('<?php echo $shop_creation['id']; ?>',shop_type_id.value,shop_name.value,beats_id.value,dealer_id.value,mobile_no.value,whatsapp_no.value,address.value,gst_no.value,language.value)" enctype="multipart/form-data">

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Shops Type</label>
            <select class="form-control select2" id="shop_type_id" width="100%" >
            <option value="">Select</option>
                <?php
                $shop_type_id=$shop_creation['shop_type_id'];
                foreach($shops_type as $shops_type1){ ?>
                <option value="<?php echo $shops_type1['id']; ?>" <?php if($shop_type_id==$shops_type1['id']){echo " selected";} ?>><?php echo $shops_type1['shops_type']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Shop Name<b class="mark_label_red">*</b></label>
            <input type="text" id="shop_name" class="form-control" value="<?php echo $shop_creation['shop_name']; ?>">
            <input type="hidden" id="beats_id" class="form-control" value="<?php echo $shop_creation['beats_id']; ?>">
            <input type="hidden" id="dealer_id" class="form-control" value="<?php echo $shop_creation['dealer_id']; ?>">
            <div id="shop_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Mobile No</label>
            <input type="text" id="mobile_no" value="<?php echo $shop_creation['mobile_no']; ?>" maxlength="10" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">WhatsApp No<b class="mark_label_red">*</b></label>
            <input type="text" id="whatsapp_no" value="<?php echo $shop_creation['whatsapp_no']; ?>" maxlength="10" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div id="whatsapp_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">Address<b class="mark_label_red">*</b></label>
            <textarea id="address" class="form-control"><?php echo $shop_creation['address']; ?></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="stl">GST No</label>
            <input type="text" id="gst_no" value="<?php echo $shop_creation['gst_no']; ?>" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
                <label for="" class="stl">Select Day</label>
                <select class="form-control select2" name="language" id="language">
                    <option value="0">Select</option>
                    <option value="Sunday" <?php if($shop_creation['language']=="Sunday"){echo " selected";} ?>>Sunday</option>
                    <option value="Monday" <?php if($shop_creation['language']=="Monday"){echo " selected";} ?>>Monday</option>
                    <option value="Tuesday" <?php if($shop_creation['language']=="Tuesday"){echo " selected";} ?>>Tuesday</option>
                    <option value="Wednesday" <?php if($shop_creation['language']=="Wednesday"){echo " selected";} ?>>Wednesday</option>
                    <option value="Thursday" <?php if($shop_creation['language']=="Thursday"){echo " selected";} ?>>Thursday</option>
                    <option value="Friday" <?php if($shop_creation['language']=="Friday"){echo " selected";} ?>>Friday</option>
                    <option value="Saturday" <?php if($shop_creation['language']=="Saturday"){echo " selected";} ?>>Saturday</option>
                </select>
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
        <img id="image_preview" src="{{ $shop_creation['image_name'] != '' ? asset('storage/shop_img/' . $shop_creation['image_name']) : asset('storage/default/default_image.png') }}" width="75" height="75" alt="Image Preview">
        </div>
    <div class="col-md-1"></div>
    </div>
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
</div>
<div id="sublist_div" style="width:100%;"></div>
</form>
<script>
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
