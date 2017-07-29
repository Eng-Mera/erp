$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

    $('.btnNext').click(function(){
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function(){
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    });


    $("#orders-customer_id").change(function(){
        // $("#customers-name").val("test");
    });

});

function getCustomer(number)
{
    if (number == '' || number == null)
    {
        $("#customers-name").val('').removeAttr("disabled");
        $("#customers-email").val('').removeAttr("disabled");
        $("#customers-facebook").val('').removeAttr("disabled");
        $("#customers-phone1").val('').removeAttr("disabled");
        $("#customers-phone2").val('').removeAttr("disabled");
        $("#customers-address1").val('').removeAttr("disabled");
        $("#customers-address2").val('').removeAttr("disabled");
        $("#customers-city").val('').removeAttr("disabled");
        $("#customers-gov").val('').removeAttr("disabled");
    }
    $.ajax({
        url: '/orders/getcustomer?num='+number ,
        type: "POST",
            success: function(data){
                var customer = JSON.parse(data);
                $("#customers-name").val(customer['name']).attr("disabled","disabled");
                $("#customers-email").val(customer['email']).attr("disabled","disabled");
                $("#customers-facebook").val(customer['facebook']).attr("disabled","disabled");
                $("#customers-phone1").val(customer['phone1']).attr("disabled","disabled");
                $("#customers-phone2").val(customer['phone2']).attr("disabled","disabled");
                $("#customers-address1").val(customer['address1']).attr("disabled","disabled");
                $("#customers-address2").val(customer['address2']).attr("disabled","disabled");
                $("#customers-city").val(customer['city']).attr("disabled","disabled");
                $("#customers-gov").val(customer['gov']).attr("disabled","disabled");
            },
        error: function(){
            console.log("failure");
            $("#customers-name").val('').removeAttr("disabled");
            $("#customers-email").val('').removeAttr("disabled");
            $("#customers-facebook").val('').removeAttr("disabled");
            $("#customers-phone1").val('').removeAttr("disabled");
            $("#customers-phone2").val('').removeAttr("disabled");
            $("#customers-address1").val('').removeAttr("disabled");
            $("#customers-address2").val('').removeAttr("disabled");
            $("#customers-city").val('').removeAttr("disabled");
            $("#customers-gov").val('').removeAttr("disabled");
        }
    });
}