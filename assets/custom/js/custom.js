$(document).ready(function() {
	//initCharts();
	/* Temperature graph */
	Highcharts.chart("temperature-chart");

	/* Temperature gauge */
	Highcharts.chart("temp-gauge", {
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
	});

	initCharts();
});

const initCharts = () => {
	// Peticion Ajax para graficar
	let lastValue;
	let lastTime;
	$.ajax({
		type: "get",
		url: "sensor/index",
		success: function(response) {
			response = JSON.parse(response);
			// cambio a numero
			$.each(response, function(i, obj) {
				obj.forEach(element => {
					// parse value
					element.valor = parseFloat(element.valor);
					//parse date
					auxdate = element.fecha.split(" ");
					auxD = auxdate[0].split("-");
					auxH = auxdate[1].split(":");

					timesstamp = Date.UTC(
						auxD[0],
						auxD[1],
						auxD[2],
						auxH[0],
						auxH[1],
						auxH[2]
					);
					element.fecha = timesstamp;
				});
			});

			temperatura = response["temperatura"];
			humedad = response["humedad"];

			//graphic chart
			chart = new Highcharts.chart(chart_options);
		}
	});
};

let chart_options = {
	chart: {
		type: "spline"
	},
	title: {
		text: "Estado de la temperatura y humedad actual"
	},
	subtitle: {
		text: "Datos recogidos por arduino"
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
			text: "Sensores"
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
			name: "Temperatura",
			marker: {
				symbol: "square"
			},
			data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 23.3, 18.3, 13.9, 9.6]
		},
		{
			name: "Humedad",
			marker: {
				symbol: "diamond"
			},
			data: [4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
		}
	]
};
