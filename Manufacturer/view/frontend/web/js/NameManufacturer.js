define(['jquery','Magento_Ui/js/modal/alert'],function ($, alert){
    "use strict";
    return function nameManufacturer(){
        $("#show").click(function (e){
            e.preventDefault();
            let href = $(this).attr('href');
            let value = $(this).text();
            $.post(href,{ text : value},function (data){
                alert({
                    title: $.mage.__('Manufacturer Information'),
                    content: '<p><b>Name: </b> ${data.name}</p>' +
                        '<p><b>Street Address: </b> ${data.street_address}</p>' +
                        '<p><b>City: </b> ${data.address_city}</p>' +
                        '<p><b>Country: </b> ${data.address_country}</p>' +
                        '<p><b>Contact name: </b> ${data.contact_name}</p>' +
                        '<p><b>Contact telephone: </b> ${data.contact_phone}</p>',
                });
            });
        });
    }
});
