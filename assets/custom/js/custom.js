$(document).ready(function() {
	/* Temperature graph */
	Highcharts.chart("temperature-chart", {
		chart: {
			type: "spline"
		},
		title: {
			text: "Monthly Average Temperature"
		},
		subtitle: {
			text: "Source: WorldClimate.com"
		},
		xAxis: {
			categories: [
				"Jan",
				"Feb",
				"Mar",
				"Apr",
				"May",
				"Jun",
				"Jul",
				"Aug",
				"Sep",
				"Oct",
				"Nov",
				"Dec"
			]
		},
		yAxis: {
			title: {
				text: "Temperature"
			},
			labels: {
				formatter: function() {
					return this.value + "°";
				}
			}
		},
		tooltip: {
			crosshairs: true,
			shared: true
		},
		plotOptions: {
			spline: {
				marker: {
					radius: 4,
					lineColor: "#666666",
					lineWidth: 1
				}
			}
		},
		series: [
			{
				name: "Tokyo",
				marker: {
					symbol: "square"
				},
				data: [
					7.0,
					6.9,
					9.5,
					14.5,
					18.2,
					21.5,
					25.2,
					{
						y: 26.5,
						marker: {
							symbol: "url(https://www.highcharts.com/samples/graphics/sun.png)"
						}
					},
					23.3,
					18.3,
					13.9,
					9.6
				]
			},
			{
				name: "London",
				marker: {
					symbol: "diamond"
				},
				data: [
					{
						y: 3.9,
						marker: {
							symbol:
								"url(https://www.highcharts.com/samples/graphics/snow.png)"
						}
					},
					4.2,
					5.7,
					8.5,
					11.9,
					15.2,
					17.0,
					16.6,
					14.2,
					10.3,
					6.6,
					4.8
				]
			}
		]
	});

	/* Temperature gauge */
	Highcharts.chart(
		"temp-gauge",
		{
			chart: {
				type: "gauge",
				plotBackgroundColor: null,
				plotBackgroundImage: null,
				plotBorderWidth: 0,
				plotShadow: false
			},

			title: {
				text: "Speedometer"
			},

			pane: {
				startAngle: -150,
				endAngle: 150,
				background: [
					{
						backgroundColor: {
							linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
							stops: [
								[0, "#FFF"],
								[1, "#333"]
							]
						},
						borderWidth: 0,
						outerRadius: "109%"
					},
					{
						backgroundColor: {
							linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
							stops: [
								[0, "#333"],
								[1, "#FFF"]
							]
						},
						borderWidth: 1,
						outerRadius: "107%"
					},
					{
						// default background
					},
					{
						backgroundColor: "#DDD",
						borderWidth: 0,
						outerRadius: "105%",
						innerRadius: "103%"
					}
				]
			},

			// the value axis
			yAxis: {
				min: 0,
				max: 200,

				minorTickInterval: "auto",
				minorTickWidth: 1,
				minorTickLength: 10,
				minorTickPosition: "inside",
				minorTickColor: "#666",

				tickPixelInterval: 30,
				tickWidth: 2,
				tickPosition: "inside",
				tickLength: 10,
				tickColor: "#666",
				labels: {
					step: 2,
					rotation: "auto"
				},
				title: {
					text: "km/h"
				},
				plotBands: [
					{
						from: 0,
						to: 120,
						color: "#55BF3B" // green
					},
					{
						from: 120,
						to: 160,
						color: "#DDDF0D" // yellow
					},
					{
						from: 160,
						to: 200,
						color: "#DF5353" // red
					}
				]
			},

			series: [
				{
					name: "Speed",
					data: [80],
					tooltip: {
						valueSuffix: " km/h"
					}
				}
			]
		},
		// Add some life
		function(chart) {
			if (!chart.renderer.forExport) {
				setInterval(function() {
					var point = chart.series[0].points[0],
						newVal,
						inc = Math.round((Math.random() - 0.5) * 20);

					newVal = point.y + inc;
					if (newVal < 0 || newVal > 200) {
						newVal = point.y - inc;
					}

					point.update(newVal);
				}, 3000);
			}
		}
	);
});
