
<script>
    function updateSelectAllValue(checkbox) {
        if (checkbox.checked) {
            checkbox.value = 1;
        } else {
            checkbox.value = 0;
        }
    }

    function perm1_function(checkbox, rowIndex) {
        var checked = checkbox.checked;
        document.querySelectorAll('.customcheckbox_div_checkbox').forEach(function(checkbox, index) {
            if (index === rowIndex) return;
            checkbox.checked = checked;
            var attendanceStatusSelect = document.getElementById('attendance_status_' + (index - 1));
            if (attendanceStatusSelect) {
                attendanceStatusSelect.value = checked ? "1" : "0";
            }
            // else {
            //     console.error("Attendance Status select element not found for row index:", index - 1);
            // }
        });
    }
</script>

<div class="row">
    <div style="width:100%;">
        <div class="customcheckbox_div" style="float:left;">
            &nbsp;&nbsp;&nbsp;Checked All&nbsp;<input class="customcheckbox_div_checkbox" id="checkbox" type="checkbox"
            onchange="perm1_function(this, -1); updateSelectAllValue(this.value);">

        </div>
    </div>
    <div class="col-md-12">
        <table class="table table-sm table-hover" id="rights_tableExport" style="width:100%;">
        <thead>
                <tr>
                    <th>Sno</th>
                    <th class="text-center">Check</th>
                    <th class="text-center">Attendance Name</th>
                    <th class="text-center">Day Time</th>
                    <th class="text-center">Attendance Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i1 = 1;
                foreach ($attendance_category_type as $attendance_category_type1) {
                ?>
                <tr>
                    <td><?php echo $i1++; ?></td>
                    <td align="center">
                        <input class="customcheckbox_div_checkbox" type="checkbox"
                            onchange="perm_function(this, <?php echo $i1 - 2; ?>)" />
                    </td>
                    {{-- <td align="center">
                        <?php echo $attendance_category_type1['sales_ref_name']; ?>
                        <input type="hidden" class="employee_name" value="<?php echo $attendance_category_type1['id']; ?>" />
                    </td> --}}

                    <td align="center">
                        <?php if($category_id==0){
                            echo $attendance_category_type1['manager_name']; ?>
                            <input type="hidden" class="employee_name" value="<?php echo $attendance_category_type1['id']; ?>" />
                        <?php } else if($category_id==1){
                            echo $attendance_category_type1['sales_ref_name']; ?>
                            <input type="hidden" class="employee_name" value="<?php echo $attendance_category_type1['id']; ?>" />
                        <?php } else if($category_id==2){
                            echo $attendance_category_type1['dealer_name']; ?>
                            <input type="hidden" class="employee_name" value="<?php echo $attendance_category_type1['id']; ?>" />
                        <?php } ?>
                    </td>

                    <td align="center">
                        <select class="form-control shift_type1">
                            <option value="0">Full Day</option>
                            <option value="1">Half Day</option>
                        </select>
                    </td>
                    <td align="center">
                        <select class="form-control attendance_status" id="attendance_status_<?php echo $i1 - 2; ?>" disabled>
                            <option value="0">Absent</option>
                            <option value="1">Present</option>
                        </select>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function perm_function(checkbox, rowIndex) {
        var checked = checkbox.checked;
        var row = checkbox.closest('tr');
        var checkboxesInRow = row.querySelectorAll('.customcheckbox_div_checkbox');
        checkboxesInRow.forEach(function(checkbox) {
            checkbox.checked = checked;
        });
        var attendanceStatusSelect = document.getElementById('attendance_status_' + rowIndex);
        attendanceStatusSelect.value = checked ? "1" : "0";
    }

    var rights_tableExport_rows=null;
    // $(function () {
    //     $(".user_type_options").select2();
    //     rights_tableExport_rows=$('#rights_tableExport').DataTable({"dom": 'frtip',"pageLength": 5});
    // });
    </script>
