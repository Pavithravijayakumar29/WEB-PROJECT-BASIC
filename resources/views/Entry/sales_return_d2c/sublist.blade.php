<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
    padding-right: 128px;
}
</style>
<div class="table-responsive">
<table class="table table-sm table-hover" style="width:100%;">
    <thead>
        <tr class="text-center">
            <th scope="col">S.No</th>
            <th scope="col">Date</th>
            {{-- <th scope="col">Time</th> --}}
            <th scope="col">Tally Bill No</th>
            <th scope="col">Batch Number</th>
            <th scope="col">Return Type</th>
            <th scope="col">Item Name</th>
            <th scope="col">Packing Type</th>
            <th scope="col">UOM</th>
            <th scope="col">Return Quantity</th>
            <th scope="col">Pieces/Liters</th>
            <th scope="col">Item Price</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php $order_date_sub="";$time_sub="";$tally_no="";$batch_no="";$return_type_id="";$item_creation_id="";$order_quantity="";$pieces_quantity="";$item_property="";$item_weights="";$item_price="";$total_amount="";
            if($sales_return_d2c_sub!=null){
                $order_date_sub=$sales_return_d2c_sub['order_date_sub'];
                $time_sub=$sales_return_d2c_sub['time_sub'];
                $tally_no=$sales_return_d2c_sub['tally_no'];
                $batch_no=$sales_return_d2c_sub['batch_no'];
                $return_type_id=$sales_return_d2c_sub['return_type_id'];
                $item_creation_id=$sales_return_d2c_sub['item_creation_id'];
                $order_quantity=$sales_return_d2c_sub['order_quantity'];
                $pieces_quantity=$sales_return_d2c_sub['pieces_quantity'];
                $item_property=$sales_return_d2c_sub['item_property'];
                $item_weights=$sales_return_d2c_sub['item_weights'];
                $item_price=$sales_return_d2c_sub['item_price'];
                $total_amount=$sales_return_d2c_sub['total_amount'];
            } ?>
            <td>#</td>
            <td>
                <input type="date" style="width: auto;" id="order_date_sub" name="order_date_sub" class="form-control" value="<?php if($order_date_sub!='') { echo $order_date_sub; }else { echo date("Y-m-d"); } ?>">
                <input type="hidden" id="time_sub" name="time_sub" class="form-control" value="<?php if($time_sub!='') { echo $time_sub; } ?>">
            </td>
            <td>
            <input type="text" style="width: auto;" min="1" class="form-control" id="tally_no" value="<?php echo $tally_no; ?>" placeholder="Tally Bill" />
            </td>
            <td>
            <input type="text" style="width: auto;" min="1" class="form-control" id="batch_no" value="<?php echo $batch_no; ?>" placeholder="Batch Number" />
            </td>
            <td>
                <select class="form-control select2_comp1" id="return_type_id" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($return_creation as $return_creation1){ ?>
                    <option value="<?php echo $return_creation1['id']; ?>" <?php if($return_creation1['id']==$return_type_id){echo " selected";} ?>><?php echo $return_creation1['return_type']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <select class="form-control select2_comp1" id="item_creation_id" onchange="set_item_price(this.value);" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($item_creation as $item_creation1){ ?>
                    <option value="<?php echo $item_creation1['id']; ?>" <?php if($item_creation1['id']==$item_creation_id){echo " selected";} ?>><?php echo $item_creation1['item_name']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_creation_id_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="item_property" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($item_properties_type as $item_properties_type1){ ?>
                    <option value="<?php echo $item_properties_type1['id']; ?>" <?php if($item_properties_type1['id']==$item_property){echo " selected";} ?>><?php echo $item_properties_type1['item_properties_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_property_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="item_weights" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($item_liters_type as $item_liters_type1){ ?>
                    <option value="<?php echo $item_liters_type1['id']; ?>" <?php if($item_liters_type1['id']==$item_weights){echo " selected";} ?>><?php echo $item_liters_type1['item_liters_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_weights_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="number" style="width: auto;" min="1" class="form-control" id="order_quantity" value="<?php echo $order_quantity; ?>" oninput="calc_total_amount();set_item_price();" placeholder="Quantity" />
                <div id="order_quantity_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="hidden" id="pieces_12">
                <input type="number" style="width: auto;" min="1" class="form-control" id="pieces_quantity" value="<?php echo $pieces_quantity; ?>" placeholder="pcs/lts" readonly/>
                <div id="pieces_quantity_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="text" style="width: auto;" class="form-control" id="item_price" value="<?php echo $item_price; ?>" placeholder="Price"  oninput="calc_total_amount();"/>
                <div id="item_price_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="text" style="width: auto;" class="form-control" id="total_amount" value="<?php echo $total_amount; ?>" placeholder="Amount" readonly />
                <div id="total_amount_validate_div" class="mark_label_red"></div>
            </td>
            <td class="text-center">
                <?php if($sub_id==""){ ?>
                <button type="button" class="btn btn-success btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',order_date_sub.value,time_sub.value,tally_no.value,batch_no.value,return_type_id.value,item_creation_id.value,order_quantity.value,pieces_quantity.value,item_property.value,item_weights.value,item_price.value,total_amount.value)">Add</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-primary btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',order_date_sub.value,time_sub.value,tally_no.value,batch_no.value,return_type_id.value,item_creation_id.value,order_quantity.value,pieces_quantity.value,item_property.value,item_weights.value,item_price.value,total_amount.value)">Edit</button>
                <?php } ?>
            </td>
        </tr>
        <?php
        $i1=1;$Order_Quantity=0;$Total_Amount=0;
        foreach($sales_return_d2c_sub_list as $sales_return_d2c_sub_list1)
        { ?>
        <tr>
            <td><?php echo $i1;$i1++; ?></td>
            <td><?php echo $sales_return_d2c_sub_list1['order_date_sub']; ?></td>
            {{-- <td><?php echo $sales_return_d2c_sub_list1['time_sub']; ?></td> --}}
            <td><?php echo $sales_return_d2c_sub_list1['tally_no']; ?></td>
            <td><?php echo $sales_return_d2c_sub_list1['batch_no']; ?></td>
            <td><?php echo $sales_return_d2c_sub_list1['return_type_id']; ?></td>
            <td><?php echo $sales_return_d2c_sub_list1['item_creation_id']; ?></td>
            <td><?php echo $sales_return_d2c_sub_list1['item_property']; ?></td>
            <td><?php echo $sales_return_d2c_sub_list1['item_weights']; ?></td>
            <td class="text-right"><?php $Order_Quantity1=doubleval($sales_return_d2c_sub_list1['order_quantity']);echo number_format($Order_Quantity1,2);$Order_Quantity+=$Order_Quantity1; ?></td>
            <td class="text-right"><?php echo $sales_return_d2c_sub_list1['pieces_quantity']; ?></td> <td class="text-right"><?php echo $sales_return_d2c_sub_list1['item_price']; ?></td>
            <td class="text-right"><?php $Total_Amount1=doubleval($sales_return_d2c_sub_list1['total_amount']);echo number_format($Total_Amount1,2);$Total_Amount+=$Total_Amount1; ?></td>
            <td class="text-center">
                <button type="button" class="btn btn-primary btn-action" onclick="load_model_sublist('<?php echo $main_id; ?>','<?php echo $sales_return_d2c_sub_list1['id']; ?>');"><i class="fas fa-pencil-alt"></i></button>
                <button type="button" class="btn btn-danger btn-action" onclick="delete_sublist_row('<?php echo $main_id; ?>','<?php echo $sales_return_d2c_sub_list1['id']; ?>')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            {{-- <th scope="col"></th> --}}
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

function set_item_price(id)
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
$(function () {
    $(".select2_comp1").select2();
});

function getCurrentTime() {
        const now = new Date();

        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');


        return `${hours}:${minutes}`;
    }


    document.getElementById('time_sub').value = getCurrentTime();
</script>
