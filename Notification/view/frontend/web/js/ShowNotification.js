define(['jquery'],function ($){
    return function showNotification(){
        $("#select_item_to_show").change(function (e){
            e.preventDefault();
            let customerLink = 'http://mage.local/notification/notification/notificationchoose';
            let val = $( "#select_item_to_show option:selected" ).text();
            $.post(customerLink, { val: val}, function (data){
                var form = '<table  class="data table show" id="my-notification-table">' +
                    '<thead><tr><th>ID</th><th>Date</th><th>Short Description</th><th></th></tr></thead>';
                data.forEach(function (item,index){
                    form += `<tbody><tr><td>${item.entity_id}</td><td>${item.custom_prefix}</td><td>${item.firstname} ${item.lastname}</td><td>${item.email}</td></tr></tbody>`;
                });
                form +='</table></div>';
            })
        });
    }
})
