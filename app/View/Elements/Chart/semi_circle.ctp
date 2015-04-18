<div id="<?=$id?>"></div>

<script>
    $(function () {
        var options = {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: 400
            },
            title: {
                text: '<?=$title?>',
                align: 'center',
                verticalAlign: 'middle',
                y: 50
            },
            tooltip: {
                pointFormat: '<b>${point.y:.1f}</b> ({point.percentage:.1f}%)'
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            fontWeight: 'bold',
                            color: 'white',
                            textShadow: '0px 1px 2px black'
                        }
                    },
                    startAngle: -90,
                    endAngle: 90,
                    center: ['50%', '75%']
                }
            },
            series: [{
                type: 'pie',
                innerSize: '50%',
                data: <?=json_encode($data)?>
            }]
        };

        $('#<?=$id?>').highcharts(options);
    });
</script>
