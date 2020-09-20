define(['jquery','Magento_Ui/js/modal/alert'],function($,alert){
    'use strict';
    return function showWeddingInfo(){
        var getInfoUrl = $("#get-info-url").val();

        $("#btn-detail").click(function(){

            var brideEmail = $("#bride_email").val();
            var groomEmail = $("#groom_email").val();

            $.post(getInfoUrl,
                {
                    "bride_email":brideEmail,
                    "groom_email":groomEmail
                },
                function(res){
                    if(res.length===0){
                        $("#form-info").css("display","none");
                        alert({
                            title: "wedding event",
                            content: "We can't find any wedding event"
                        });
                    }else {

                        var addToCartPostParamUrl = $("#get-add-to-cart-post-param-url").val();

                        $.get(addToCartPostParamUrl+"id/"+res.id,function(resAddToCartParam){

                            $("#product").val(resAddToCartParam['data']['product']);
                            $("#submit-add-to-cart-url").val(resAddToCartParam['action']);

                            $("#wedding-title").text(res.title);
                            $("#groom-name").text(res.groom_firstname+" "+res.groom_lastname);
                            $("#bride-name").text(res.bride_firstname+" "+res.bride_lastname);
                            $("#form-info").css("display","block");
                        });
                    }
                }
            );
        });

    }
})
