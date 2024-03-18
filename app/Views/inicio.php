<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <br>
            <div class="mb-3">
                <div class="row">
                    <div class="col-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <?php echo $totalProducto; ?> Productos en total
                            </div>
                            <a class="card-footer text-white" href="<?php echo base_url() ?>/productos">Ver detalles</a>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <?php echo $totalVentas; ?> Ventas del día <br />
                                <?php echo $montoVentas['total']; ?> Bs. Total Monto
                            </div>

                            <a class="card-footer text-white" href="<?php echo base_url() ?>/ventas">Ver detalles</a>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <?php echo $minimos; ?> Productos con stock minimo
                            </div>
                            <a class="card-footer text-white" href="<?php echo base_url() ?>/productos/muestraMinimos">Ver detalles</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <?php echo $totalLaboratorio; ?> Laboratorios en total
                            </div>
                            <a class="card-footer text-white" href="<?php echo base_url() ?>/proveedores">Ver detalles</a>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <?php echo $totalCompras; ?> Compras del día <br />
                                <?php echo $montoCompras['total']; ?> Bs. Total Monto
                            </div>

                            <a class="card-footer text-white" href="<?php echo base_url() ?>/compras">Ver detalles</a>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <?php echo $vencidos; ?> Productos por vencer
                            </div>
                            <a class="card-footer text-white" href="<?php echo base_url() ?>/productos/muestraPorVencer">Ver detalles</a>
                        </div>
                    </div>
                </div>
                <!-- 
            GRAFICOS
             <div class="row">
                <div class="col-4">
                    <canvas id="myChart" width="300" height="300"></canvas>
                </div>
            </div>
             -->
            </div>
        </div>

    </main>

    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', ],
                datasets: [{
                    label: 'Ventas',
                    data: [12, 19, 3, 5, 2, 3, 2],
                    backgroundColor: [
                        'rgba(255, 99, 132,  0.2)',
                        'rgba(54,  162, 235, 0.2)',
                        'rgba(187, 143, 206, 0.2)',
                        'rgba(249, 231, 159, 0.2)',
                        'rgba(171, 235, 198, 0.2)',
                        'rgba(162, 217, 206, 0.2)',
                        'rgba(245, 183, 177, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132,  1)',
                        'rgba(54,  162, 235, 1)',
                        'rgba(187, 143, 206, 1)',
                        'rgba(249, 231, 159, 1)',
                        'rgba(171, 235, 198, 1)',
                        'rgba(162, 217, 206, 1)',
                        'rgba(245, 183, 177, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>