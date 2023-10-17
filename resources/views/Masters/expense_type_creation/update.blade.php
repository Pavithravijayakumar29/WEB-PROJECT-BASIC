
<form action="javascript:insert_update_row('<?php echo $expense_type['id']; ?>',expense_type.value,description.value)">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Expense Type<b class="mark_label_red">*</b></label>
                <input type="text" id="expense_type" class="form-control" value="<?php echo $expense_type['expense_type']; ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="stl">Description</label>
                <textarea class="form-control" id="description" name="description"  rows="4"><?php echo $expense_type['description']; ?></textarea>
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
                <span class="fas fa-check"></span>Update
            </button>
        </div>
    </div>

    </form>
