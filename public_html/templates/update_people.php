<!-- Modal -->
<div class="modal fade" id="form_update_people" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_people_form" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="hidden" name="id" id="id" value=""/>
              <label>Date</label>
              <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d"); ?>" readonly/>
            </div>
            <div class="form-group col-md-6">
              <label>Full Name</label>
              <input type="text" class="form-control" name="update_name" id="update_name" placeholder="Edit Full Name" required/>
            </div>
          </div>
          <div class="form-group">
            <label>Employee ID</label>
            <input type="text" class="form-control" id="update_employeeid" name="update_employeeid" placeholder="Edit Employee ID" required/> 
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" id="update_email" name="update_email" placeholder="Edit Email" required/> 
          </div>
          <div class="form-group">
            <label>Contact-No</label>
            <input type="text" name="update_contactno" class="form-control" id="update_contactno" placeholder="Edit Contact No (94123456789)"/>
          </div>
          <div class="form-group">
            <label>User Type</label>
            <select name="update_type" class="form-control" id="update_type">
		              <option value="">Choose User Type</option>
		              <option value="Staff Member">Staff Member</option>
		              <option value="Canteen Staff">Canteen Staff</option>
		            </select>
          </div>
          <div class="form-group">
            <label>Notes</label>
            <input type="text" class="form-control" id="update_notes" name="update_notes" placeholder="Enter any notes here" />
          </div>
          <button type="submit" class="btn btn-success">Edit Profile</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>