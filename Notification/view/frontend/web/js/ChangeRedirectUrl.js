define(['jquery'],function ($){
    'use strict';
    return function changeUrl (){
        $(".view_detail_change_redirect_url").click(function (e){
            e.preventDefault();
            let customLink = 'http://mage.local/notification/notification/changeurl';
            let href = $(this).attr('href');
            let val = $(this).attr('id');
            $.get(customLink, {href: href, val: val},function (data){
                window.open(href);
            });
        });
    }
});
