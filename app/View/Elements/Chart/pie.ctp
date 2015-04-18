<div id="<?=$id?>"></div>

<script>
    $(function () {
        $('#<?=$id?>').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: false
            },
            tooltip: {
                pointFormat: '<b>${point.y:.1f}</b> ({point.percentage:.1f}%)'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: '<?=$title?>',
                data: <?=json_encode($data)?>
            }]
        });
    });
</script>
