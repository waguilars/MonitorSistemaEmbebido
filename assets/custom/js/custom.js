let lastTime;

$(document).ready(function() {
	initCharts();

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

const initCharts = () => {
	// Peticion Ajax para graficar

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

					element.fecha = getTimestamp(element.fecha);
					setLastTime(element.fecha);
				});
			});

			//graphic chart
			drawChart(response);

			// Adding new ponts
			setInterval(() => {
				$.get("sensor/last", data => {
					obj = JSON.parse(data);
					time = getTimestamp(obj[0].fecha);
					if (getLastTime() != time) {
						series.addPoint([time, obj[1]], true, true);
						setLastTime(time);
					}
				});
			}, 1000);
		}
	});
};

const drawChart = data => {
	temperatura = Array();
	humedad = Array();

	data["temperatura"].forEach(el => {
		temperatura.push(Array(el.fecha, el.valor));
	});
	data["humedad"].forEach(el => {
		humedad.push(Array(el.fecha, el.valor));
	});

	Highcharts.chart("temperature-chart", {
		chart: {
			type: "spline",
			events: {
				load: function() {
					series = this.series[0];
				}
			}
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
				data: temperatura
			},
			{
				name: "Humedad",
				marker: {
					symbol: "diamond"
				},
				data: humedad
			}
		]
	});
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
