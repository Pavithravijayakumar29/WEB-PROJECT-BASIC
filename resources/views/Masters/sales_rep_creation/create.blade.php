<form action="javascript:insert_update_row('',manager_id.value, sales_ref_name.value, mobile_no.value, phone_no.value, pin_gst_no.value, aadhar_no.value, driving_licence.value, address.value, state_id.value, district_id.value)" enctype="multipart/form-data">

    <div class="row">


    <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="black">Market Manager Name <b class="mark_label_red">*</b></label>
                <select class="select2-search__field" id="manager_id"  >
                <option value="">--Select Manager Name--</option>
                @foreach ($market_manager_creations as $market_manager_creation)
                <option value="{{ $market_manager_creation->id }}">{{ $market_manager_creation->manager_name }}</option>
                @endforeach
            </select>
            <div id="manager_id_validate_div" class="mark_label_red"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="name" class="black">Sales Rep Name <b class="mark_label_red">*</b></label>
                <input type="text" class="form-control" id="sales_ref_name" >
                <div id="sales_ref_name_validate_div" class="mark_label_red"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                 <label for="mobile_number" class="black">Mobile Number<b class="mark_label_red">*</b></label>
                <input type="text" class="form-control" id="mobile_no" maxlength="10">
                <div id="mobile_no_validate_div" class="mark_label_red"></div>
            </div>
        </div>
       
    
       
    <div class="col-md-4">
            <div class="form-group">
                 <label for="phone_number" class="black">WhatsApp Number</label>
                <input type="text" class="form-control" id="phone_no" maxlength="10">
            </div>
        </div>



        <div class="col-md-4">
            <div class="form-group">
                
            <label for="address" class="black">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                <div id="address_validate_div" class="mark_label_red"></div>
                
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
               <label class="black">State Name</label>
               <select class="select2-search__field" id="state_id" onchange="getDistricts()" >
                <option value="">--Select State--</option>
                @foreach ($state_name as $state)
                <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                @endforeach
            </select>
            <div id="state_id_validate_div" class="mark_label_red"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="black">District Name</label>
                <select class="select2-search__field" id="district_id" >
                    <option value="">--Select District--</option>
                </select>
                <div id="district_id1_validate_div" class="mark_label_red"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Aadhar No</label>
                <input type="text" id="aadhar_no" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Driving Licence No</label>
                <input type="text" id="driving_licence" class="form-control">
            </div>
        </div>
   
        <div class="col-md-4">
            <div class="form-group">

            <label for="pan_gst_number" class="black">PAN No</label>
                <input type="text" class="form-control" id="pin_gst_no">



            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
               <label for="phone_number" class="black">Image upload</label>
                <input type="file" class="form-control" id="image_name" name="image_name"  onchange="previewImage(event)">
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2" >
            <div class="form-group">
                <img id="image_preview" src="{{ asset('storage/default/default_image.png') }}" width="100" height="100" alt="Image Preview">
            </div>
        </div>
        <div class="col-md-1"></div>
    
        
    
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
            $('#manager_id').select2();
            $('#state_id').select2();
            $('#district_id').select2();
          
        });
    </script>
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            width: 350px;
            min-height: 42px;
            line-height: 42px;
            padding-left: 20px;
            padding-right: 20px;
        }


        #image_preview {
            float: right;
        }
        .form-group {

            margin-bottom: 20px;
        }


        <style>
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        width: 350px;
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
    </script>


