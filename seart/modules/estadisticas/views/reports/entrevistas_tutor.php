<!doctype html>
<html>
<head>

    <script src="/public/assets/js/fda/jquery.flot.js"></script>
    <script src="/public/assets/js/fda/jquery.flot.pie.js"></script>
    <script src="/public/assets/js/fda/jquery.flot.tooltip.js"></script>

    <script type="text/javascript">
                jQuery(document).ready(function($){
                    var data = [
                    {
                        label: "Mariela Condorí",
                        data: 18
                    }, {
                        label: "Alberto Cuba",
                        data: 20
                    }, {
                        label: "Carina Vargas",
                        data: 27
                    }];
                    var options = {
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                label: {
                                    show: true,
                                    radius: 2/3,
                                    formatter: function(label, series){
                                        return '<div style="font-size:20px;font-weight:bold;text-align:center;padding:2px;color:white;">'+Math.round(series.percent)+'%</div>';
                                    },
                                    threshold: 0.1
                                }
                            }
                        },
                        legend: {
                            show: true
                        },
                        grid: {
                            hoverable: true,
                            clickable: true
                        },
                        tooltip: false,
                        tooltipOpts: {
                            defaultTheme: false
                        }
                    };
                    $.plot($("#pie-chart-donut #pie-donutContainer"), data, options);
                });
            </script>
</head>
<body>
    <div id="pie-chart-donut">
        <div id="pie-donutContainer" style=" align:center; width: 50%; margin: 50px auto; height:350px; text-align: left;"></div>
    </div>
</body>
    
</html>
