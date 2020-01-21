let lastTime;
let chart;

$(document).ready(function() {
	/* Grafico de temperatura y humedad */
	$.getJSON("sensor", function(json) {
		chartOptions.series[0].data = json.temperatura;
		chartOptions.series[1].data = json.humedad;
		setLastTime(json.temperatura[json.temperatura.length - 1][0]);
		chart = new Highcharts.Chart("temperature-chart", chartOptions);
	});
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
});

const requestSensoresData = () => {
	setInterval(() => {
		$.get("sensor/last", resp => {
			data = JSON.parse(resp);

			if (data.temperatura[0] > getLastTime()) {
				chart.series[0].addPoint(data.temperatura, true, true, true);
				chart.series[1].addPoint(data.humedad, true, true, true);
				setLastTime(data.temperatura[0]);
			}
		});
	}, 1000);
};

let chartOptions = {
	chart: {
		type: "spline",
		animation: Highcharts.svg, // don't animate in old IE
		marginRight: 10,
		events: {
			load: requestSensoresData
		}
	},

	time: {
		useUTC: false
	},

	title: {
		text: "Estado de la temperatura y humedad actual"
	},

	subtitle: {
		text: "Datos recogidos por arduino"
	},

	xAxis: {
		type: "datetime",
		dateTimeLabelFormats: {
			month: "%e. %b",
			year: "%b"
		},
		title: {
			text: "Hora"
		}
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
		headerFormat: "<b>{series.name}</b><br/>",
		pointFormat: "{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}"
	},

	legend: {
		enabled: false
	},

	exporting: {
		enabled: false
	},

	series: [
		{
			name: "Temperatura",
			data: []
		},
		{
			name: "Humedad",
			data: []
		}
	]
};

const setLastTime = time => {
	lastTime = time;
};

const getLastTime = () => {
	return lastTime;
};

const getTimestamp = cadena => {
	auxdate = cadena.split(" ");
	auxD = auxdate[0].split("-");
	auxH = auxdate[1].split(":");

	timesstamp = Date.UTC(auxD[0], auxD[1], auxD[2], auxH[0], auxH[1], auxH[2]);

	return timesstamp;
};
