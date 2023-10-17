<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
    padding-right: 128px;
}
</style>
<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<div class="table-responsive">
<table class="table table-sm table-hover" style="width:100%;">
    <thead>
        <tr class="text-center">
            <th scope="col">S.No</th>
            <th scope="col">Order Staus</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Shop Name</th>
            <th scope="col">Item Name</th>
            <th scope="col">Short Code</th>
            <th scope="col">Packing Type</th>
            <th scope="col">UOM</th>
            <th scope="col">Stock</th>
            <th scope="col">Order Quantity</th>
            <th scope="col">Pieces/Liters</th>
            <th scope="col">Item Price</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php $status_check="";$order_date_sub="";$arriving_time_sub="";$closing_time_sub="";$shop_name="";$item_creation_id="";$short_code_id="";$current_stock="";$order_quantity="";$pieces_quantity="";$item_property="";$item_weights="";$item_price="";$total_amount="";
            if($sales_order_d2s_sub!=null){
                $status_check=$sales_order_d2s_sub['status_check'];
                $order_date_sub=$sales_order_d2s_sub['order_date_sub'];
                $arriving_time_sub=$sales_order_d2s_sub['arriving_time_sub'];
                $closing_time_sub=$sales_order_d2s_sub['closing_time_sub'];
                $shop_name=$sales_order_d2s_sub['shop_creation_id'];
                $item_creation_id=$sales_order_d2s_sub['item_creation_id'];
                $short_code_id=$sales_order_d2s_sub['short_code_id'];
                $current_stock=$sales_order_d2s_sub['current_stock'];
                $order_quantity=$sales_order_d2s_sub['order_quantity'];
                $pieces_quantity=$sales_order_d2s_sub['pieces_quantity'];
                $item_property=$sales_order_d2s_sub['item_property'];
                $item_weights=$sales_order_d2s_sub['item_weights'];
                $item_price=$sales_order_d2s_sub['item_price'];
                $total_amount=$sales_order_d2s_sub['total_amount'];
            } ?>
            <td>#</td>
            <td>
            <div class="pretty p-switch p-fill">
            <input type="checkbox" id="check_1" name="check_1" onclick="myClick(this);" <?php echo ($status_check ?? "") == "Yes" ? "checked" : ""; ?>/>
            <div class="state p-success">
            <label id="displayValue"><?php if($status_check!=''){ echo $status_check; } else{ echo "No"; } ?></label>
            </div>
            </div>
            </td>
            <td>
                <input type="date" style="width: auto;" id="order_date_sub" name="order_date_sub" class="form-control" value="<?php if ($order_date_sub != '') { echo $order_date_sub; } else { echo date("Y-m-d"); } ?>" >
            </td>
            <td>
                <input type="time" style="width: auto;" id="arriving_time_sub" name="arriving_time_sub" class="form-control" value="<?php echo $arriving_time_sub; ?>">

                <input type="hidden" id="closing_time_sub" name="closing_time_sub" class="form-control" value="<?php echo $closing_time_sub; ?>">
            </td>
            <td>
                <select class="form-control select2_comp1" id="shop_creation_id" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($shop_creation as $shop_creation1){ ?>
                        <option value="<?php echo $shop_creation1['id']; ?>"
                             <?php if($shop_name!=''){
                                if($shop_creation1['id']==$shop_name)
                             {echo " selected";}}else{
                                    if($main_id!=''){
                                if($shop_creation1['id']==$last_id_shop)
                             {echo " selected";}}
                             } ?>>
                             <?php echo $shop_creation1['shop_name']; ?></option>
                        <?php } ?>
                </select>
            </td>
            <td>
                <select class="form-control select2_comp1" id="item_creation_id" onchange="set_item_price();getopeningstock();short_code();" style="width:100%;" <?php if($status_check=='Yes'){ echo ""; } else if ($status_check=='No'){ echo "disabled"; } else{ echo "disabled"; } ?>>
                    <option value="">Select</option>
                    <?php foreach($item_creation as $item_creation1){ ?>
                    <option value="<?php echo $item_creation1['id']; ?>" <?php if($item_creation1['id']==$item_creation_id){echo " selected";} ?>><?php echo $item_creation1['item_name']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_creation_id_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="short_code_id" style="width:100%" <?php if($status_check=='Yes'){ echo ""; } else if ($status_check=='No'){ echo "disabled"; } else{ echo "disabled"; } ?>>
                    <option value="">Select</option>
                    <?php foreach($item_creation as $item_creation1){ ?>
                        <option value="<?php echo $item_creation1['id']; ?>" <?php if($item_creation1['id']==$short_code_id){echo " selected";} ?>><?php echo $item_creation1['short_code']; ?></option>
                        <?php } ?>
                </select>

            </td>

            <td>
                <select class="form-control select2_comp1" id="item_property" style="width:100%;" <?php if($status_check=='Yes'){ echo ""; } else if ($status_check=='No'){ echo "disabled"; } else{ echo "disabled"; } ?> onchange="getopeningstock();">
                    <option value="">Select</option>
                    <?php foreach($item_properties_type as $item_properties_type1){ ?>
                    <option value="<?php echo $item_properties_type1['id']; ?>" <?php if($item_properties_type1['id']==$item_property){echo " selected";} ?>><?php echo $item_properties_type1['item_properties_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_property_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="item_weights" style="width:100%;" <?php if($status_check=='Yes'){ echo ""; } else if ($status_check=='No'){ echo "disabled"; } else{ echo "disabled"; } ?> onchange="getopeningstock();">
                    <option value="">Select</option>
                    <?php foreach($item_liters_type as $item_liters_type1){ ?>
                    <option value="<?php echo $item_liters_type1['id']; ?>" <?php if($item_liters_type1['id']==$item_weights){echo " selected";} ?>><?php echo $item_liters_type1['item_liters_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_weights_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="text" style="width: auto;" class="form-control" id="current_stock"  value="<?php echo $current_stock; ?>" placeholder="Current" readonly/>
                <div id="current_stock_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="number" style="width: auto;" min="1" class="form-control" id="order_quantity" value="<?php echo $order_quantity; ?>" oninput="calc_total_amount();set_item_price();stock_validation();" placeholder="Quantity" <?php if($status_check=='Yes'){ echo ""; } else if ($status_check=='No'){ echo "disabled"; } else{ echo "disabled"; } ?> />
                <div id="order_quantity_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="hidden" id="pieces_12">
                <input type="number" style="width: auto;" min="1" class="form-control" id="pieces_quantity" value="<?php echo $pieces_quantity; ?>" placeholder="pcs/lts" readonly/>
                <div id="pieces_quantity_validate_div" class="mark_label_red"></div>
            </td>

            <td>
                <input type="text" style="width: auto;" class="form-control" id="item_price" value="<?php echo $item_price; ?>" placeholder="Price" oninput="calc_total_amount();" <?php if($status_check=='Yes'){ echo ""; } else if ($status_check=='No'){ echo "disabled"; } else{ echo "disabled"; } ?> />
                <div id="item_price_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="text" style="width: auto;" class="form-control" id="total_amount" value="<?php echo $total_amount; ?>" placeholder="Amount" readonly />
                <div id="total_amount_validate_div" class="mark_label_red"></div>
            </td>

            <td class="text-center">
                <?php if($sub_id==""){ ?>
                <button type="button" class="btn btn-success btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',document.getElementById('check_1').checked,order_date_sub.value,arriving_time_sub.value,closing_time_sub.value,shop_creation_id.value,item_creation_id.value,short_code_id.value,current_stock.value,order_quantity.value,pieces_quantity.value,item_property.value,item_weights.value,item_price.value,total_amount.value)">Add</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-primary btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',document.getElementById('check_1').checked,order_date_sub.value,arriving_time_sub.value,closing_time_sub.value,shop_creation_id.value,item_creation_id.value,short_code_id.value,current_stock.value,order_quantity.value,pieces_quantity.value,item_property.value,item_weights.value,item_price.value,total_amount.value)">Edit</button>
                <?php } ?>
            </td>
        </tr>

        <?php
        $i1=1;$Order_Quantity=0;$Total_Amount=0;
        foreach($sales_order_d2s_sub_list as $sales_order_d2s_sub_list1)
        { ?>
        <tr>
            <td><?php echo $i1;$i1++; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['status_check']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['order_date_sub']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['arriving_time_sub']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['shop_creation_id']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['item_creation_id']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['short_code_id']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['item_property']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['item_weights']; ?></td>
            <td class="text-right"><?php echo $sales_order_d2s_sub_list1['current_stock']; ?></td>
            <td class="text-right"><?php $Order_Quantity1=doubleval($sales_order_d2s_sub_list1['order_quantity']);echo number_format($Order_Quantity1,2);$Order_Quantity+=$Order_Quantity1; ?></td>
            <td class="text-right"><?php echo $sales_order_d2s_sub_list1['pieces_quantity']; ?></td>
            <td class="text-right"><?php echo $sales_order_d2s_sub_list1['item_price']; ?></td>
            <td class="text-right"><?php $Total_Amount1=doubleval($sales_order_d2s_sub_list1['total_amount']);echo number_format($Total_Amount1,2);$Total_Amount+=$Total_Amount1; ?></td>
            <td class="text-center">
                <button type="button" class="btn btn-primary btn-action" onclick="load_model_sublist('<?php echo $main_id; ?>','<?php echo $sales_order_d2s_sub_list1['id']; ?>');"><i class="fas fa-pencil-alt"></i></button>
                <button type="button" class="btn btn-danger btn-action" onclick="delete_sublist_row('<?php echo $main_id; ?>','<?php echo $sales_order_d2s_sub_list1['id']; ?>')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col" class="text-right">Total :</th>
            <th scope="col" class="text-right"><?php echo number_format($Order_Quantity,2); ?></th>
            <th scope="col"></th>
            <th scope="col" class="text-right"><?php echo number_format($Total_Amount,2); ?></th>
            <th scope="col"></th>
        </tr>
    </tfoot>
</table>
</div>
<script>
var item_creation_list={ <?php foreach($item_creation as $item_creation1){echo '"'.$item_creation1['id'].'":"'.$item_creation1['distributor_rate'].'",';} ?> };

var item_creation_valus={ <?php foreach($item_creation as $item_creation2){echo '"'.$item_creation2['id'].'":"'.$item_creation2['piece'].'",';} ?> };

function set_item_price()
{
    var id=$("#item_creation_id").val();
    $("#item_price").val(item_creation_list[id]);
    $("#pieces_12").val(item_creation_valus[id]);
    calc_total_amount();
}
function calc_total_amount()
{
    var order_quantity=$("#order_quantity").val();
    order_quantity=(order_quantity!="")?parseFloat(order_quantity):0;
    var item_price=$("#item_price").val();
    item_price=(item_price!="")?parseFloat(item_price):0;
    var total_amount=(order_quantity*item_price).toFixed(2);
    $("#total_amount").val(total_amount);
    var item_creation_id=$("#item_creation_id").val();
    if(item_creation_id){
        var pieces_12=$("#pieces_12").val();
        var total_pisas=(order_quantity*pieces_12).toFixed(2);
        $("#pieces_quantity").val(total_pisas);
    }
}
function stock_validation()
{
    var current_stock=$("#current_stock").val();
    current_stock=(current_stock!="")?parseFloat(current_stock):0;
    var order_quantity=$("#order_quantity").val();
    order_quantity=(order_quantity!="")?parseFloat(order_quantity):0;
    if(current_stock < order_quantity){
        $("#order_quantity").addClass("is-invalid");
        $("#order_quantity_validate_div").html("Check Stock");
        return false;
    } else {
        $("#order_quantity").removeClass("is-invalid");
        $("#order_quantity_validate_div").html("");
    }
}
$(function () {
    $(".select2_comp1").select2();
});

    function getCurrentTime() {
        const now = new Date();

        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');


        return `${hours}:${minutes}`;
    }


    document.getElementById('arriving_time_sub').value = getCurrentTime();
    document.getElementById('closing_time_sub').value = getCurrentTime();

    function myClick(checkbox) {

        // var shop_creation_id = document.getElementById('shop_creation_id');
        var item_creation_id = document.getElementById('item_creation_id');
        var short_code_id = document.getElementById('short_code_id');
        var item_property = document.getElementById('item_property');
        var item_weights = document.getElementById('item_weights');
        var order_quantity = document.getElementById('order_quantity');
        var item_price = document.getElementById('item_price');
        var displayElement = document.getElementById('displayValue');
    if (checkbox.checked) {
        // shop_creation_id.disabled = false;
        item_creation_id.disabled = false;
        short_code_id.disabled = false;
        item_property.disabled = false;
        item_weights.disabled = false;
        order_quantity.disabled = false;
        item_price.disabled = false;
        displayElement.textContent = 'Yes';
    } else {
        // shop_creation_id.disabled = true;
        item_creation_id.disabled = true;
        short_code_id.disabled = true;
        item_property.disabled = true;
        item_weights.disabled = true;
        order_quantity.disabled = true;
        item_price.disabled = true;
        displayElement.textContent = 'No';
    }
}

</script>
