let humTbl;
let tempTbl;

$(document).ready(function() {
	tempTbl = document.getElementById("report-temp").tBodies[0];
	humTbl = document.getElementById("report-hum").tBodies[0];
	requestAllData("temperatura", tempTbl);
	requestAllData("humedad", humTbl);
});

const requestAllData = (sensor, tbodie) => {
	$.getJSON("../sensor/" + sensor, json => {
		json.forEach(element => {
			//creo elementos del dom
			let row = document.createElement("tr");
			let id = document.createElement("th");
			id.scope = "row";
			let fecha = document.createElement("td");
			let valor = document.createElement("td");

			//agrego valores a las celdas
			id.appendChild(document.createTextNode(element.id));
			fecha.appendChild(document.createTextNode(element.fecha));
			valor.appendChild(document.createTextNode(element.valor));

			//agrego celdas al row
			row.appendChild(id);
			row.appendChild(fecha);
			row.appendChild(valor);

			//agrego row a la tabla
			tbodie.appendChild(row);
		});
	});
};
