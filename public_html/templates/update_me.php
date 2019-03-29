<!-- Modal -->
<div class="modal fade" id="form_update_me" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_me_form" onsubmit="return false">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value=""/>
                        <label for="update_name">User Name</label>
                        <input type="text" name="update_name_me" class="form-control" id="update_name_me"
                               placeholder="User Name"/>
                        <small id="uname_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="update_employeeid">Employee ID</label>
                        <input type="text" name="update_employeeid" class="form-control" id="update_employeeid"
                               placeholder="Enter Employee ID"/>
                        <small id="u_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="update_email">Email address</label>
                        <input type="email" name="update_email" class="form-control" id="update_email"
                               aria-describedby="emailHelp"
                               placeholder="Enter email (example@example.com)"/>
                        <small id="e_error" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="update_contactno">Contact Number</label>
                        <input type="text" name="update_contactno" class="form-control" id="update_contactno"
                               aria-describedby="emailHelp" placeholder="Enter Contact No (94123456789)"/>
                        <small id="e_error" class="form-text text-muted">We'll never share your contact-no with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                     <label for="oldPassword">Old Password</label>
                     <input type="password" name="oldPassword" class="form-control" id="oldPassword" placeholder="Enter Old Password"/>
                     <small id="op_error" class="form-text text-muted"></small>
                   </div>
                    <div class="form-group">
                        <div id="myPassword1"></div>
                        <small id="p1_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="update_password2">Re-enter Password</label>
                        <input type="password" name="update_password2" class="form-control" id="update_password2"
                               placeholder="Confirm Password"/>
                        <small id="p2_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <input type="text" class="form-control" id="update_notes" name="update_notes"
                               placeholder="Enter any notes here (256 characters)"/>
                    </div>
                    <input type="hidden" name="update_status" id="update_status" value="0"/>
                    <button type="submit" class="btn btn-success">Edit Profile</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>