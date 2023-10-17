<form action="javascript:insert_update_row('',employee_no.value,employee_name.value,address.value,contact_no.value,phone_no.value,email_address.value,aadhar_no.value,designation_id.value,staff_head_id.value,dealer_id.value,salary.value,incentive.value,status1.value)" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Employee Id<b class="mark_label_red">*</b></label>
            <input type="text" id="employee_no" value="<?php echo $newInvoiceNumber; ?>" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Employee Name<b class="mark_label_red">*</b></label>
            <input type="text" id="employee_name" class="form-control">
            <div id="employee_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Gender</label><br>
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
            <label>Addresss<b class="mark_label_red">*</b></label>
            <textarea id="address" class="form-control"></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Contact No<b class="mark_label_red">*</b></label>
            <input type="text" id="contact_no" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
            <div id="contact_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Phone No</label>
            <input type="text" id="phone_no" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Email Id</label>
            <input type="text" id="email_address" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Aadhar No<b class="mark_label_red">*</b></label>
            <input type="text" id="aadhar_no" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div id="aadhar_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Designation Name<b class="mark_label_red">*</b></label>
            <select class="select2-search__field" id="designation_id" name="designation_id">
                <option value="">--Select Designation Name--</option>
                @foreach ($designation_name as $designation)
                    <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                @endforeach
            </select>
            <div id="designation_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Staff Head<b class="mark_label_red">*</b></label>
            <select class="select2-search__field" id="staff_head_id" name="staff_head_id">
                <option value="">--Select Head Name--</option>
                @foreach ($employee_name as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                @endforeach
            </select>
            <div id="staff_head_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Dealer Assign To<b class="mark_label_red">*</b></label>
            <select class="select2-search__field" id="dealer_id" name="dealer_id">
                <option value="">--Select Dealer Name--</option>
                @foreach ($dealer_name as $dealer)
                    <option value="{{ $dealer->id }}">{{ $dealer->dealer_name }}</option>
                @endforeach
            </select>
            <div id="dealer_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Salary<b class="mark_label_red">*</b></label>
            <input type="text" id="salary" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div id="salary_validate_div" class="mark_label_red"></div>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Incentive</label>
            <input type="text" id="incentive" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </select>
        </div>
    </div>
{{-- Image Upload --}}
<div class="col-md-4">
    <div class="form-group">
       <label for="image">Image upload</label>
        <input type="file" class="form-control" id="image_name" name="image_name"  onchange="previewImage(event)">
    </div>
</div>

<div class="col-md-2" >
    <div class="form-group">
        <img id="image_preview" src="{{ asset('storage/employee_images/default_image.png') }}" width="150" height="150" alt="Image Preview">
    </div>
</div>
{{-- Image Upload End --}}

    <div class="col-md-4">
        <div class="form-group">
            <label>Status</label>
            <select id="status1" class="form-control">
            <option value="1">Active</option>
            <option value="0">In Active</option>
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
$(document).ready(function() {
    $('#designation_id').select2();
    $('#dealer_id').select2();
    $('#staff_head_id').select2();
});

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
.select2-container--default .select2-selection--single .select2-selection__rendered{
    width: 350px;
    min-height: 42px;
    line-height: 42px;
    padding-left: 20px;
    padding-right: 20px;
}
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
