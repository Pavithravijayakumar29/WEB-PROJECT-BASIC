<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
<form action="javascript:insert_update_row('',state_id.value,district_id1.value,area_name.value,description.value)">

        <div class="form-group">
               <label class="stl">State Name</label><label style="color: red">*</label>
            <select class="select2-search__field" id="state_id" name="state_id" onchange="getDistricts()">
                <option value="">--Select State--</option>
                @foreach ($state_name as $state)
                    <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                @endforeach
            </select>
            <div id="state_id_validate_div" class="mark_label_red"></div>
        </div>

        <div class="form-group">
                 <label class="stl">District Name</label><label style="color: red">*</label>
            <select class="select2-search__field" id="district_id1" name="district_id1">
                <option value="">--Select District--</option>
            </select>
            <div id="district_id_validate_div" class="mark_label_red"></div>

        </div>



            <div class="form-group">
                    <label class="stl">Market Name</label><label style="color: red">*</label>
                <input type="text" id="area_name" class="form-control"  placeholder="Enter Area Name">
                <div id="area_name_validate_div" class="mark_label_red"></div>
            </div>



            <div class="form-group">
                   <label for="description" class="stl">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="4"></textarea>
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
      </div>
    </div>
</div>
    <script>
$(document).ready(function() {
    $('#state_id').select2();
    $('#district_id1').select2();
});
</script>

<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered{
            width: 350px;
            min-height: 42px;
            line-height: 42px;
            padding-left: 20px;
            padding-right: 20px;
            }
                </style>


