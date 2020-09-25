define(['jquery'],function ($){
    'use strict';
    return function deleteNotification (){
        $(".delete_notification").click(function (e){
            e.preventDefault();
            let customLink = "http://mage.local/notification/notification/deletenotification";
            let val = $(this).attr('id');
            $.get(customLink, {val: val}, function (data){
                window.location.reload(true);
            });
        });
    };
});
