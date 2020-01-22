<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Registro de datos</title>
		<link
			href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css"
			rel="stylesheet"
		/>
	</head>

	<body>
		<div class="container">
			<h2 class="text-center">Reporte de datos de temperatura</h2>
				<table id="report-temp" class="table ">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Fecha</th>
							<th scope="col">Valor</th>
						</tr>
					</thead>
					<tbody>
						<!-- Codigo php -->
						<?php
						foreach ($temp as $temperatura) {
							echo "<tr>";
							echo "<th>$temperatura->id</th>";
							echo "<td>$temperatura->fecha</td>";
							echo "<td>$temperatura->valor</td>";
							echo "</tr>";
						}
						?>
											
					</tbody>
				</table>
		</div>
		<div class="container">
			<h2 class="text-center">Reporte de datos de Humedad</h2>
				<table id="report-hum" class="table ">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Fecha</th>
							<th scope="col">Valor</th>
						</tr>
					</thead>
					<tbody>
						<!-- Codigo php -->
						<?php
						foreach ($hum as $humedad) {
							echo "<tr>";
							echo "<th>$humedad->id</th>";
							echo "<td>$humedad->fecha</td>";
							echo "<td>$humedad->valor</td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
		</div>

		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<!-- <script src="<?php echo base_url(); ?>assets/custom/js/pdf.js"></script> -->
	</body>
</html>
