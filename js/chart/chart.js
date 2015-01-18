/**
 * 注意，有很多也页面都加载了这个js
 * 因为它们的处理逻辑都是一样的，比如logtailer页面，stream页面等
 */

$(function () {
var timeLabel = "Last 12 Hours";
$("a", $("#time_buttons")).click(function(e){
	e.preventDefault();
	timeLabel = $(this).attr('title');
	$.get(e.target.href, '', setCharts, 'json');
});

/**
 */
var setCharts = function(data) {
	console.log(data);
	var chart_params = {
		chart: {
			defaultSeriesType: 'spline',
			zoomType: 'xy',
		},
		title: {
			text: timeLabel+" 流量统计",
			x: -20 //center
		},
		subtitle: {
			text: 'Source: monitor',
			x: -20
		},
		xAxis: {
			type: 'datetime',
		},
		yAxis: [{
			title: {
				text: 'logs/'+data['unit'],
			},
		}],
		tooltip: {
			shared: true
		},
		legend: {
			//layout: 'vertical',
			//align: 'right',
			//verticalAlign: 'top',
			borderWidth: 0
		},
	};

	var series = [];
	var colors = ['#AA4643', '#87CEEB', '#7CFC00', '#B23AEE', '#0000CD', '#6699FF', '#EE00EE', '#CD661D'];
	for (var i=0;i<data['data_keys'].length;i++)
	{
		series.push({
			'name':data['data_keys'][i],
			/*marker: {
				enabled: false
			},*/
			//dashStyle: 'shortdot',
			color: colors[i],
			//yAxis: 0,
			pointInterval: data['cycle'],
			pointStart: data['start_time'], //Date.UTC(2006, 0, 01),
			data:data['data'][data['data_keys'][i]],
		});
	}
/*
	series.push({
		'name':'message_sent',
		marker: {
			 enabled: false
		},
		color: '#AA4643',
		yAxis: 1,
		pointInterval: data['cycle'],
		pointStart: data['start_time'], //Date.UTC(2006, 0, 01),
		data:data['data']['message_sent'],
	});*/
	chart_params['series'] = series;
	$('#chart_monitor').highcharts(chart_params);
};

$('#ts_12hour').click();
});
	
