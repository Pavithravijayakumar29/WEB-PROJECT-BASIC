
<style>
.select2-selection__rendered {
      width: 350px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        font-family: "Times New Roman", Times, serif;
    color: #5c4b4b;
    line-height: 28px;

}
.stl{
        font-family: "Times New Roman", Times, serif;
    }

.swal-icon:first-child {
    margin-top: 32px;
    color: blue;
}
</style>

<form id="myForm" onsubmit="return validateForm()"  action="javascript:insert_update_row('',date.value,adv_no.value,staff_id.value,amount.value,payment.value,description.value)">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Date</label><label style="color:red">*</label>
                <input type="date" id="date" class="form-control " value="<?php echo date('Y-m-d'); ?>">

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Advance No</label><label style="color:red">*</label>
                <input type="text" id="adv_no" class="form-control" value="<?php echo $newInvoiceNumber; ?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Staff Name</label><label style="color:red">*</label>
                <select class="select2" id="staff_id" width="100%">
                    <option value="0">--Select--</option>
                    <?php foreach($sales as $sales1){ ?>
                    <option value="<?php echo $sales1['id']; ?>"><?php echo $sales1['sales_ref_name']; ?></option>
                    <?php } ?>
                </select>
                <p id="error_message_1" style="color: red; display: none;">Please Select Staff Name</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Amount</label><label style="color:red">*</label>
                <input type="text" id="amount" class="form-control" inputmode="numeric" oninput="restrictInput(event)">
                <p id="error_message_2" style="color: red; display: none;">Please Enter Amount</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Mode Of Payment</label><label style="color:red">*</label>
                <select class="form-control" id="payment" width="100%" >

                    <option value="">--Select--</option>
                    <option value="Cash">Cash</option>
                    <option value="neft">NEFT</option>

                </select>
                <p id="error_message_3" style="color: red; display: none;">Please Select Mode Of Payment</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="description" class="stl">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
          <button class="btn btn-icon icon-left btn-danger" data-dismiss="modal" aria-label="Close">
            <span class="fas fa-times"></span>Cancel
          </button>
        </div>
        <div class="col-md-6 text-right">
          <button class="btn btn-icon icon-left btn-success" type="submit">
            <span class="fas fa-check"></span>Submit
          </button>
        </div>
      </div>
</form>
<script>
    $(document).ready(function() {
   console.log("Document ready!");
   $('#staff_id').select2();
 });
   </script>
