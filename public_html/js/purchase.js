$(document).ready(function () {
    const DOMAIN = "http://localhost/inv_project/public_html";
    let invoice_item = $("#invoice_item");
    let cust_name = $("#cust_name");

    //Fetch Brand
    fetch_brand();

    function fetch_brand() {
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: {getBrand: 1},
            success: function (data) {
                const choose = "<option value=''>Choose Supplier</option>";
                cust_name.html(choose + data);
            }
        })
    }


    cust_name.change(function () {

        const supplier = cust_name.val();
        // $("#cust_name").attr("readonly", true);
        cust_name.prop('disabled', true);
        addNewRow();

        $("#add").click(function () {
            addNewRow();
        });

        function addNewRow() {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: {getNewPurchaseItem: 1, supplierID: supplier},
                success: function (data) {
                    $("#invoice_item").append(data);
                    let n = 0;
                    $(".number").each(function () {
                        $(this).html(++n);
                    })
                }
            })
        }

    });

    $("#remove").click(function () {
        $("#invoice_item").children("tr:last").remove();
        calculate(0, 0);
    });

    invoice_item.delegate(".pid", "change", function () {
        const pid = $(this).val();
        const tr = $(this).parent().parent();
        $(".overlay").show();
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            dataType: "json",
            data: {getPriceAndQty: 1, id: pid},
            success: function (data) {
                tr.find(".tpid").val(data["pid"]);
                tr.find(".pro_name").val(data["product_name"]);
                tr.find(".price").val("(Selling Price) " + data["product_price"]);
                tr.find(".tqty").val(data["product_stock"]);
                tr.find(".qty").val(0);
                tr.find(".amt").val(0);
                calculate(0, 0);
            }
        })
    });

    invoice_item.delegate(".qty", "change", function () {
        const qty = $(this);
        const tr = $(this).parent().parent();
        if (isNaN(qty.val())) {
            alert("Please enter a valid quantity");
            qty.val(0);
        } else {
            tr.find(".amt").val(qty.val() * tr.find(".price").val());
            calculate(0, 0);

        }
    });

    invoice_item.delegate(".price", "keyup", function () {
        const price = $(this);
        const tr = $(this).parent().parent();
        if (isNaN(price.val())) {
            alert("Please enter a valid price");
            price.val(0);
        } else {
            tr.find(".amt").val(price.val() * tr.find(".qty").val());
            calculate(0, 0);

        }
    });

    function calculate(dis, paid) {
        let sub_total = 0;
        // const gst = 0; //if purchase
        let net_total;
        const discount = dis;
        const paid_amt = paid;
        let due;
        $(".amt").each(function () {
            sub_total = sub_total + ($(this).val() * 1);
        });
        $("#sub_total").val(sub_total);

        // gst = 0.18 * sub_total;
        // net_total = gst + sub_total;


        // $("#gst").val(gst);

        // $("#discount").val(discount);

        net_total = sub_total - discount;
        $("#net_total").val(net_total);

        //$("#paid")

        due = paid_amt - net_total;
        $("#due").val(due);

    }

    $("#discount").keyup(function () {
        const discount = $(this).val();
        const paid = $("#paid").val();
        calculate(discount, paid);
    });

    $("#paid").keyup(function () {
        const paid = $(this).val();
        const discount = $("#discount").val();
        calculate(discount, paid);
    });

    /*Purchase Accepting*/
    $("#purchase_form").click(function () {
        const invoice = $("#get_purchase_data").serialize();
        if ($("#cust_name").val() === "") {
            alert("Please select supplier name");
        } else if ($("#paid").val() === "") {
            alert("Please enter paid amount");
        } else if ($(".cashier").val() === "") {
            alert("Invalid Cashier!!System Hacked!!");
        } else {
            const name = $("[name=cust_name]").find("option:selected").text();
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#get_purchase_data").serialize() + "&cust_name=" + $("#cust_name").val(),
                success: function (data) {

                    if (data < 0) {
                        alert(data);
                    } else {

                        // $("#get_purchase_data").trigger("reset");

                        if (confirm("Do u want to print invoice ?")) {
                            // window.location.href = DOMAIN+"/includes/invoice_bill.php?invoice_no="+data+"&"+invoice;
                            window.location.href = DOMAIN + "/includes/invoice_bill.php?name=" + name + "&" + "invoice_no=" + data + "&" + invoice;
                        }
                    }
                }
            });
        }
    });
});
