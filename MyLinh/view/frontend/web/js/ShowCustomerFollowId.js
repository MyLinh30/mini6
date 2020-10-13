define(['jquery','Magento_Ui/js/modal/alert'],function ($,alert){
    'use strict';
    return function showCustomer(){
        $("#submit_button").click(function (e){
            e.preventDefault();
            let customLink = "http://mage.local/mylinh/vendor/index";
            let val = $("#id_customer").val();
            $.get(customLink,{val : val}, function (data) {
                var message="";
                if(data.status === 'notFound'){
                    message="Customer not found";
                }else{
                    message = `
                        ID: ${data.entity_id} <br>
                        Name: ${data.firstname+" "+data.lastname}<br>
                        Email: ${data.email}
                        `;
                }
                alert({
                    title: 'Customer Information',
                    content: message
                });
            });
        });
    }
});

