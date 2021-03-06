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
            var series1 = [];
            var series2 = [];
            var labels = [];
            
            //get X elements first method chart
            var series1 = data.map(function(item) {
                         return item.price;
                        });
                        
            //get X elements first method chart
            var series2 = data.map(function(item) {
                         return item.price2;
                        });
            
            //get Y elements both charts
            var labels = data.map(function(item) {
                        return item.date;
                        });
            
            new Chartist.Line('.chart1', {
                labels: labels,
                series: [series1,series2]
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