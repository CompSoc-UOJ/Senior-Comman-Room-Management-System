$(document).ready(function(){
	var DOMAIN = "http://localhost/inv_project/public_html";
	$("#register_form").on("submit",function(){
		var count = 0;
		var name = $("#username");
		var employeeid = $("#employeeid");
		var email = $("#email");
		var contactno = $("#contactno");
		var pass1 = $("#password1");
		var pass2 = $("#password2");
		var type = $("#usertype");
		
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		if(name.val() == "" || name.val().length < 6){
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Please Enter Name and Name should be more than 6 char</span>");
		}else{
			name.removeClass("border-danger");
			$("#u_error").html("");
			count++;
		}
		if(employeeid.val() == "" || employeeid.val().length < 6){
			employeeid.addClass("border-danger");
			$("#eid_error").html("<span class='text-danger'>Please Enter Employee ID and Employee ID should be more than 6 char</span>");
		}else{
			employeeid.removeClass("border-danger");
			$("#eid_error").html("");
			count++;
		}
		if(!e_patt.test(email.val())){
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			count++;
		}
		if(contactno.val() == "" || contactno.val().length < 9){
			contactno.addClass("border-danger");
			$("#cn_error").html("<span class='text-danger'>Please Enter Contact-No and Contact-No should be more than 9 numbers</span>");
		}else{
			contactno.removeClass("border-danger");
			$("#cn_error").html("");
			count++;
		}
		if(pass1.val() == "" || pass1.val().length < 9){
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
		}else{
			pass1.removeClass("border-danger");
			$("#p1_error").html("");
			count++;
		}
		if(pass2.val() == "" || pass2.val().length < 9){
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
		}else{
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
			count++;
		}
		if(type.val() == ""){
			type.addClass("border-danger");
			$("#t_error").html("<span class='text-danger'>Please select User type</span>");
		}else{
			type.removeClass("border-danger");
			$("#t_error").html("");
			count++;
		}
		if ((pass1.val() == pass2.val()) && count == 7 ) {
			$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#register_form").serialize(),
				success : function(data){
					if (data == "USERNAME_ALREADY_EXISTS") {
						$(".overlay").hide();
						alert("It seems like you user name is already used");
					}else if(data == "EMPLOYEEID_ALREADY_EXISTS"){
						$(".overlay").hide();
						alert("It seems like you employee id is already used");
					}else if(data == "EMAIL_ALREADY_EXISTS"){
						$(".overlay").hide();
						alert("It seems like you email is already used");
					}else if(data == "SOME_ERROR"){
						$(".overlay").hide();
						alert("Something Wrong");
					}else{
						$(".overlay").hide();
						alert("You are registered Now you can login");
						window.location.href = "";
						// window.location.href = encodeURI(DOMAIN+"/index.php?msg=You are registered Now you can login");
					}
				}
			})
		}else{
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password is not matched</span>");
		}
	})

	//For Login Part
	$("#form_login").on("submit",function(){
		var email = $("#log_email");
		var pass = $("#log_password");
		var status = false;
		if (email.val() == "") {
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
			status = false;
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			status = true;
		}
		if (pass.val() == "") {
			pass.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
			status = false;
		}else{
			pass.removeClass("border-danger");
			$("#p_error").html("");
			status = true;
		}
		if (status) {
			$(".overlay").show();
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#form_login").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERD") {
						$(".overlay").hide();
						email.addClass("border-danger");
						$("#e_error").html("<span class='text-danger'>It seems like you are not registered</span>");
					}else if(data == "PASSWORD_NOT_MATCHED"){
						$(".overlay").hide();
						pass.addClass("border-danger");
						$("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
						status = false;
					}else{
						$(".overlay").hide();
						console.log(data);
						window.location.href = DOMAIN+"/dashboard.php";
					}
				}
			})
		}
	})

	$("body").delegate(".page-link","click",function(){
		$("#parent_cat2").html(root+data);
		$("#select_cat2").html(choose+data);
	})

	//Fetch category
	fetch_category();
	function fetch_category(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getCategory:1},
			success : function(data){
				var root = "<option value='0'>Root</option>";
				var choose = "<option value=''>Choose Category</option>";
				$("#parent_cat2").html(root+data);
				$("#select_cat2").html(choose+data); //vikum ayya
			}
		})
	}

	//Fetch Brand
	fetch_brand();
	function fetch_brand(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getBrand:1},
			success : function(data){
				var choose = "<option value=''>Choose Supplier</option>";
				$("#select_brand2").html(choose+data);
			}
		})
	}

	//Add Category
	$("#category_form").on("submit",function(){
		if ($("#category_name").val() == "") {
			$("#category_name").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
		}else{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data  : $("#category_form").serialize(),
				success : function(data){
					if (data == "CATEGORY_ADDED") {
						alert("New Category Added Successfully..!");
						// $("#category_name").removeClass("border-danger");
						// $("#cat_error").html("<span class='text-success'>New Category Added Successfully..!</span>");
						// $("#category_name").val("");
						fetch_category();
						window.location.href = "";
					}else{
						alert("Sorry this category already exists.");
					}
				}
			})
		}
	})

	//Add Brand
	$("#brand_form").on("submit",function(){
		if ($("#brand_name").val() == "") {
			$("#brand_name").addClass("border-danger");
			$("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
		}else if ($("#s_contactno").val() != "" && $("#s_contactno").val().length < 9) {
			$("#s_contactno").addClass("border-danger");
			$("#scn_error").html("<span class='text-danger'>Please Enter valid Contact No</span>");
		}else if ($("#address").val() == "") {
			$("#address").addClass("border-danger");
			$("#adr_error").html("<span class='text-danger'>Please Enter Address</span>");
		}else{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#brand_form").serialize(),
				success : function(data){
					if (data == "BRAND_ADDED") {
						alert("New Brand Added Successfully..!");
						fetch_brand();
						window.location.href = "";
					}else{
						alert(data);
					}		
				}
			})
		}
	})

	//add product
	$("#product_form").on("submit",function(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : $("#product_form").serialize(),
			success : function(data){
				if (data == "NEW_PRODUCT_ADDED") {
					alert("New Product Added Successfully..!");
					$("#product_name").val("");
					$("#select_cat2").val("");
					$("#select_brand2").val("");
					$("#product_price").val("");
					$("#product_qty").val("");
					window.location.href = "";
				}else{
					alert(data);
				}	
			}
		})
	})
})