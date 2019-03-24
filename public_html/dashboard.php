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
    <script type="text/javascript" src="./js/main.js" async></script>
    <script type="text/javascript" src="./js/manage.js" async></script>

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="./Password-Strength/password_strength/password_strength_lightweight.js"></script>
    <link rel="stylesheet" href="./Password-Strength/password_strength/password_strength.css">

</head>
<body>
<!-- Navbar -->
<?php include_once("./templates/header.php"); ?>
<br/><br/>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card mx-auto" style="border:solid 1px #777">
                <img class="card-img-top mx-auto" style="width:60%;" src="./images/user.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">Profile Info</h4>
                    <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $_SESSION["username"]; ?></p>
                    <p class="card-text"><i class="fa fa-user">&nbsp;</i><?php echo $_SESSION["usertype"]; ?></p>
                    <p class="card-text">Last Login : <?php echo $_SESSION["last_login"]; ?></p>
                    <a href="#" eid="<?php echo $_SESSION["userid"]; ?>" data-toggle="modal"
                       data-target="#form_update_me" class="btn btn-primary edit_people"><i class="fa fa-edit">&nbsp;</i>Edit
                        Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="jumbotron" style="border:solid 1px #777" width="100%" height="100%">
                <div class="row">
                    <div class="col-sm-4">
                        <table>
                            <tr>
                                <td style="text-align: center;">
                                    <canvas id="canvas_tt5c33a0e4b9ffd" width="225%" height="225%"></canvas>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-weight: bold"><a
                                            href="//24timezones.com/world_directory/current_colombo_time.php"
                                            style="text-decoration: none" class="clock24"
                                            id="tz24-1546887396-c1389-eyJzaXplIjoiMTc1IiwiYmdjb2xvciI6IjAwOTlGRiIsImxhbmciOiJlbiIsInR5cGUiOiJhIiwiY2FudmFzX2lkIjoiY2FudmFzX3R0NWMzM2EwZTRiOWZmZCJ9"
                                            title="local time in Colombo" target="_blank" rel="nofollow">Colombo
                                        time</a></td>
                            </tr>
                        </table>
                        <script type="text/javascript" src="//w.24timezones.com/l.js" async></script>
                    </div>

                    <div class="col-sm-4">
                        <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffcc&amp;src=en.lk%23holiday%40group.v.calendar.google.com&amp;color=%230F4B38&amp;ctz=Asia%2FColombo"
                                style="border:solid 1px #777" width="225%" height="100%" frameborder="0"
                                scrolling="no"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<p></p>
<p></p>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card" style="border:solid 1px #777">
                <div class="card-body">
                    <h4 class="card-title">Items</h4>
                    <p class="card-text">Here you can manage your items and add new items to the inventory.</p>
                    <a href="#" data-toggle="modal" data-target="#form_products" class="btn btn-primary">Add</a>
                    <a href="manage_product.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border:solid 1px #777">
                <div class="card-body">
                    <h4 class="card-title">Sales</h4>
                    <p class="card-text">Here you can manage your Sales and you can add new Sales.</p>
                    <a href="new_order.php" class="btn btn-primary">Add</a>
                    <a href="manage_sale.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border:solid 1px #777">
                <div class="card-body">
                    <h4 class="card-title">Purchases</h4>
                    <p class="card-text">Here you can manage your Purchases and you can add new Purchases.</p>
                    <a href="new_purchase.php" class="btn btn-primary">Add</a>
                    <a href="manage_purchase.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border:solid 1px #777">
                <div class="card-body">
                    <h4 class="card-title">People</h4>
                    <p class="card-text">Here you can manage your users and you can add new users.</p>
                    <a href="#" data-toggle="modal" data-target="#register_form" class="btn btn-primary">Register</a>
                    <a href="manage_people.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3">
            <div class="card" style="border:solid 1px #777">
                <div class="card-body">
                    <h4 class="card-title">Sales Summary</h4>
                    <p class="card-text">Here you can view your users billing summaries.</p>
                    <br>
                    <div style="text-align: center;">
                        <a href="manage_summary.php" class="btn btn-primary btn-block">View</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border:solid 1px #777">
                <div class="card-body">
                    <h4 class="card-title">My Summary</h4>
                    <p class="card-text">Here you can see your billing summaries.</p>
                    <br>
                    <div style="text-align: center;">
                        <a href="common/view_summary.php" class="btn btn-primary btn-block">View</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border:solid 1px #777">
                <div class="card-body">
                    <h4 class="card-title">Categories</h4>
                    <p class="card-text">Here you can manage your item categories of your current sales.</p>
                    <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary">Add</a>
                    <a href="manage_categories.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border:solid 1px #777">
                <div class="card-body">
                    <h4 class="card-title">Suppliers</h4> <!-- Brands -->
                    <p class="card-text">Here you can manage your item suppliers and you can add new suppliers.</p>
                    <a href="#" data-toggle="modal" data-target="#form_brand" class="btn btn-primary">Add</a>
                    <a href="manage_brand.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//Update Register Form
include_once("./templates/update_me.php");

//Categpry Form
include_once("./templates/category.php");

//Brand Form
include_once("./templates/brand.php");

//Products Form
include_once("./templates/products.php");

//Register Form
include_once("./templates/registerinside.php");
?>

</body>
</html>