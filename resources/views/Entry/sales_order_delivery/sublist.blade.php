<div style="width:100%;">
    <div class="customcheckbox_div" style="float:left;">
        &nbsp;&nbsp;&nbsp;<b>Checked All</b>&nbsp;<input class="customcheckbox_div_checkbox" id="checkbox" type="checkbox"
        onchange="perm1_function(this, -1);updateSelectAllValue(this.value);" <?php  echo ($checkbox == "1" ? "checked" : ""); ?>>
    </div>
</div><br><br>
<table class="table table-sm table-hover" style="width:100%;">
    <thead>
        <tr class="text-center">
            <th scope="col">S.No</th>
            <th class="text-center" style="width:8%;">Check</th>
            <th scope="col">Date</th>
            <th scope="col" style="width:10%;">Item Name</th>
            <th scope="col" style="width:10%;">Item Package Type</th>
            <th scope="col" style="width:8%;">UOM</th>
            <th scope="col">Order Quantity</th>
            <th scope="col">Pending Quantity</th>
            <th scope="col">Dispatch Quantity</th>
            <th scope="col">Item Price</th>
            <th scope="col">Total Amount</th>
            <th scope="col" style="width:10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i1=1;$return_quantity=0;$Total_Amount=0;
        foreach($sales_order_delivery_sub_list as $sales_order_delivery_sub_list1)
        { ?>
        <tr>
            <td><?php echo $i1;$i1++; ?></td>
            <td align="center">
                <input type="hidden" id="order_recipt_sub_id" name="order_recipt_sub_id" class="form-control order_recipt_sub_id" value="<?php echo $sales_order_delivery_sub_list1['sub_id']; ?>">

                <input class="customcheckbox_div_checkbox" type="checkbox"
                    onchange="perm_function(this, <?php echo $i1 - 2; ?>)" <?php echo ($sales_order_delivery_sub_list1['dispatch_status'] == "1" ? "checked" : ""); ?>/>
            </td>
            <td>
                <input type="date" id="order_date_sub" name="order_date_sub" class="form-control order_date_sub" value="<?php echo date("Y-m-d"); ?>" readonly>
            </td>
            <td>
                <select class="form-control select2_comp1 item_creation_id" id="item_creation_id" style="width:100%;" disabled>
                    <option value="">Select</option>
                    <?php foreach($item_creation as $item_creation1){ ?>
                    <option value="<?php echo $item_creation1['id']; ?>" <?php if($item_creation1['id']==$sales_order_delivery_sub_list1['item_creation_id']){echo " selected";} ?>><?php echo $item_creation1['item_name']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <select class="form-control select2_comp1 item_property" id="item_property" style="width:100%;" disabled>
                    <option value="">Select</option>
                    <?php foreach($item_properties_type as $item_properties_type1){ ?>
                    <option value="<?php echo $item_properties_type1['id']; ?>" <?php if($item_properties_type1['id']==$sales_order_delivery_sub_list1['item_property']){echo " selected";} ?>><?php echo $item_properties_type1['item_properties_type']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <select class="form-control select2_comp1 item_weights" id="item_weights" style="width:100%;" disabled>
                    <option value="">Select</option>
                    <?php foreach($item_liters_type as $item_liters_type1){ ?>
                    <option value="<?php echo $item_liters_type1['id']; ?>" <?php if($item_liters_type1['id']==$sales_order_delivery_sub_list1['item_weights']){echo " selected";} ?>><?php echo $item_liters_type1['item_liters_type']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <input type="number" min="1" class="form-control order_quantity" id="order_quantity" value="<?php echo $sales_order_delivery_sub_list1['order_quantity']; ?>" readonly/>
            </td>
            <td>
                <input type="number" min="1" class="form-control balance_quantity" id="balance_quantity" value="<?php echo $sales_order_delivery_sub_list1['balance_quantity']; ?>" readonly/>
            </td>
            <td>
                <input type="text" min="1" class="form-control return_quantity" id="return_quantity_<?php echo $i1; ?>" value="<?php if($sales_order_delivery_sub_list1['return_quantity']!=''){ echo $sales_order_delivery_sub_list1['return_quantity']; }else{ echo "0"; } ?>" oninput="calc_total_amount('<?php echo $i1; ?>');"/>
            </td>
            <td>
                <input type="number" class="form-control item_price" id="item_price_<?php echo $i1; ?>" value="<?php echo $sales_order_delivery_sub_list1['item_price']; ?>" readonly/>
            </td>
            <td>
                <input type="text" class="form-control total_amount" id="total_amount_<?php echo $i1; ?>" value="<?php echo $sales_order_delivery_sub_list1['total_amount']; ?>" placeholder="Amount" readonly />
            </td>
            <td align="center">
                <select class="form-control dispatch_status" id="dispatch_status_<?php echo $i1 - 2; ?>" disabled>
                    <option value="0" <?php if($sales_order_delivery_sub_list1['dispatch_status'] != '1'){ echo ' selected'; } ?>>Not Dispatch</option>
                    <option value="1" <?php if($sales_order_delivery_sub_list1['dispatch_status'] == '1'){ echo ' selected'; } ?>>Dispatch</option>
                </select>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script>
$(function () {
    $(".select2_comp1").select2();
});
function perm1_function(checkbox, rowIndex) {
    var checked = checkbox.checked;
    document.querySelectorAll('.customcheckbox_div_checkbox').forEach(function(checkbox, index) {
        if (index === rowIndex) return;
        checkbox.checked = checked;
        var dispatchStatusSelect = document.getElementById('dispatch_status_' + (index - 1));
        if (dispatchStatusSelect) {
            dispatchStatusSelect.value = checked ? "1" : "0";
        }
        // else {
        //     console.error("Attendance Status select element not found for row index:", index - 1);
        // }
    });
}
function perm_function(checkbox, rowIndex) {
    var checked = checkbox.checked;
    var row = checkbox.closest('tr');
    var checkboxesInRow = row.querySelectorAll('.customcheckbox_div_checkbox');
    checkboxesInRow.forEach(function(checkbox) {
        checkbox.checked = checked;
    });
    var dispatchStatusSelect = document.getElementById('dispatch_status_' + rowIndex);
    dispatchStatusSelect.value = checked ? "1" : "0";
}
function updateSelectAllValue(checkbox) {
    if (checkbox.checked) {
        checkbox.value = 1;
    } else {
        checkbox.value = 0;
    }
}
function calc_total_amount(id)
{
    var return_quantity=$("#return_quantity_"+id).val();
    return_quantity=(return_quantity!="")?parseFloat(return_quantity):0;
    var item_price=$("#item_price_"+id).val();
    item_price=(item_price!="")?parseFloat(item_price):0;
    var total_amount=(return_quantity*item_price).toFixed(2);
    $("#total_amount_"+id).val(total_amount);
}
</script>
