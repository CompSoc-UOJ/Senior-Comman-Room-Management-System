$(document).ready(function () {
    const DOMAIN = "http://localhost/inv_project/public_html";
    let body = $("body");


        //----------Search Form-------------

    $("#searchValue").click(function(){
        $('.search_form_buttons').show();
    });


    //----------Search Form submission-------------

    function load_data(query, search_type, pn)
    {
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method:"POST",
            data:{query:query, search_type:search_type, pageno: pn},
            success:function(data)
            {
                $('#get_search').html(data);
            }
        });
    }

    $('#search_form').submit(function(){
        prepare_data(1);
    });

    function prepare_data(pn){
        const search = $("#searchValue").val();
        const search_type = $('input[name="search_bar_radio"]:checked').val();
        if(search !== '')
        {
            load_data(search, search_type, pn);
        }
        else
        {
            load_data();
        }
    }

    //page Number Buttons
    body.delegate(".page-link", "click", function () {
        const pn = $(this).attr("pn");
        prepare_data(pn);
    });
});

