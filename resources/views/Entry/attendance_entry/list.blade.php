
<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
        <thead>
            <tr class="stl">
                <th>Sno</th>
                <th>Entry Date</th>
                <th class="text-center">Category Type</th>
                <th class="text-center" id="hidden_div" style="display: none;">Shift Type</th>
                <th class="text-center">Present</th>
                <th class="text-center">Absent</th>
                <th class="text-center">View</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
    $i1=1;
    foreach($attendance_entry as $attendance_entry1)
    { ?>
            <tr>
                <td class="stl"><?php echo $i1;
                $i1++; ?></td>
                <td><?php echo $attendance_entry1['entry_date']; ?></td>

                <td align="center" class="stl">
                    <?php if($attendance_entry1['category_type']=="0"){ ?>Market Manager
                 </div> <?php }else if($attendance_entry1['category_type']=="1"){ ?>Sales representative</div><?php } else if($attendance_entry1['category_type']=="2"){ ?>Dealers</div><?php } ?>
                 </td>

                <td align="center" class="stl" id="hidden_div" style="display: none;">
                <?php if($attendance_entry1['shift_type']!="1"){ ?><div class="badge badge-success">Genral Shift</div><?php }else{ ?><div
                class="badge badge-warning">Night Shift</div><?php } ?>
                 </td>

               <td align="center" class="stl">
                <?php
                $attendance_status_array = explode(',', $attendance_entry1['attendance_status']);
                $attendance_status_count_present = 0;

                foreach ($attendance_status_array as $status) {
                    if ($status == '1') {
                        $attendance_status_count_present++;
                    }
                }

                echo '<span style="color: green; font-weight: bold;">' . $attendance_status_count_present . ' </span>  ';

                    ?>
                </td>

                <td align="center" class="stl">
                    <?php
                    $attendance_status_array = explode(',', $attendance_entry1['attendance_status']);

                    $attendance_status_count_absent = 0;

                    foreach ($attendance_status_array as $status) {
                        if ($status == '0') {
                            $attendance_status_count_absent++;
                        }
                    }

                    echo '<span style="color: red; font-weight: bold;">' . $attendance_status_count_absent . ' </span>';
                    ?>
                </td>

                <td align='center' class="stl">
                    <img align="center" onclick="open_print('View Attendance Entry','<?php echo $attendance_entry1['id']; ?>','<?php echo $attendance_entry1['category_type']; ?>')" src="{{ asset('storage/attandance_view/img23.png') }}" width="45" height="45" border="0" title="VIEW">
                </td>

                <td align="center" class="stl">
                    <a class="btn btn-icon icon-left btn-info hover-gradient" data-toggle="tooltip" style="cursor: pointer"
                        title="Edit" onclick="open_model('Update Attendance Entry','<?php echo $attendance_entry1['id']; ?>')"><i
                            class="far fa-edit"></i>Edit</a>
                    <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete"
                        onclick="delete_row('<?php echo $attendance_entry1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
                </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
                </div>
<script>
    $(function() {
        $('#tableExport').DataTable({
            "dom": 'lBfrtip',
            "buttons": [
                'excel', 'pdf', 'print'
            ]
        });
    });
</script>
