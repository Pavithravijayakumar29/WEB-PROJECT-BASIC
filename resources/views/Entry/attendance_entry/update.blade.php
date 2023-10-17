<form
    action="javascript:insert_update_row('<?php echo $attendance_entry['id']; ?>',entry_date.value,shift_type.value,category_type.value,description.value)">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Attendance Entry<b class="mark_label_red">*</b></label>
                <input type="date" id="entry_date" class="form-control" value="<?php echo $attendance_entry['entry_date']; ?>">
                <div id="entry_date_validate_div" class="mark_label_red"></div>
            </div>
        </div>
        <div class="col-md-6" id="hidden_div" style="display: none;">
            <div class="form-group">
                <label class="stl">Shift Type <b class="mark_label_red">*</b></label>
                <select id="shift_type" class="form-control" disabled>
                    <option value="0" <?php if ($attendance_entry['shift_type'] != '1') {
                        echo ' selected';
                    } ?>>Genral Shift</option>
                    <option value="1"<?php if ($attendance_entry['shift_type'] == '1') {
                        echo ' selected';
                    } ?>>Night Shift</option>
                </select>
                <div id="shift_type_validate_div" class="mark_label_red"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Attendance Category Type</label>
                <select id="category_type" class="form-control" onchange="category_type_id1(this.value);"disabled>
                    <option value="" <?php if ($attendance_entry['category_type'] == '') {
                        echo ' selected';
                    } ?>>Select Category Type</option>
                    <option value="0" <?php if ($attendance_entry['category_type'] == '0') {
                        echo ' selected';
                    } ?>>Market Manager Creation</option>
                    <option value="1" <?php if ($attendance_entry['category_type'] == '1') {
                        echo ' selected';
                    } ?>>Sales Rep Creation</option>
                    {{-- <option value="2" <?php if ($attendance_entry['category_type'] == '2') {
                        echo ' selected';
                    } ?>>Dealer Creation</option> --}}
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="description" class="stl">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"><?php echo $attendance_entry['description']; ?></textarea>
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
                <span class="fas fa-check"></span>Update
            </button>
        </div>
    </div>
</form>
<script>
$( document ).ready(function() {
    category_type_id1('<?php echo $attendance_entry['id']; ?>','<?php if ($attendance_entry['category_type'] == '0') { echo "0"; } else if ($attendance_entry['category_type'] == '1') { echo "1"; } else if ($attendance_entry['category_type'] == '2') { echo "2"; } ?>')
});
</script>
