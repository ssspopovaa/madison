$(document).ready(function(){
    $("#submit").on('click', function () {
        $.ajax({
            url: '/discount',
            type: 'POST',
            data: {
                product_id: $("#product").val(),
                first_date: $("#first_date").val(),
                last_date: $("#last_date").val(),
                discont_price: $("#discount_price").val()
            },
            success: function (data){
            alert(data);
            }
            });
        });
    $("#method1").on('click', function () {
        $.ajax({
            url: '/method1',
            type: 'POST',
            data: {
                prod_id: $("#prod").val(),
                date: $("#date").val()    
            },
            success: function (data){
            alert(data);
            for (var key in data) {
            $("#result").empty().text(data[key].price);
            }
            }
            });
        });
        $("#method2").on('click', function () {
        $.ajax({
            url: '/method2',
            type: 'POST',
            data: {
                prod_id: $("#prod").val(),
                date: $("#date").val()    
            },
            success: function (data){
            alert(data);
            for (var key in data) {
            $("#result").empty().text(data[key].price);
            }
            }
            });
        });
 });