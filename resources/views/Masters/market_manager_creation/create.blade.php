<form action="javascript:insert_update_row('',manager_no.value,manager_name.value,address.value,contact_no.value,whatsapp_no.value,email_address.value,status1.value)" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Manager Id</label>
            <input type="text" id="manager_no" value="<?php echo $newInvoiceNumber; ?>" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Manager Name<b class="mark_label_red">*</b></label>
            <input type="text" id="manager_name" class="form-control">
            <div id="manager_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Gender</label><br>
            <input type="radio" id="gender1" name="gender" value="Male" class="gender-radio male-radio" />
            <label for="gender1" class="radio-label">
                <i class="fa fa-male"></i> Male
            </label>&emsp;&emsp;
            <input type="radio" id="gender2" name="gender" value="Female" class="gender-radio female-radio" />
            <label for="gender2" class="radio-label">
                <i class="fa fa-female"></i> Female
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Addresss<b class="mark_label_red">*</b></label>
            <textarea id="address" class="form-control"></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Contact No</label>
            <input type="text" id="contact_no" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">WhatsApp No<b class="mark_label_red">*</b></label>
            <input type="text" id="whatsapp_no" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
            <div id="whatsapp_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Email Id</label>
            <input type="text" id="email_address" class="form-control">
        </div>
    </div>
    {{-- Image Upload --}}
    <div class="col-md-4">
        <div class="form-group">
        <label for="image" class="stl">Image upload</label>
            <input type="file" class="form-control" id="image_name" name="image_name"  onchange="previewImage(event)">
        </div>
    </div>
    <div class="col-md-2" >
        <div class="form-group">
            <img id="image_preview" src="{{ asset('storage/employee_images/default_image.png') }}" width="150" height="150" alt="Image Preview">
        </div>
    </div>
    {{-- Image Upload End --}}
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">Status</label>
            <select id="status1" class="form-control">
            <option value="0">Active</option>
            <option value="1">In Active</option>
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
            <span class="fas fa-check"></span>Submit
        </button>
    </div>
</div>
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
