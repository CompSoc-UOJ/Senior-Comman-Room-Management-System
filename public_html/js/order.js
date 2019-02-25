$(document).ready(function(){
	var DOMAIN = "http://localhost/inv_project/public_html";

	//Fetch People
	fetch_people();
	function fetch_people(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getPeople:1},
			success : function(data){
				var choose = "<option value=''>Choose Customer</option>";
				$("#cust_name").html(choose+data);
			}
		})
	}

	addNewRow();
	$("#add").click(function(){
		addNewRow();
	})

	function addNewRow(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getNewOrderItem:1},
			success : function(data){
				$("#invoice_item").append(data);
				var n = 0;
				$(".number").each(function(){
					$(this).html(++n);
				})
			}
		})
	}

	$("#remove").click(function(){
		$("#invoice_item").children("tr:last").remove();
		calculate(0,0);
	})

	$("#invoice_item").delegate(".pid","change",function(){
		var pid = $(this).val();
		var tr = $(this).parent().parent();
		$(".overlay").show();
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			dataType : "json",
			data : {getPriceAndQty:1,id:pid},
			success : function(data){
				tr.find(".tpid").val(data["pid"]);
				tr.find(".pro_name").val(data["product_name"]);
				tr.find(".price").val(data["product_price"]);
				tr.find(".tqty").val(data["product_stock"]);
				tr.find(".qty").val(1);
				tr.find(".amt").val(tr.find(".qty").val() * tr.find(".price").val());
				calculate(0,0);
			}
		})
	})

	$("#invoice_item").delegate(".qty","change",function(){
		var qty = $(this);
		var tr = $(this).parent().parent();
		if (isNaN(qty.val())) {
			alert("Please enter a valid quantity");
			qty.val(1);
		}else{
			if ((qty.val() - 0) > (tr.find(".tqty").val()-0)) {
				alert("Sorry ! This much of quantity is not available");
				qty.val(1);
			}else{
				tr.find(".amt").val(qty.val() * tr.find(".price").val());
				calculate(0,0);
			}
		}
	})

	function calculate(dis,paid){
		var sub_total = 0;
		// var gst = 1; //if sale
		var net_total = 0;
		var discount = dis;
		var paid_amt = paid;
		var due = 0;

		$(".amt").each(function(){
			sub_total = sub_total + ($(this).val() * 1);
		})

		$("#sub_total").val(sub_total);

		// gst = 0.18 * sub_total;
		// net_total = gst + sub_total;
		// $("#gst").val(gst);
	
		// $("#discount").val(discount);
		
		net_total = sub_total - discount;
		$("#net_total").val(net_total);

		// $("#paid").val(paid_amt)

		due = paid_amt - net_total;
		$("#due").val(due);
	}

	$("#discount").keyup(function(){
		var discount = $(this).val();
		var paid = $("#paid").val();
		calculate(discount,paid);
	})

	$("#paid").keyup(function(){
		var paid = $(this).val();
		var discount = $("#discount").val();
		calculate(discount,paid);
	})

	/*Order Accepting*/
	$("#order_form").click(function(){
		var invoice = $("#get_order_data").serialize();
		if ($("#cust_name").val() === "") {
			alert("Plaese enter customer name");
		}else if($("#paid").val() === ""){
			alert("Please enter paid amount");
		}else if($(".cashier").val() === ""){
			alert("Invalid Cashier!!System Hacked!!");
		}else{
			var name = $("[name=cust_name]").find("option:selected").text();
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#get_order_data").serialize(),
				success : function(data){

					if (data < 0) {
						alert(data);
					}else{
						$("#get_order_data").trigger("reset");

						if (confirm("Do u want to print invoice ?")) {
							// window.location.href = DOMAIN+"/includes/invoice_bill.php?invoice_no="+data+"&"+invoice;
							window.location.href = DOMAIN+"/includes/invoice_bill.php?name="+name+"&"+"invoice_no="+data+"&"+invoice;
						}
					}
				}
			});
		}
	});
});