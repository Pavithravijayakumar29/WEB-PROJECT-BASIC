<script>
    $(document).ready(function() {
        $('#country_id').select2();
    });
</script>
<style>
      .select2-container--default .select2-selection--single .select2-selection__rendered {
        width: 350px;
        min-height: 42px;
        line-height: 42px;
        padding-left: 20px;
        padding-right: 20px;
        /* background-color: #fcfcff; */
        /* border: 1px solid #e4e6fc !important; */
        font-size: 15px;
        font-weight: normal;
    }
</style>


<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">

<form action="javascript:insert_update_row('',country_id.value,state_name.value,description.value)">
    <div class="form-group">
          <label  class="stl">Country Name</label><label style="color:red">*</label>
                <div>
                    <select class="form-control select2" id="country_id">
                        <option value=''>--Select Country--</option>
                        <?php foreach( $country_name as  $country_name1){ ?>
                        <option value="<?php echo  $country_name1['id']; ?>"><?php echo $country_name1['country_name']; ?></option>
                        <?php } ?>
                    </select>
                    
                    <div id="country_id_validate_div" style="color:red;"></div>
                </div></div>
            <div class="form-group">
                   <label class="stl">State Name</label><label style="color:red">*</label>
                <input type="text" id="state_name" class="form-control"  placeholder="Enter State Name">
               
                <div id="state_name_validate_div" style="color:red;"></div>
        </div>
            <div class="form-group">
                   <label for="description" class="stl">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="4"></textarea>
        </div>
    {{-- <div class="row">
        <div class="col-md-12 text-right">
            <button class="btn btn-icon btn-success" type="submit">Submit</button>
            <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
        </div>
    </div> --}}
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
</div>
</div>
</div>
<script>
    function validateForm() {

    var subExpenseType = document.getElementById('state_name');
    var errorMessage = document.getElementById('error_message');
    var errorMessage_1 = document.getElementById('error_message_1');

    var expense_type = $('#country_id').val();
    if(expense_type==0){

        errorMessage.style.display = 'block';
        return false;
    }else{

        errorMessage.style.display = 'none';
    }

    if (subExpenseType.value.trim() === '') {

        subExpenseType.style.borderColor = 'red';
        errorMessage_1.style.display = 'block';
        return false;
    } else {
      subExpenseType.style.borderColor = '';
      errorMessage_1.style.display = 'none';
    }
    return true;
}
  </script>
