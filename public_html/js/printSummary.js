$(document).ready(function () {
    const DOMAIN = "http://localhost/inv_project/public_html";

    $("#print_current_summary").on("click", function () {
        const stdate = $("#start_date").val();
        const eddate = $("#end_date").val();
        const selectType = $('input[name="typradio"]:checked').val();
        const selectOption = $('input[name="optradio"]:checked').val();

        let table = $('#get_summary').tableToJSON({
            ignoreColumns: [0]
        });

        table = JSON.stringify(table);

        $.ajax({
            url: DOMAIN + "/includes/sale_summary.php",
            method: "POST",
            data:  { 'tableData' : table , 'startDate' : stdate, 'endDate' : eddate, 'selectType' : selectType, 'selectOption' : selectOption},
            success: function (data) {
                console.log(data);
            }
        });

    });

});

