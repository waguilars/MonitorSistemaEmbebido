<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>
					Sistema de climatización
				</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Monitoreo de Sensores</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<!-- Grafuico general -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="dashboard_graph">
									<div class="col-md-12 col-sm-12">
										<!-- aqui el grafico en tiempo real -->
										<div id="temperature-chart"></div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<!-- Gaugue de sensor temperatura -->
						<div class="x_title">
							<h2>Temperatura</h2>
							<div class="clearfix"></div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="x_panel tile ">

									<div class="x_content">
										<div id="temp-gauge"></div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="x_panel tilde">

									<div class="x_content">
										<!-- Tabla de registros -->
										<table id="temp-table" class="table">
											<thead class="thead-dark">
												<tr>
													<th scope="col">#</th>
													<th scope="col">Fecha</th>
													<th scope="col">Valor</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- Gaugue de sensor humedad -->
						<div class="x_title">
							<h2>Humedad</h2>
							<div class="clearfix"></div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="x_panel tilde">
									<div class="x_content">
										<!-- Tabla de registros -->
										<table id="hum-table" class="table">
											<thead class="thead-dark">
												<tr>
													<th scope="col">#</th>
													<th scope="col">Fecha</th>
													<th scope="col">Valor</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="x_panel tile ">
									<div class="x_content">
										<div id="hum-gauge"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
