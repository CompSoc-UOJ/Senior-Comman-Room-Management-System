<?php
include_once("./database/constants.php");
if ($_SESSION["usertype"] != "admin") {
    header("location:" . DOMAIN . "/");
}
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SCR Management System @ University of Jaffna</title>
    <script src="//code.jquery.com/jquery-1.11.2.min.js" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
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

    <script src="./Password-Strength/password_strength/password_strength_lightweight.js" async></script>
    <script type="text/javascript" src="./table-to-json-master/lib/jquery.tabletojson.min.js" async></script>
    <script type="text/javascript" src="./js/manage.js" async></script>
    <script type="text/javascript" src="./js/printSummary.js" async></script>


</head>
<body>
<!-- Navbar -->
<?php include_once("./templates/header.php"); ?>
<br/><br/>
<div class="container-fluid">
    <div style="text-align: center;">
        <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
            <div class="card-body container">
                <form id="date_select_form" onsubmit="return false">
                    <h3>I want to see details between</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><strong>Start Date</strong></label>
                            <label for="start_date"></label><input type="date" class="form-control" name="start_date"
                                                                   id="start_date" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong>End Date</strong></label>
                            <label for="end_date"></label><input type="date" class="form-control" name="end_date"
                                                                 id="end_date" required/>
                        </div>
                    </div>
                    <br>
                    <h3>And I want to see details of</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="radio" class="form-check-input" value="user_wise"  name="typradio" checked="checked"><strong>Users/Suppliers</strong>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="radio" class="form-check-input" value="product_wise"  name="typradio"><strong>Food Items</strong>
                        </div>
                    </div>
                    <br>
                    <h3>But I want to see details in</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="radio" class="form-check-input" value="in_sales"  name="optradio" checked="checked"><strong>In Sales</strong>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="radio" class="form-check-input" value="in_purchases" name="optradio"><strong>In Purchases</strong>
                        </div>
                    </div>
                    <div style="padding:10px; text-align: center;">
                        <button id="search" style="width:150px;" class="btn btn-success">Search</button>
                        <button type="reset" id="clear" style="width:150px;" class="btn btn-danger">Clear</button>
                    </div>
                </form>
            </div> <!--Card Body Ends-->
        </div>
        <p></p>
        <table id="get_summary" class="table table-hover table-bordered">

            <!--on manage.js-->

        </table>
        <div style="text-align: center;">
            <input type="submit" id="print_current_summary" style="width:150px;" class="btn btn-success d-none"
                   value="Print Summary">
        </div>
        <br>
    </div>
</div>
</body>
</html>
