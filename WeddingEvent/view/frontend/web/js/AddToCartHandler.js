define(['jquery'],function($){
    'use strict';
    return function addToCartHandler(){

        $("#amount").change(function(){
            if($("#amount").val() >0){
                $("#custom-btn-add-to-card").prop("disabled",false);
            }else{
                $("#custom-btn-add-to-card").prop("disabled",true);
            }
        });

        $("#custom-btn-add-to-card").click(function(){
            var product = $("#product").val();
            var form_key= $("input[name=form_key]").val();
            var submitUrl= $("#submit-add-to-cart-url").val();
            var amount =$("#amount").val();

            $.post(submitUrl,
                {
                    product:product,
                    form_key:form_key,
                    qty:1,
                    amount:amount
                },
                function(res){

                });
        });
    }
})
