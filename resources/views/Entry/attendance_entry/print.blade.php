<div class="row">
    <div class="col-md-12">
        <table class="table table-sm table-hover" id="rights_tableExport" style="width:100%;">
        <thead>
            <tr>
                <th>Sno</th>
                {{-- <th class="text-center">Check</th> --}}
                <th class="text-center">Attendances Name</th>
                <th class="text-center">Day Time</th>
                <th class="text-center">Attendance Status</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $i1 = 1;
            $attendanceStatus = explode(',', $attendance_entry['attendance_status']);
            $attendanceStatus1 = explode(',', $attendance_entry['shift_type1']);
            foreach ($attendance_category_type as $attendance_category_type1) {
            ?>
                <tr>
                    <td><?php echo $i1++; ?></td>
                    {{-- <td align="center">
                        <input class="customcheckbox_div_checkbox" type="checkbox" onchange="perm_function(this, <?php echo $i1 - 2; ?>)"  <?php echo ($attendanceStatus[$i1-2] == "1" ? "checked" : ""); ?> disabled/>
                    </td> --}}

                    <td align="center">
                        <?php
                        $employeeId = $attendance_category_type1['id'];
                        if ($category_id == 0) {
                            echo $attendance_category_type1['manager_name'];
                        } else if ($category_id == 1) {
                            echo $attendance_category_type1['sales_ref_name'];
                        } else if ($category_id == 2) {
                            echo $attendance_category_type1['dealer_name'];
                        }
                        ?>
                        <input type="hidden" class="employee_name" value="<?php echo $employeeId; ?>" />
                    </td>

                    <td align="center">

                            <?php
                            $employeeId1 = $attendance_category_type1['id'];
                            if ($attendanceStatus1[$i1-2] == 0) {
                                echo  "Full Day";
                            } else if ($attendanceStatus1[$i1-2] == 1) {
                                echo 'Half Day';
                            }
                            ?>
                            <input type="hidden" class="shift_type1" value="<?php echo $employeeId1; ?>" />

                            {{-- <option value="0" <?php echo ($attendanceStatus1[$i1-2]=="0"?" selected":""); ?>>Full Day</option>
                            <option value="1" <?php echo ($attendanceStatus1[$i1-2]=="1"?" selected":""); ?>>Half Day</option>
                        </select> --}}
                    </td>
                    <td align="center">
                        <?php
                        $attendanceStatusValue = $attendanceStatus[$i1 - 2];
                        $employeeId2 = $attendance_category_type1['id'];

                        if ($attendanceStatusValue == 0) {
                            echo '<div class="badge badge-danger">ABSENT</div>';
                        } else if ($attendanceStatusValue == 1) {
                            echo '<div class="badge badge-success">PRESENT</div>';
                        }
                        ?>
                        <input type="hidden" class="shift_type1" value="<?php echo $employeeId2; ?>" />
                    </td>

                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>

</div>
{{-- <script>
    var rights_tableExport_rows=null;
    $(function () {
        $(".user_type_options").select2();
        rights_tableExport_rows=$('#rights_tableExport').DataTable({"dom": 'frtip',"pageLength": 5});
    });
    </script> --}}

