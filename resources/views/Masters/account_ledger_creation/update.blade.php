<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
<form onsubmit="return validateForm()" action="javascript:insert_update_row('<?php echo $ledger_name['id']; ?>',ledger_name.value,description.value)">

            <div class="form-group">
                 <label class="stl">Ledger Name</label> <label style="color:red">*</label>
                <input type="text" id="ledger_name" class="form-control" value="<?php echo $ledger_name['ledger_name']; ?>" >
                <p id="error_message" style="color: red; display: none;">Please enter Ledger Name.</p>
            </div>


            <div class="form-group">
                 <label for="description" class="stl">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?php echo $ledger_name['description']; ?></textarea>
            </div>
    <div class="row">
        <div class="col-md-6">
          <button class="btn btn-icon icon-left btn-danger" data-dismiss="modal" aria-label="Close">
            <span class="fas fa-times"></span>Cancel
          </button>
        </div>
        <div class="col-md-6 text-right">
          <button class="btn btn-icon icon-left btn-success" type="submit">
            <span class="fas fa-check"></span>Update
          </button>
        </div>
      </div>
    </form>
      </div>
    </div>
</div>
<script>
    function validateForm() {
    var subExpenseType = document.getElementById('ledger_name');
    var errorMessage = document.getElementById('error_message');

    if (subExpenseType.value.trim() === '') {
        subExpenseType.style.borderColor = 'red';
        errorMessage.style.display = 'block';
      return false;
    } else {
      subExpenseType.style.borderColor = '';
      subExpenseType.classList.remove('blink');
      errorMessage.style.display = 'none';
    }

}
  </script>