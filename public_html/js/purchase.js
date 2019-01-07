$(document).ready(function(){
	var DOMAIN = "http://localhost/inv_project/public_html";

	//Fetch Brand
	fetch_brand();
	function fetch_brand(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getBrand:1},
			success : function(data){
				var choose = "<option value=''>Choose Supplier</option>";
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
			data : {getNewPurchaseItem:1},
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
				tr.find(".tqty").val(data["product_stock"]);
				tr.find(".pro_name").val(data["product_name"]);
				tr.find(".tpid").val(data["pid"]);
				tr.find(".qty").val(0);
				tr.find(".price").val("(Selling Price) "+data["product_price"]);
				tr.find(".amt").val(0);
				calculate(0,0);
			}
		})
	})

	$("#invoice_item").delegate(".qty","keyup",function(){
		var qty = $(this);
		var tr = $(this).parent().parent();
		if (isNaN(qty.val())) {
			alert("Please enter a valid quantity");
			qty.val(0);
		}else{
			
				tr.find(".amt").html(qty.val() * tr.find(".price").val());
				calculate(0,0);
			
		}
	})

	$("#invoice_item").delegate(".price","keyup",function(){
		var price = $(this);
		var tr = $(this).parent().parent();
		if (isNaN(price.val())) {
			alert("Please enter a valid price");
			price.val(0);
		}else{
			
				tr.find(".amt").html(price.val() * tr.find(".qty").val());
				calculate(0,0);
			
		}
	})

	function calculate(dis,paid){
		var sub_total = 0;
		// var gst = 0; //if purchase
		var net_total = 0;
		var discount = dis;
		var paid_amt = paid;
		var due = 0;
		$(".amt").each(function(){
			sub_total = sub_total + ($(this).html() * 1);
		})
		// gst = 0.18 * sub_total;
		// net_total = gst + sub_total;
		net_total = sub_total - discount;
		due = paid_amt - net_total;
		// $("#gst").val(gst);
		$("#sub_total").val(sub_total);
		$("#discount").val(discount);
		$("#net_total").val(net_total);
		//$("#paid")
		$("#due").val(due);

	}

	$("#discount").keyup(function(){
		var discount = $(this).val();
		calculate(discount,0);
	})

	$("#paid").keyup(function(){
		var paid = $(this).val();
		var discount = $("#discount").val();
		calculate(discount,paid);
	})


	/*Order Accepting*/
	
	$("#purchase_form").click(function(){
		var invoice = $("#get_purchase_data").serialize();
		alert(invoice);
		if ($("#cust_name").val() === "") {
			alert("Please select supplier name");
		}else if($("#paid").val() === ""){
			alert("Please enter paid amount");
		}else{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#get_purchase_data").serialize(),
				success : function(data){

					if (data < 0) {
						alert(data);
					}else{

						$("#get_purchase_data").trigger("reset");
						
						if (confirm("Do u want to print invoice ?")) {
							window.location.href = DOMAIN+"/includes/invoice_bill.php?invoice_no="+data+"&"+invoice;
						}
					}
				}
			});
		}
	});
});