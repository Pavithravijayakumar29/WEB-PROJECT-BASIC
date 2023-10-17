<table class="table table-sm table-hover" style="width:100%;">
    <thead>
        <tr class="text-center">
            <th scope="col" style="width:6%;">S.No </th>
            <th scope="col" style="width:14%;">Particulars <b style="color: blue;">Cr</b></th>
            <th scope="col" style="width:14%;">Description</th>
            <th scope="col" style="width:14%;">Amount</th>
            <th scope="col" style="width:10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php $ledger_cr="";$description1="";$amount="";
            if($receipt_entry_sub!=null){
                $ledger_cr=$receipt_entry_sub['ledger_cr'];
                $description1=$receipt_entry_sub['description1'];
                $amount=$receipt_entry_sub['amount'];
            } ?>
            <td>#</td>
            <td>
                <div id="ledger_cr_validate_div" class="mark_label_red"></div>
                <select class="form-control select2_comp1" id="ledger_cr" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($ledger_name as $ledger_name1){ ?>
                        <option value="<?php echo $ledger_name1['id']; ?>"<?php if($ledger_name1['id']=$receipt_entry_sub){echo 'selected';}?>><?php echo $ledger_name1['ledger_name']; ?></option>
                        <?php } ?>

                </select>

            </td>

            <td>
                <input type="text"  class="form-control" id="description1" name="description1" placeholder="description" value="<?php echo $description1; ?>" />

            </td>

            <td>

                <input type="text" class="form-control" id="amount" style="width:100%;" value="<?php echo $amount; ?>">
                <div id="item_creation_id_validate_div" class="mark_label_red"></div>
            </td>
            <td class="text-center">
                <?php if($sub_id==""){ ?>
                <button type="button" class="btn btn-success btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',ledger_cr.value,description1.value,amount.value)">Add</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-primary btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',ledger_cr.value,description1.value,amount.value)">Edit</button>
                <?php } ?>
            </td>
        </tr>

        <?php
        $i1=1;$Total_Amount=0;
        foreach($receipt_entry_sub_list as $receipt_entry_sub_list1)
        { ?>
        <tr>
            <td><?php echo $i1;$i1++; ?></td>
            <td><?php echo $receipt_entry_sub_list1['ledger_cr']; ?></td>
            <td><?php echo $receipt_entry_sub_list1['description1']; ?></td>
            {{-- <td><?php echo $receipt_entry_sub_list1['amount']; ?></td> --}}
            <td class="text-right"><?php $Total_Amount1=doubleval($receipt_entry_sub_list1['amount']);echo number_format($Total_Amount1,2);$Total_Amount+=$Total_Amount1; ?></td>
            <td class="text-center">
                <button type="button" class="btn btn-primary btn-action" onclick="load_model_sublist('<?php echo $main_id; ?>','<?php echo $receipt_entry_sub_list1['id']; ?>');"><i class="fas fa-pencil-alt"></i></button>
                <button type="button" class="btn btn-danger btn-action" onclick="delete_sublist_row('<?php echo $main_id; ?>','<?php echo $receipt_entry_sub_list1['id']; ?>')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>

            <th scope="col">Total :</th>
            <th scope="col" class="text-left"><?php echo number_format($Total_Amount,2); ?></th>

        </tr>
    </tfoot>
</table>
<script>

$(function () {
    $(".select2_comp1").select2();
});
</script>
