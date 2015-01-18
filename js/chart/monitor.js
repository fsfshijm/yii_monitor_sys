/**
 * test
 */

$(function () {
        $('#chart_monitor').highcharts({
            title: {
                text: 'Monthly Average Temperature',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: WorldClimate.com',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: '体重(kg)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'C'
		//shared: true
            },
            legend: {
                //layout: 'vertical',
                //align: 'right',
                //verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '霄姐姐',
                data: [46, 47, 48, 49, 48, 47, 46, 50, 51, 50, 48, 47]
            }, {
                name: '雪妹妹',
                data: [49, 50, 51, 52, 53, 51, 50, 46, 47, 51, 55, 51]
            }, {
                name: '飞哥',
                data: [81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92]
            }, {
                name: '猛哥',
                data: [82, 81, 80, 78, 77, 76, 75, 74, 73, 74, 76, 76]
            }, {
                name: '翔哥',
                data: [95, 93, 90, 87, 85, 84, 80, 78, 74, 70, 68, 65]
            }
		]
        });
 });
    

