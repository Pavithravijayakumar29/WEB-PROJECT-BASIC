<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
    padding-right: 128px;
}
</style>
<div class="table-responsive">
<table class="table table-sm table-hover" style="width:100%;">
    <thead>
        <tr class="text-center">
            <th scope="col" style="width:6%;">S.No</th>
            <th scope="col" style="width:14%;">Item Name</th>
            <th scope="col" style="width:14%;">Short code</th>
            <th scope="col" style="width:14%;">Packing Type</th>
            <th scope="col" style="width:14%;">UOM</th>
            <th scope="col" style="width:14%;">Opening Stock</th>
            <th scope="col" style="width:14%;">Current Stock</th>
            <th scope="col" style="width:14%;">Pieces/Liters</th>
            <th scope="col" style="width:10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php $shop_name="";$item_creation_id="";$short_code_id="";$order_quantity="";$item_property="";$item_weights="";$opening_stock="";$current_stock="";$pieces_quantity="";
            if($sales_order_stock_sub!=null){
                $item_creation_id=$sales_order_stock_sub['item_creation_id'];
                $short_code_id=$sales_order_stock_sub['short_code_id'];
                $item_property=$sales_order_stock_sub['item_property'];
                $item_weights=$sales_order_stock_sub['item_weights'];
                $opening_stock=$sales_order_stock_sub['opening_stock'];
                $current_stock=$sales_order_stock_sub['current_stock'];
                $pieces_quantity=$sales_order_stock_sub['pieces_quantity'];
            } ?>
            <td>#</td>

            <td>

                <select class="form-control select2_comp1" id="item_creation_id"  style="width:100%;" onchange="getopeningstock();short_code()">
                    <option value="">Select</option>
                    <?php foreach($item_creation as $item_creation1){ ?>
                    <option value="<?php echo $item_creation1['id']; ?>" <?php if($item_creation1['id']==$item_creation_id){echo " selected";} ?>><?php echo $item_creation1['item_name']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_creation_id_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="short_code_id" name="short_code_id" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($item_creation as $item_creation1){ ?>
                        <option value="<?php echo $item_creation1['id']; ?>" <?php if($item_creation1['id']==$item_creation_id){echo " selected";} ?>><?php echo $item_creation1['short_code']; ?></option>
                        <?php } ?>
                </select>
            </td>

            <td>
                <select class="form-control select2_comp1" id="item_property" style="width:100%;" onchange="getopeningstock()">
                    <option value="">Select</option>
                    <?php foreach($item_properties_type as $item_properties_type1){ ?>
                    <option value="<?php echo $item_properties_type1['id']; ?>" <?php if($item_properties_type1['id']==$item_property){echo " selected";} ?>><?php echo $item_properties_type1['item_properties_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_property_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="item_weights" style="width:100%;" onchange="getopeningstock()">
                    <option value="">Select</option>
                    <?php foreach($item_liters_type as $item_liters_type1){ ?>
                    <option value="<?php echo $item_liters_type1['id']; ?>" <?php if($item_liters_type1['id']==$item_weights){echo " selected";} ?>><?php echo $item_liters_type1['item_liters_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_weights_validate_div" class="mark_label_red"></div>
            </td>

            <td>
                <input type="text" style="width: auto;" class="form-control" id="opening_stock" value="<?php echo $opening_stock; ?>" placeholder="Openig"/>
                <div id="opening_stock_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="text" style="width: auto;" class="form-control" id="current_stock"  placeholder="Current" value="<?php echo $current_stock; ?>" readonly/>
                <div id="current_stock_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="text" style="width: auto;" class="form-control" id="pieces_quantity" value="<?php echo $pieces_quantity; ?>" placeholder="pcs/lts" readonly/>
                <div id="pieces_quantity_validate_div" class="mark_label_red"></div>
            </td>

            <td class="text-center">
                <?php if($sub_id==""){ ?>
                <button type="button" class="btn btn-success btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',item_creation_id.value,item_property.value,item_weights.value,opening_stock.value,current_stock.value,pieces_quantity.value)">Add</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-primary btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',item_creation_id.value,item_property.value,item_weights.value,opening_stock.value,current_stock.value,pieces_quantity.value)">Edit</button>
                <?php } ?>
            </td>
        </tr>

        <?php
        $i1=1;$Order_Quantity=0;$pieces_quantity=0;
        foreach($sales_order_stock_sub_list as $sales_order_stock_sub_list1)
        { ?>
        <tr>
            <td><?php echo $i1;$i1++; ?></td>
            <td><?php echo $sales_order_stock_sub_list1['item_creation_id']; ?></td>
            <td><?php echo $sales_order_stock_sub_list1['short_code_id']; ?></td>
            <td><?php echo $sales_order_stock_sub_list1['item_property']; ?></td>
            <td><?php echo $sales_order_stock_sub_list1['item_weights']; ?></td>
            <td><?php echo $sales_order_stock_sub_list1['opening_stock']; ?></td>
            <td><?php echo $sales_order_stock_sub_list1['current_stock']; ?></td>
            <td><?php echo $sales_order_stock_sub_list1['pieces_quantity']; ?></td>
            <td class="text-center">
                <button type="button" class="btn btn-primary btn-action" onclick="load_model_sublist('<?php echo $main_id; ?>','<?php echo $sales_order_stock_sub_list1['id']; ?>');"><i class="fas fa-pencil-alt"></i></button>
                <button type="button" class="btn btn-danger btn-action" onclick="delete_sublist_row('<?php echo $main_id; ?>','<?php echo $sales_order_stock_sub_list1['id']; ?>')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<script>
$(function () {
    $(".select2_comp1").select2();
});
</script>
