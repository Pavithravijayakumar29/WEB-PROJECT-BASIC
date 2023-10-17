<script>
    function validateForm_1() {
      var subExpenseType = document.getElementById('expense_type');
      var errorMessage = document.getElementById('error_message');

      if (subExpenseType.value.trim() === '') {
        subExpenseType.style.borderColor = 'red';
        subExpenseType.classList.add('blink');
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
    var subExpenseType = document.getElementById('expense_type');
    var errorMessage = document.getElementById('error_message');

    if (subExpenseType.value.trim() !== '') {
      subExpenseType.style.borderColor = 'green';
      subExpenseType.classList.remove('blink');
      errorMessage.style.display = 'none';
    }
  }
  </script>



<form onsubmit="return validateForm_1()" action="javascript:insert_update_row('',expense_type.value,description.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Expense Type<b class="mark_label_red">*</b></label>
            <input type="text" id="expense_type" class="form-control" oninput="changeColor()">
            <p id="error_message" style="color: red; display: none;">Please enter Expense Type.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" oninput="changeColor()"></textarea>
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
