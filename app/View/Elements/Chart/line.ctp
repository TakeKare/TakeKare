<div id="<?=$id?>"></div>

<script>
    $(function () {
        $('#<?=$id?>').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: false
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: false
                }
            },
            yAxis: {
                title: {
                    text: false
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: ${point.y:.2f}'
            },

            series: [{
                name: 'Sales',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [
                    [Date.UTC(1970,  9, 27), 100   ],
                    [Date.UTC(1970, 10, 10), 134 ],
                    [Date.UTC(1970, 10, 18), 180 ],
                    [Date.UTC(1970, 11,  2), 245 ],
                    [Date.UTC(1970, 11,  9), 300 ],
                    [Date.UTC(1970, 11, 16), 455 ],
                    [Date.UTC(1970, 11, 28), 460],
                    [Date.UTC(1971,  0,  1), 400],
                    [Date.UTC(1971,  0,  8), 380],
                    [Date.UTC(1971,  0, 12), 420],
                    [Date.UTC(1971,  0, 27), 450],
                    [Date.UTC(1971,  1, 10), 430],
                    [Date.UTC(1971,  1, 18), 400],
                    [Date.UTC(1971,  1, 24), 350],
                    [Date.UTC(1971,  2,  4), 320],
                    [Date.UTC(1971,  2, 11), 300],
                    [Date.UTC(1971,  2, 15), 340],
                    [Date.UTC(1971,  2, 25), 320],
                    [Date.UTC(1971,  3,  2), 300],
                    [Date.UTC(1971,  3,  6), 280],
                    [Date.UTC(1971,  3, 13), 250],
                    [Date.UTC(1971,  4,  3), 290],
                    [Date.UTC(1971,  4, 26), 300],
                    [Date.UTC(1971,  5,  9), 280],
                    [Date.UTC(1971,  5, 12), 240]
                ]
            }, {
                name: 'Profit',
                data: [
                    [Date.UTC(1970,  9, 27), 30],
                    [Date.UTC(1970, 10, 10), 30],
                    [Date.UTC(1970, 10, 18), 40],
                    [Date.UTC(1970, 11,  2), 60],
                    [Date.UTC(1970, 11,  9), 100],
                    [Date.UTC(1970, 11, 16), 150],
                    [Date.UTC(1970, 11, 28), 120],
                    [Date.UTC(1971,  0,  1), 100],
                    [Date.UTC(1971,  0,  8), 90],
                    [Date.UTC(1971,  0, 12), 120],
                    [Date.UTC(1971,  0, 27), 130],
                    [Date.UTC(1971,  1, 10), 120],
                    [Date.UTC(1971,  1, 18), 120],
                    [Date.UTC(1971,  1, 24), 100],
                    [Date.UTC(1971,  2,  4), 80],
                    [Date.UTC(1971,  2, 11), 90],
                    [Date.UTC(1971,  2, 15), 110],
                    [Date.UTC(1971,  2, 25), 120],
                    [Date.UTC(1971,  3,  2), 100],
                    [Date.UTC(1971,  3,  6), 70],
                    [Date.UTC(1971,  3, 13), 80],
                    [Date.UTC(1971,  4,  3), 85],
                    [Date.UTC(1971,  4, 26), 100],
                    [Date.UTC(1971,  5,  9), 90],
                    [Date.UTC(1971,  5, 12), 80]
                ]
            }]
        });

    });
</script>
