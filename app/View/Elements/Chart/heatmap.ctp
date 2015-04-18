<div id="<?=$id?>"></div>

<script>
    $(function () {
        $('#<?=$id?>').highcharts({

            chart: {
                type: 'heatmap',
                marginTop: 40,
                marginBottom: 40
            },


            title: {
                text: false
            },

            xAxis: {
                categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                opposite: true
            },

            yAxis: {
                categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                title: null,
                labels: {
                    enabled: false
                }
            },

            colorAxis: {
                min: 0,
                minColor: '#FFFFFF',
                maxColor: Highcharts.getOptions().colors[0]
            },

            legend: {
                align: 'right',
                layout: 'vertical',
                margin: 0,
                verticalAlign: 'top',
                y: 25,
                symbolHeight: 320
            },

            tooltip: {
                formatter: function () {
                    //return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> sold <br><b>' +
                    //this.point.value + '</b> items on <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
                    return this.point.value + '%';
                }
            },

            series: [{
                name: '<?=$title?>',
                borderWidth: 1,
                data: <?=json_encode($data)?>,
                dataLabels: {
                    format: '{point.y}%',
                    enabled: true,
                    color: 'black',
                    style: {
                        textShadow: 'none',
                        HcTextStroke: null
                    }
                }
            }]

        });
    });
</script>
