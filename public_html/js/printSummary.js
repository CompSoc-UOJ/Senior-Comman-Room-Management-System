$(document).ready(function () {
    const DOMAIN = "http://localhost/inv_project/public_html";

    $("#print_current_summary").on("click", function () {
        let table = $('#get_summary').tableToJSON({
            ignoreColumns: [0]
        });
        table = JSON.stringify(table);
        $.ajax({
            url: DOMAIN + "/includes/sale_summary.php",
            method: "POST",
            data: "tableData=" + table,
            success: function (data) {
                alert(data);
            }
        });
    });

});

