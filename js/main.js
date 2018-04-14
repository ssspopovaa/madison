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
        $("#chart").on('click', function () {
        $.ajax({
            url: '/chart',
            type: 'POST',
            data: {
                chart_id: $("#chart_prod").val(),
                chart_f: $("#chart_f").val(),
                chart_l: $("#chart_l").val()
            },
            success: function (data){
            
            alert(data);
            for (var key in data) {
            alert(data[key].price);
                       
            }
                new Chartist.Line('.chart1', {
                labels: ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница'],
                series: [
                          [12, 9, 3, 8, 4],
                          [2, 1, 4.7, 5.5, 8]
                        ]
            }, {
            fullWidth: true,
            chartPadding: {
            right: 50
            }
            }); 
            

            }
            });
        });
 });