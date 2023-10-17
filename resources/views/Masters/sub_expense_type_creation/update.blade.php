<script>
    function validateForm() {
    var expenseType = document.getElementById('expense_type');
    var subExpenseType = document.getElementById('sub_expense_type');


    // Check if expense type is not selected
    if (expenseType.value === '') {
      expenseType.style.borderColor = 'red';
      expenseType.classList.add('blink');
      return false;
    } else {
      expenseType.style.borderColor = '';
      expenseType.classList.remove('blink');
    }

    // Check if sub expense type is empty
    if (subExpenseType.value.trim() === '') {
      subExpenseType.style.borderColor = 'red';
      subExpenseType.classList.add('blink');
      return false;
    } else {
      subExpenseType.style.borderColor = '';
      subExpenseType.classList.remove('blink');
    }


    // Form validation passed
    return true;
  }
  </script>

  <style>
    .select2-selection__rendered {
      width: 350px !important;
    }

    @keyframes blink {
      50% {
        border-color: red;
      }
    }

    .blink {
      animation: blink 1s infinite;
    }
  </style>

  <form id="myForm" action="javascript:insert_update_row('<?php echo $expense_type['id']; ?>',expense_type.value,sub_expense_type.value,description.value)">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="stl"><b>Expense Type</b></label><br>
          <select class="select2" id="expense_type" width="100%">
            <option>--SELECT--</option>
            <?php
            $exp_type=$expense_type['expense_type'];
            foreach ($expense_type_sub as $expense_type1) { ?>
              <option value="<?php echo $expense_type1['id']; ?>" <?php if($exp_type==$expense_type1['id']){echo 'selected';} ?>><?php echo $expense_type1['expense_type']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="stl"><b>Sub Expense Type</b></label>
          <input type="text" id="sub_expense_type" class="form-control" value="<?php echo $expense_type['sub_expense_type']; ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="stl">Description</label>
          <textarea class="form-control" id="description" name="description" rows="4"><?php echo $expense_type['description']; ?></textarea>
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
        <button class="btn btn-icon icon-left btn-success" type="submit" onclick="validateForm()">
          <span class="fas fa-check"></span>Update
        </button>
      </div>
    </div>
  </form>

  <script>
    $(document).ready(function() {
      $('#expense_type').select2();
    });
  </script>
