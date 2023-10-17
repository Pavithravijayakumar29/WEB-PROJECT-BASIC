
<script>
    function validateForm() {
    var subExpenseType = document.getElementById('sub_expense_type');
    var errorMessage = document.getElementById('error_message');
    var errorMessage_1 = document.getElementById('error_message_1');
    var expense_type = $('#expense_type').val();
    if(expense_type==0){

        errorMessage_1.style.display = 'block';
        return false;
    }else{

        errorMessage_1.style.display = 'none';
    }

    if (subExpenseType.value.trim() === '') {
      errorMessage.style.display = 'block';
      return false;
    } else {
      subExpenseType.style.borderColor = '';
      subExpenseType.classList.remove('blink');
      errorMessage.style.display = 'none';
    }

    return true;
  }
  function changeColor() {
    var subExpenseType = document.getElementById('sub_expense_type');
    var errorMessage = document.getElementById('error_message');

    if (subExpenseType.value.trim() !== '') {
      subExpenseType.style.borderColor = 'green';
      subExpenseType.classList.remove('blink');
      errorMessage.style.display = 'none';
    }
  }
  </script>

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

  <form id="myForm" onsubmit="return validateForm()" action="javascript:insert_update_row('',expense_type.value,sub_expense_type.value,description.value)">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="stl"><b>Expense Type<span style="color: red">*</span></b></label><br>
          <select class="select2" id="expense_type" width="100%">
            <option value="0">SELECT</option>
            <?php foreach ($expense_type as $expense_type1) { ?>
              <option value="<?php echo $expense_type1['id']; ?>"><?php echo $expense_type1['expense_type']; ?></option>
            <?php } ?>
          </select>
          <p id="error_message_1" style="color: red; display: none;">Please Select Expense</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="stl"><b>Sub Expense Type<span style="color: red">*</span></b></label>
          <input type="text" id="sub_expense_type" class="form-control" oninput="changeColor()">
          <p id="error_message" style="color: red; display: none;">Please enter Sub Expense.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="stl"><b>Description</b></label>
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
  $('#expense_type').select2();
});
  </script>
