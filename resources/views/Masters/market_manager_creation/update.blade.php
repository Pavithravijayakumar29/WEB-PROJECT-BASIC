<form action="javascript:insert_update_row('<?php echo $market_manager_creation['id']; ?>',manager_no.value,manager_name.value,address.value,contact_no.value,whatsapp_no.value,email_address.value,status1.value)">
<div class="row" enctype="multipart/form-data">
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Manager Id</label>
            <input type="text" id="manager_no" class="form-control" value="<?php echo $market_manager_creation['manager_no']; ?>" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Manager Name<b class="mark_label_red">*</b></label>
            <input type="text" id="manager_name" class="form-control" value="<?php echo $market_manager_creation['manager_name']; ?>">
            <div id="manager_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Gender</label><br>
                <input type="radio" id="gender1" name="gender" class="gender-radio male-radio" value="Male" <?php if($market_manager_creation['gender']=="Male"){echo "checked";} ?>/>
                <label for="gender1" class="radio-label">
                <i class="fa fa-male"></i> Male
            </label>&emsp;&emsp;
                <input type="radio" id="gender2" name="gender" class="gender-radio female-radio" value="Female" <?php if($market_manager_creation['gender']=="Female"){echo "checked";} ?>/>
            <label for="gender2" class="radio-label">
                <i class="fa fa-female"></i> Female
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Address<b class="mark_label_red">*</b></label>
            <textarea id="address" class="form-control"><?php echo $market_manager_creation['address']; ?></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Contact No</label>
            <input type="text" id="contact_no" class="form-control" value="<?php echo $market_manager_creation['contact_no']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">WhatsApp No<b class="mark_label_red">*</b></label>
            <input type="text" id="whatsapp_no" class="form-control" value="<?php echo $market_manager_creation['whatsapp_no']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
            <div id="whatsapp_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Email-Id</label>
            <input type="text" id="email_address" class="form-control" value="<?php echo $market_manager_creation['email_address']; ?>">
        </div>
    </div>
    {{-- Image Upload --}}
    <div class="col-md-4">
        <div class="form-group">
             <label for="phone_number" class="stl">Image upload</label>
            <input type="file" class="form-control" id="image_name" name="image_name" onchange="previewImage(event)">
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-2">
        <div class="form-group">
            <img id="image_preview" src="{{ $market_manager_creation['image_name'] != '' ? asset('storage/employee_images/'.$market_manager_creation['image_name']) : asset('storage/employee_images/default_image.png') }}" width="100" height="100" alt="Image Preview">
        </div>
    </div>
    {{-- End --}}
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Status</label>
            <select id="status1" class="form-control">
            <option value="1" <?php if($market_manager_creation['status1']=="1"){echo " selected";} ?>>In Active</option>
            <option value="0" <?php if($market_manager_creation['status1']=="0"){echo " selected";} ?>>Active</option>
            </select>
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
            imagePreview.setAttribute('src', "{{ asset('storage/employee_images/default_image.png') }}");
        }
    }
</script>
<style>
.male-radio, .female-radio {
    display: none; /* Hide the default radio buttons */
}

/* Custom styles for the radio buttons */
.radio-label {
    display: inline-block;
    cursor: pointer;
    padding-left: 30px; /* Increase this value to adjust the distance between the icon and text */
    position: relative;
}

/* Style for the male radio button */
.male-radio + .radio-label:before {
    content: "";
    display: inline-block;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 2px solid rgb(63, 49, 49);
    position: absolute;
    left: 0;
    top: 3px; /* Adjust this value to vertically center the icon */
}

/* Style for the female radio button */
.female-radio + .radio-label:before {
    content: "";
    display: inline-block;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 2px solid rgb(63, 49, 49);
    position: absolute;
    left: 0;
    top: 3px; /* Adjust this value to vertically center the icon */
}

/* Style for the selected radio button */
.male-radio:checked + .radio-label:before {
    background-color: rgb(14, 224, 102);
}

.female-radio:checked + .radio-label:before {
    background-color: rgb(240 23 149);
}
</style>
