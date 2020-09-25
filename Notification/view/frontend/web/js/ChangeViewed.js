define(['jquery'],function ($){
    'use strict';
    return function changeViewed (){
        $(".mark_as_read").click(function (e){
            e.preventDefault();
            let customLink = "http://mage.local/notification/notification/changeviewed";
            let val = $(this).attr('id');
            $.get(customLink, {val: val}, function (data){
                window.location.reload(true);
            });
        });
    };
});
