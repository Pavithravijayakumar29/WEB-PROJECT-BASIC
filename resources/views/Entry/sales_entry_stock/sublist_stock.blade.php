<table class="table table-sm table-hover" style="width:100%;">
    <thead>
        <tr class="text-center">
            <th scope="col" style="width:6%;">S.No</th>
            <th scope="col" style="width:14%;">Item Name</th>
            <th scope="col" style="width:14%;">Short Code</th>
            <th scope="col" style="width:14%;">Packing Type</th>
            <th scope="col" style="width:14%;">UOM</th>
            <th scope="col" style="width:14%;">Opening Stock</th>
            <th scope="col" style="width:14%;">Closing Stock</th>
            <th scope="col" style="width:10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php $item_creation_id_stock="";$order_quantity="";$item_property_stock="";$item_weights_stock="";$opening_stock="";$closing_stock="";
            if($sales_order_d2s_sub!=null){
                $item_creation_id_stock=$sales_order_d2s_sub['item_creation_id_stock'];
                $item_property_stock=$sales_order_d2s_sub['item_property_stock'];
                $item_weights_stock=$sales_order_d2s_sub['item_weights_stock'];
                $item_price=$sales_order_d2s_sub['opening_stock'];
                $total_amount=$sales_order_d2s_sub['closing_stock'];
            } ?>
            <td>#</td>

            <td>

                <select class="form-control select2_comp1" id="item_creation_id_stock" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($item_creation as $item_creation1){ ?>
                    <option value="<?php echo $item_creation1['id']; ?>" <?php if($item_creation1['id']==$item_creation_id_stock){echo " selected";} ?>><?php echo $item_creation1['item_name']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_creation_id_stock_validate_div" class="mark_label_red"></div>
            </td>

            <td>
                <select class="form-control select2_comp1" id="short_code_id" style="width:100%;">
                    <option value="">Select</option>

                </select>
            </td>

            <td>
                <select class="form-control select2_comp1" id="item_property_stock" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($item_properties_type as $item_properties_type1){ ?>
                    <option value="<?php echo $item_properties_type1['id']; ?>" <?php if($item_properties_type1['id']==$item_property_stock){echo " selected";} ?>><?php echo $item_properties_type1['item_properties_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_property_stock_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="item_weights_stock" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($item_liters_type as $item_liters_type1){ ?>
                    <option value="<?php echo $item_liters_type1['id']; ?>" <?php if($item_liters_type1['id']==$item_weights_stock){echo " selected";} ?>><?php echo $item_liters_type1['item_liters_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="item_weights_stock_validate_div" class="mark_label_red"></div>
            </td>

            <td>
                <input type="text" class="form-control" id="opening_stock" value="<?php echo $opening_stock; ?>" placeholder="Opening"/>
                <div id="opening_stock_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <input type="text" class="form-control" id="closing_stock" value="<?php echo $closing_stock; ?>" placeholder="Closing" />
                <div id="closing_stock_validate_div" class="mark_label_red"></div>
            </td>

            <td class="text-center">
                <?php if($sub_id==""){ ?>
                <button type="button" class="btn btn-success btn-action" id="sublist_edit" onclick="insert_update_sub_row_stock('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',item_creation_id_stock.value,item_property_stock.value,item_weights_stock.value,opening_stock.value,closing_stock.value)">Add</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-primary btn-action" id="sublist_edit" onclick="insert_update_sub_row_stock('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',item_creation_id_stock.value,item_property_stock.value,item_weights_stock.value,opening_stock.value,closing_stock.value)">Edit</button>
                <?php } ?>
            </td>
        </tr>

        <?php
        $i1=1;$Order_Quantity=0;$Total_Amount=0;
        foreach($sales_order_d2s_sub_list as $sales_order_d2s_sub_list1)
        { ?>
        <tr>
            <td><?php echo $i1;$i1++; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['item_creation_id_stock']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['item_property_stock']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['item_weights_stock']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['opening_stock']; ?></td>
            <td><?php echo $sales_order_d2s_sub_list1['closing_stock']; ?></td>
            <td class="text-center">
                <button type="button" class="btn btn-primary btn-action" onclick="load_model_sublist('<?php echo $main_id; ?>','<?php echo $sales_order_d2s_sub_list1['id']; ?>');"><i class="fas fa-pencil-alt"></i></button>
                <button type="button" class="btn btn-danger btn-action" onclick="delete_sublist_row_stock('<?php echo $main_id; ?>','<?php echo $sales_order_d2s_sub_list1['id']; ?>')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <!-- <tfoot>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col" class="text-right">Total :</th>
            <th scope="col" class="text-right"><?php echo number_format($Order_Quantity,2); ?></th>
            <th scope="col"></th>
            <th scope="col" class="text-right"><?php echo number_format($Total_Amount,2); ?></th>
            <th scope="col"></th>
        </tr>
    </tfoot> -->
</table>
<script>
$(function () {
    $(".select2_comp1").select2();
});
</script>
