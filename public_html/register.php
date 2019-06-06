<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SCR Management System @ University of Jaffna</title>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
            integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="./Password-Strength/password_strength/password_strength_lightweight.js"></script>
    <link rel="stylesheet" href="./Password-Strength/password_strength/password_strength.css">
    <script type="text/javascript" src="./js/main.js" async></script>

</head>
<body>
<div class="overlay">
    <div class="loader"></div>
</div>
<!-- Navbar -->
<?php include_once("./templates/header.php"); ?>
<br/><br/>
<div class="container">
    <div class="card mx-auto" style="width: 30rem;">
        <div class="card-header" style="text-align: center;">Register</div>
        <div class="card-body">
            <form id="register_form" onsubmit="return false;" autocomplete="off">

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
                    <small id="eid_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                           placeholder="Enter email (example@example.com)"/>
                    <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="email">Contact Number</label>
                    <input type="text" name="contactno" class="form-control" id="contactno" aria-describedby="emailHelp"
                           placeholder="Enter Contact No (94123456789)"/>
                    <small id="cn_error" class="form-text text-muted">We'll never share your contact-no with anyone
                        else.
                    </small>
                </div>
                <div class="form-group">
                    <div id="myPassword"></div>
                    <small id="p1_error" class="form-text text-muted"></small>
                </div>
                <!-- <div class="form-group">
                    <label for="password1">Password</label>
                    <input type="password" name="password1" class="form-control" id="password1" placeholder="Password (Minimum 9 Characters)"/>
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
<!--                        <option value="Canteen Staff">Canteen Staff</option>-->
                        <option value="SCR Member">SCR Member</option>
                    </select>
                    <small id="t_error" class="form-text text-muted"></small>
                </div>
                <input type="hidden" name="status" id="status" value="0"/>
                <button type="submit" name="user_register" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Register
                </button>
                <span><a href="index.php">Login</a></span>
            </form>
        </div>
        <div class="card-footer text-muted">
        </div>
    </div>
</div>

</body>
</html>