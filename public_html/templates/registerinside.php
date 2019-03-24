<!-- Modal -->
<div class="modal fade" id="register_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="register_form" onsubmit="return false" autocomplete="off">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="username">Title</label>
                                <label for="title"></label><select name="title" class="form-control" id="title">
                                    <option value="">Title</option>
                                    <option>Mr</option>
                                    <option>Mrs</option>
                                    <option>Miss</option>
                                    <option>Dr</option>
                                </select>
                                <small id="title_error" class="form-text text-muted"></small>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="username">First Name</label>
                                <input type="text" name="firstname" class="form-control" id="firstname"
                                       placeholder="First Name"/>
                                <small id="fname_error" class="form-text text-muted"></small>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="username">Last Name</label>
                                <input type="text" name="lastname" class="form-control" id="lastname"
                                       placeholder="Last Name"/>
                                <small id="lname_error" class="form-text text-muted"></small>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <div class="form-group">
                        <label for="employeeid">Employee ID</label>
                        <input type="text" name="employeeid" class="form-control" id="employeeid"
                               placeholder="Enter Employee ID"/>
                        <small id="u_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                               placeholder="Enter email (example@example.com)"/>
                        <small id="e_error" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="contactno">Contact Number</label>
                        <input type="text" name="contactno" class="form-control" id="contactno"
                               aria-describedby="emailHelp" placeholder="Enter Contact No (94123456789)"/>
                        <small id="e_error" class="form-text text-muted">We'll never share your contact-no with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                        <div id="myPassword"></div>
                        <small id="p1_error" class="form-text text-muted"></small>
                    </div>
                    <!-- <div class="form-group">
                      <label for="password1">Password</label>
                      <input type="password" name="password1" class="form-control" id="password1" placeholder="Password"/>
                      <small id="p1_error" class="form-text text-muted"></small>
                    </div> -->
                    <div class="form-group">
                        <label for="password2">Re-enter Password</label>
                        <input type="password" name="password2" class="form-control" id="password2"
                               placeholder="Confirm Password"/>
                        <small id="p2_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="usertype">Usertype</label>
                        <select name="usertype" class="form-control" id="usertype">
                            <option value="">Choose User Type</option>
                            <option value="Canteen Staff">Canteen Staff</option>
                            <option value="SCR Member">SCR Member</option>
                        </select>
                        <small id="t_error" class="form-text text-muted"></small>
                    </div>
                    <input type="hidden" name="status" id="status" value="1"/>
                    <button type="submit" name="user_register" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Register
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
