<table class="table table-sm table-hover" style="width:100%;">
    <thead>
        <tr class="text-center">
            <th scope="col" style="width:4%;">S.No</th>
            <th scope="col" style="width:10%;">Visitor Name</th>
            <th scope="col" style="width:8%;">Dealer Name</th>
            <th scope="col" style="width:18%;">Market Name</th>
            <th scope="col" style="width:18%;">Expense</th>
            <th scope="col" style="width:18%;">Sub Expense</th>
           
         
            <th scope="col" style="width:14%;">Total Amount</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php $dealer_sub_id="";$visitor_sub_id="";$market_sub_id="";$expense_id="";$sub_expense_id="";$total_amount="";
            if($expense_creations_sub!=null){
                $dealer_sub_id=$expense_creations_sub['dealer_sub_id'];
                $visitor_sub_id=$expense_creations_sub['visitor_sub_id'];
                $market_sub_id=$expense_creations_sub['market_sub_id'];
                $expense_id=$expense_creations_sub['expense_id'];
               
                $sub_expense_id=$expense_creations_sub['sub_expense_id'];
              
             
                $total_amount=$expense_creations_sub['total_amount'];
            } ?>
            <td>#</td>

            <td>
                <select class="form-control select2_comp1" id="visitor_sub_id"  style="width:100%;"  >

                <option value="">Select</option>               
                    <?php foreach($visitor_creation as $visitor_creation1){ ?>
                    <option value="<?php echo $visitor_creation1['id']; ?>" <?php  if($visitor_creation1['id']==$visitor_sub_id){echo " selected";} ?>><?php echo $visitor_creation1['visitor_name']; ?></option>
                    <?php } ?>
                  
                </select>
                <div id="visitor_sub_id_validate_div" class="mark_label_red"></div>
            </td>


            <td>
                <select class="form-control select2_comp1" id="dealer_sub_id"  style="width:100%;" onchange="get_market()"  >

                <option value="">Select</option>               
                    <?php foreach($dealer_creation as $dealer_creation1){ ?>
                    <option value="<?php echo $dealer_creation1['id']; ?>" <?php if($dealer_sub_id != "") { if($dealer_creation1['id']==$dealer_sub_id){echo " selected";}}else{
                        if($main_id != ""){
                            if($dealer_creation1['id']==$last_id_sub_expense)
                            {echo " selected"; }
                        }
                    } ?>><?php echo $dealer_creation1['dealer_name']; ?></option>
                    <?php } ?>
                  
                </select>
                <div id="dealer_sub_id_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="market_sub_id"  style="width:100%;">

                <option value="">Select</option>               
                    <?php foreach($market_creation as $market_creation1){ ?>
                    <option value="<?php echo $market_creation1['id']; ?>" <?php if($market_sub_id != "") {if($market_creation1['id']==$market_sub_id){echo " selected";}}else{
                        if($main_id != ""){
                            if($market_creation1['id'] == $last_id_market)
                            {echo " selected";}
                        }
                    } ?> ><?php echo $market_creation1['area_name']; ?></option>
                    <?php } ?>

                    
                  
                </select>
                <div id="market_sub_id_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="expense_id"  style="width:100%;" onchange="get_sub_expense()">
                    <option value="">Select</option>
                    <?php foreach($expense_creation as $expense_creation1){ ?>
                    <option value="<?php echo $expense_creation1['id']; ?>" <?php if($expense_creation1['id']==$expense_id){echo " selected";} ?>><?php echo $expense_creation1['expense_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="expense_id_validate_div" class="mark_label_red"></div>
            </td>
            <td>
                <select class="form-control select2_comp1" id="sub_expense_id" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($sub_expense_creation as $sub_expense_creation1){ ?>
                    <option value="<?php echo $sub_expense_creation1['id']; ?>" <?php if($sub_expense_creation1['id']==$sub_expense_id){echo " selected";} ?>><?php echo $sub_expense_creation1['sub_expense_type']; ?></option>
                    <?php } ?>
                </select>
                <div id="sub_expense_id_validate_div" class="mark_label_red"></div>
            </td>
           
           
          
            <td>
                <input type="text" class="form-control" id="total_amount" value="<?php echo $total_amount; ?>" placeholder="Amount"  />
                <div id="total_amount_validate_div" class="mark_label_red"></div>
            </td>
            <td class="text-center">
                <?php if($sub_id==""){ ?>
                <button type="button" class="btn btn-success btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',expense_id.value,sub_expense_id.value,total_amount.value)">Add</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-primary btn-action" id="sublist_edit" onclick="insert_update_sub_row('<?php echo $main_id; ?>','<?php echo $sub_id; ?>',expense_id.value,sub_expense_id.value,total_amount.value)">Edit</button>
                <?php } ?>
            </td>
        </tr>
        <?php
        $i1=1;$Total_Amount=0;
        foreach($expense_creations_sub_list as $expense_creations_sub_list1)
        { ?>
        <tr>
            <td><?php echo $i1;$i1++; ?></td>
            <td><?php echo $expense_creations_sub_list1['visitor_sub_id']; ?></td>
            <td><?php echo $expense_creations_sub_list1['dealer_sub_id']; ?></td>
            <td><?php echo $expense_creations_sub_list1['market_sub_id']; ?></td>
            <td><?php echo $expense_creations_sub_list1['expense_id']; ?></td>
            <td><?php echo $expense_creations_sub_list1['sub_expense_id']; ?></td>
            
            
            <td class="text-right"><?php $Total_Amount1=doubleval($expense_creations_sub_list1['total_amount']);echo number_format($Total_Amount1,2);$Total_Amount+=$Total_Amount1; ?></td>
            <td class="text-center">
                <button type="button" class="btn btn-primary btn-action" onclick="load_model_sublist('<?php echo $main_id; ?>','<?php echo $expense_creations_sub_list1['id']; ?>');"><i class="fas fa-pencil-alt">

                </i></button>
                <button type="button" class="btn btn-danger btn-action" onclick="delete_sublist_row('<?php echo $main_id; ?>','<?php echo $expense_creations_sub_list1['id']; ?>')"><i class="fas fa-trash"></i>
            </button>
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
            <th scope="col" class="text-right">Total :</th>
            
           
            <th scope="col" class="text-right"><?php echo number_format($Total_Amount,2); ?></th>
            <th scope="col"></th>
        </tr>
    </tfoot>
</table>
<script>
var expense_creation_list={ <?php foreach($expense_creation as $expense_creation1){echo '"'.$expense_creation1['id'].'":"'.$expense_creation1['distributor_rate'].'",';} ?> };


$(function () {
    $(".select2_comp1").select2();
    
});
</script>
