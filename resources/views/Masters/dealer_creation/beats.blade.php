<style>
.button2 {
  text-align: center;
  /* text-transform: uppercase; */
  cursor: pointer;
  font-size: 15px;
  position: relative;
  background-color: #3cbb43;
  border: none;
  color: #fff;
  padding: 6px;
  width: 79px;
  text-align: center;
  transition-duration: 0.4s;
  overflow: hidden;
  border-radius: 10px;
}

.rounded-count {
    border-radius: 70%;
    }
select{
  border:none;
  padding: 10px 20px;
  border-radius:5px;
}
select:focus{
  outline:none;
}
.parent {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.parent button {
  background-color: #48abe0;
  color: white;
  border: none;
  padding: 5px;
  font-size: 15px;
  height: 35px;
  width: 38px;
  box-shadow: 0 2px 4px rgb(239, 240, 240);
  cursor: pointer;
  transition: all 0.2s ease;
}

.parent button:active {
    border: none;
  background-color: #48abe0;
  box-shadow: 0 0 2px rgb(157, 249, 249);
  transform: translateY(2px);
}

.parent button:not(:first-child) {
  margin-top: 10px;
}
</style>

<input type="hidden" id="dealer_id" class="form-control" value="<?php echo $dealer_id; ?>">
<div class="row">
    <div class="col-md-12">
        <table class="table table-sm table-hover" id="rights_tableExport" style="width:100%;">
            <thead>
                <tr align="center" class="stl">
                    <th>Sno</th>
                    <th>Beats Name</th>
                    <th>Shop Count</th>
                    <th>Planned Day</th>
                    <th>Shop Creation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i1 = 1;
                $cnt_index = 0;

                foreach ($area_names as $area_names_1) { ?>
                    <tr align="center">
                        <td class="stl"><?php echo $i1; $i1++; ?></td>
                        <td class="stl"><?php echo $area_names_1['area_name']; ?></td>

                        <td class="stl"><div class="parent"><button class="rounded-count"><?php echo isset($cnt_values[$cnt_index]) ? $cnt_values[$cnt_index] : 0; ?></button></div></td>
                        <td class="stl">
                            <?php echo isset($language_values[$cnt_index]) ? $language_values[$cnt_index] : 'Not Selected'; ?>
                        </td>
                        <td class="stl">
                            <button class="button2" onclick="open_shops('Shops Creation','<?php echo $area_names_1['id']; ?>', dealer_id.value)">
                                <i class="fas fa-plus"></i> Create
                            </button>

                        </td>
                    </tr>
                    <?php
                    $cnt_index++;
                } ?>
            </tbody>
        </table>

</div>
</div>
<script>
var rights_tableExport_rows=null;
$(function () {
    $(".user_type_options").select2();
    rights_tableExport_rows=$('#rights_tableExport').DataTable({"dom": 'frtip',"pageLength": 5});
});
</script>
