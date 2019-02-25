<?php
include_once("./database/constants.php");
if($_SESSION["usertype"] != "admin") {
	header("location:".DOMAIN."/");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SCR Management System @ University of Jaffna</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 	<script type="text/javascript" src="./js/purchase.js" async></script>

 </head>
<body>
<div class="overlay"><div class="loader"></div></div>
	<!-- Navbar -->
	<?php include_once("./templates/header.php"); ?>
	<br/><br/>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 mx-auto">
				<center class="card" style="box-shadow:0 0 25px 0 lightgrey;">
				  <div class="card-header">
				   	<h4>New Purchase</h4>
				  </div>
				  <center class="card-body">
				  	<form id="get_purchase_data" onsubmit="return false">
				  		<div class="form-group row">
				  			<label class="col-sm-3 col-form-label" align="right">Purchase Date</label>
				  			<div class="col-sm-6">
				  				<input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>">
				  			</div>
				  		</div>
				  		<div class="form-group row">
				  			<label class="col-sm-3 col-form-label" align="right">Supplier Name*</label>
				  			<div class="col-sm-6">
				  				<select id="cust_name" name="cust_name"class="form-control form-control-sm" required>
									</select>
				  			</div>
				  		</div>
				  		<div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
				  			<div class="card-body">
				  				<h3>Make a order list</h3>
				  				<table align="center" style="width:100%;">
										<thead>
											<tr>
												<th>#</th>
												<th style="text-align:center;">Item Name</th>
												<!-- <th style="text-align:center;">Supplier Name</th> -->
												<th style="text-align:center;">Available Quantity</th>
												<th style="text-align:center;">Buying Quantity</th>
												<th style="text-align:center;">Price Per Item</th>
												<th style="text-align:center;">Total Cost</th>
											</tr>
										</thead>
										<tbody id="invoice_item">

										</tbody>
									</table> <!--Table Ends-->
										<center style="padding:10px;">
											<button id="add" style="width:150px;" class="btn btn-success">Add</button>
											<button id="remove" style="width:150px;" class="btn btn-danger">Remove</button>
										</center>
				  			</div> <!--Crad Body Ends-->
				  		</div> <!-- Order List Crad Ends-->

				  		<p></p>
                    <div class="form-group row">
                      <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                      <div class="col-sm-6">
                        <input type="text" readonly name="sub_total" class="form-control form-control-sm" id="sub_total" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <!-- <label for="gst" class="col-sm-3 col-form-label" align="right">GST (18%)</label> -->
                       <!-- <div class="form-group row">
                      <label for="gst" class="col-sm-3 col-form-label" align="right">GST (18%)</label>
                      <div class="col-sm-6">
                        <input type="hidden" value="1" readonly name="gst" class="form-control form-control-sm" id="gst" required/>
                      </div>
                    </div> -->
                    </div>
                    <div class="form-group row">
                      <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                      <div class="col-sm-6">
                        <input type="text" name="discount" class="form-control form-control-sm" id="discount"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                      <div class="col-sm-6">
                        <input type="text" readonly name="net_total" class="form-control form-control-sm" id="net_total" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                      <div class="col-sm-6">
                        <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                      <div class="col-sm-6">
                        <input type="text" readonly name="due" class="form-control form-control-sm" id="due" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                      <div class="col-sm-6">
                        <select name="payment_type" class="form-control form-control-sm" id="payment_type" required>
                          <option>Cash</option>
                          <option>Card</option>
                          <option>Account</option>
                          <option>Cheque</option>
                        </select>
                      </div>
                    </div>
										<input name="cashier" type="hidden" value="<?php echo $_SESSION["userid"]; ?>" class="form-control form-control-sm cashier">
										<input name="typ" type="hidden" value="purchase" class="form-control form-control-sm typ">

										<center>
                      <input type="submit" id="purchase_form" style="width:150px;" class="btn btn-info" value="Order">
                      <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                    </center>
										
				  	</form>
				  </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>