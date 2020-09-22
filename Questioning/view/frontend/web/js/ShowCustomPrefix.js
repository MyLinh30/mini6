define(['jquery','Magento_Ui/js/modal/alert'],function ($,alert){
    'use strict';
    return function showCustomPrefix(){
        $("#btn_view_customer_same_prefix").click(function (e){
            e.preventDefault();
            let customerLink = 'http://mage.local/questioning/customer/show';
            $.get(customerLink, function (data){
                var form = '<div id="table_content"><table>' +
                    '<thead><th>ID</th><th>Custom Prefix</th><th>Full name</th><th>Email</th></thead>';
                data.forEach(function (item,index){
                    form += `<tbody><tr><td>${item.entity_id}</td><td>${item.custom_prefix}</td><td>${item.firstname} ${item.lastname}</td><td>${item.email}</td></tr></tbody>`;
                });
                form +='</table></div>';
                alert({
                    title: $.mage.__('View customers have same custom prefix'),
                    content: form,
                    buttons: [
                        {
                            text: $.mage.__('Close'),
                            class: 'action primary',
                            click: function ()
                            {
                                this.closeModal(true);
                             }},
                         {
                             text: $.mage.__('View all customer'),
                             class: 'action view-all',
                             click: function ()
                             {
                                 let cusLink = 'http://mage.local/questioning/customer/showall';
                                 $.get(cusLink,function (data){
                                    //$("#table_content").html("");
                                    var form = '<table><thead><th>ID</th><th>Custom Prefix</th><th>Full name</th><th>Email</th></thead>';
                                     data.forEach(function (item,index){
                                         form += `<tbody><tr><td>${item.entity_id}</td><td>${item.custom_prefix}</td><td>${item.firstname} ${item.lastname}</td><td>${item.email}</td></tr></tbody>`;
                                     });
                                     form +='</table>';
                                     console.log(form);
                                     //$("#table-content").html(form);
                                     $("#show_data").html(form);
                                });
                           }
                         }]
                 });
            });
        });
    };
});
