<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr align="centre" class="stl">
        <th>Sno</th>
        <th>Category Name</th>
        {{-- <th>Group Name</th> --}}
        <th>Item Name</th>
        <th>HSN Code</th>

        <th>Rate</th>
        <th>Status</th>
        {{-- <th>Sub Dealer Rate</th> --}}
        {{-- <th>Description</th> --}}

        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <th class="text-center">Action</th>
            <?php } ?>
    </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($item_creation) || is_object($item_creation)) {
            $i1 = 1;
            foreach ($item_creation as $item_creation1) {
                ?>
                <tr>
                    <td class="stl"><?php echo $i1;
                    $i1++; ?></td>
                    <td class="stl"><?php echo is_array($item_creation1) ? $item_creation1['category_name'] :  ucfirst($item_creation1-> category_name); ?></td>


                    <td class="stl"><?php echo is_array($item_creation1) ? $item_creation1['item_name'] :  ucfirst($item_creation1-> item_name); ?></td>

                    <td class="stl"><?php echo is_array($item_creation1) ? $item_creation1['hsn_code'] : ucfirst($item_creation1-> hsn_code); ?></td>
                    <td class="stl"><?php echo is_array($item_creation1) ? $item_creation1['distributor_rate'] : $item_creation1->distributor_rate; ?></td>

                    <td align="center" class="stl">
                        <div class="pretty p-default p-curve p-toggle">
                            <input type="checkbox" <?php if ($item_creation1['status']=="1"){ echo 'checked'; }else{ } ?> onclick="change_fun('<?php echo $item_creation1['id']; ?>','<?php echo $item_creation1['status']; ?>')">
                            <div class="state p-success p-on">
                              <label style="color: green">Active</label>
                            </div>
                            <div class="state p-danger p-off">
                              <label style="color: red">In Active </label>
                            </div>
                          </div>
                    </td>

                    <td align="center" class="stl">
                        <a class="btn btn-icon icon-left btn-info hover-gradient" data-toggle="tooltip"
                            style="cursor: pointer" title="Edit"
                            onclick="open_model('Update Item Creation','<?php echo is_array($item_creation1) ? $item_creation1['id'] : $item_creation1->id; ?>')"><i
                                class="far fa-edit"></i>Edit</a>
                        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer"
                            title="Delete" onclick="delete_row('<?php echo is_array($item_creation1) ? $item_creation1['id'] : $item_creation1->id; ?>')"><i
                                class="fas fa-trash"></i>Delete</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
    </table>
</div>
<script>
    function change_fun(id,status){
        // alert();
      var sendInfo={"action":"statusinfo","id":id,"status":status};
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data){

        },
        error: function() {
          alert('error handing here');
        }
      });
    }
</script>
