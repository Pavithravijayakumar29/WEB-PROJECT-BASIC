<form action="javascript:insert_update_row('',entry_date.value,shift_type.value,category_type.value,description.value)">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Attendance Entry<b class="mark_label_red">*</b></label>
                <input type="date" id="entry_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                <div id="entry_date_validate_div" class="mark_label_red"></div>
            </div>
        </div>
        <div class="col-md-6" id="hidden_div" style="display: none;">
            <div class="form-group">
                <label class="stl">Shift Type <b class="mark_label_red">*</b></label>
                <select id="shift_type" class="form-control">
                    <option value="0">Genral Shift</option>
                    <option value="1">Night Shift</option>
                </select>
                <div id="shift_type_validate_div" class="mark_label_red"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Attendance Category Type</label>
                <select id="category_type" class="form-control" onchange="category_type_id(this.value);">
                    <option value="">Select Category Type</option>
                    <option value="0">Market Manager Creation</option>
                    <option value="1">Sales Rep Creation</option>
                    {{-- <option value="2">Dealer Creation</option> --}}
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="description" class="stl">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"></textarea>
            </div>
        </div>
    </div>

<div id="sublist_div" style="width:100%;"></div>
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
