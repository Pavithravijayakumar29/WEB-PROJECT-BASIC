<form action="javascript:insert_update_row('',category_id.value,group_id.value,item_name.value,item_liters_type_id.value,item_properties_type_id.value,distributor_rate.value,description.value,hsn_code.value,piece.value,short_code.value)">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="stl">Category Name</label><b class="mark_label_red">*</b>
                <select class="form-control select2" id="category_id" width="100%" onchange='find_group()'>
                    <option value='' selected disbled>Select Category</option>
                    <?php foreach($category_creation as $category_creation1){ ?>
                    <option value="<?php echo $category_creation1['id']; ?>"><?php echo $category_creation1['category_name']; ?></option>
                    <?php } ?>
                </select>
                <div id="category_id_validate_div" style="color:red;"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="stl">Group Name</label><b class="mark_label_red">*</b>
                <select class="form-control select2" id="group_id" onchange="find_hsn()"  width="100%">
                <option value='' selected disbled>Select Group Name</option>
                </select>
                <div id="group_id_validate_div" style="color:red;"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <label class="stl">HSN Code</label><b class="mark_label_red">*</b>
                <input type='text' id='hsn_code' class="form-control" style="float: right;" readonly>
            </div>
        </div>
        {{-- <div class="col-md-4">
            <div class="form-group">
                <label>HSN Code</label><b class="mark_label_red">*</b>
                <input type="text" id="item_code" class="form-control" readonly>
                <div id="item_code_validate_div" style="color:red;"></div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="stl">Item Name</label><b class="mark_label_red">*</b>
                <input type="text" id="item_name" class="form-control" placeholder="Enter the Item Name">
                <div id="item_name_validate_div" style="color:red;"></div>
            </div>
        </div>
          <div class="col-md-4">
            <div class="form-group">
                <label class="stl">Item Short Code</label><b class="mark_label_red">*</b>
                <input type="text" id="short_code" class="form-control" placeholder="Enter Item Short Code">
                <div id="short_code_validate_div" style="color:red;"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="stl">UOM</label><b class="mark_label_red">*</b>
                <select class="select2-search__field" id="item_liters_type_id" width="100%">
                    <option value='' selected disbled>Select</option>
                    <?php foreach($item_liters_type as $item_liters_type1){ ?>
                    <option value="<?php echo $item_liters_type1['id']; ?>"><?php echo $item_liters_type1['item_liters_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_liters_type_id_validate_div" style="color:red;"></div>
            </div>
        </div>

    </div>

    <div class="row">
          <div class="col-md-4">
            <div class="form-group">
                <label class="stl">Piece</label>
                <input type='number' id='piece'  class="form-control" placeholder="Enter the Piece">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="stl">Packing Type</label><b class="mark_label_red">*</b>
                <select class="select2-search__field" id="item_properties_type_id" width="100%">
                    <option value='' selected disbled>Select Properties</option>
                    <?php foreach($item_properties_type as $item_properties_type1){ ?>
                    <option value="<?php echo $item_properties_type1['id']; ?>"><?php echo $item_properties_type1['item_properties_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_properties_type_id_validate_div" style="color:red;"></div>
            </div>
        </div>

       <div class="col-md-4">
            <div class="form-group">
                <label class="stl">Rate</label><b class="mark_label_red">*</b>
                <input type="number" id="distributor_rate" class="form-control" placeholder="Enter the Rate" >
                <div id="distributor_rate_validate_div" style="color:red;"></div>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="stl">Description</label>
                <textarea id="description" class="form-control"></textarea>
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
    <style>
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        width: 350px;
        min-height: 42px;
        line-height: 42px;
        padding-left: 20px;
        padding-right: 20px;
    }
    </style>
    <script>
    $(document).ready(function() {
        $('#item_liters_type_id').select2();
        $('#item_properties_type_id').select2();
        $('#tax_id').select2();
    });
    </script>
