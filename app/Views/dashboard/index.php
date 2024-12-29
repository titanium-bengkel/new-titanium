<?= $this->extend('layout/template'); ?>
<?= $this->section('content');  ?>

<div class="show-block-ke-hide">
    <div class="page-heading">
        <section class="row">
            <div class="col">
                <div class="card shadow-lg rounded-3">
                    <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between gap-2"
                        style="display: flex; justify-content: space-between; align-items: center;">

                        <div class="d-flex align-items-center" style="flex: 1;">
                            <h5 class="font-semibold text-muted" style="font-weight: 600; color: #6c757d;">Statistic
                                Overview</h5>
                        </div>

                        <!-- Periode Filter dan Dropdown di Kanan -->
                        <div class="d-flex flex-column flex-md-row align-items-center gap-3 w-100 w-md-auto"
                            style="flex: 1; justify-content: flex-end;">
                            <!-- Periode Filter: Start Date to End Date -->
                            <div class="d-flex align-items-center gap-2 w-100 w-md-auto">
                                <label for="start-date" class="form-label mb-0 text-muted fw-bold"
                                    style="font-weight: bold; color: #6c757d;">Periode:</label>
                                <input type="text" id="start-date" class="form-control form-control-sm rounded-2 w-auto"
                                    style="width: 120px;" placeholder="Start Date" readonly />
                                <span class="mx-1 text-muted fw-bold"
                                    style="font-weight: bold; color: #6c757d;">to</span>
                                <input type="text" id="end-date" class="form-control form-control-sm rounded-2 w-auto"
                                    style="width: 120px;" placeholder="End Date" readonly />
                                <button class="btn btn-primary btn-sm rounded-2" id="filter-btn"
                                    style="background-color: #007bff; border: none;">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>

                            <!-- Dropdown for Download Options -->
                            <div class="dropdown w-100 w-md-auto">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="border-radius: 30px; font-weight: 600; background-color: #007bff; border: none;">
                                    <i class="fas fa-download"></i> <span class="ms-2">Download</span>
                                </button>
                                <ul class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton"
                                    style="border-radius: 10px; border: 1px solid #007bff; padding: 0; box-shadow: 0 8px 16px rgba(0, 123, 255, 0.2); min-width: 200px; z-index: 4;">
                                    <li><a class="dropdown-item" href="#"
                                            style="border-radius: 10px; padding: 12px 20px; color: #007bff; font-size: 14px; transition: background-color 0.3s, color 0.3s;"
                                            onmouseover="this.style.backgroundColor='#007bff'; this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#007bff';">Pre
                                            Order</a></li>
                                    <li><a class="dropdown-item" href="#"
                                            style="border-radius: 10px; padding: 12px 20px; color: #007bff; font-size: 14px; transition: background-color 0.3s, color 0.3s;"
                                            onmouseover="this.style.backgroundColor='#007bff'; this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#007bff';">Repair
                                            Order</a></li>
                                    <li><a class="dropdown-item" href="#"
                                            style="border-radius: 10px; padding: 12px 20px; color: #007bff; font-size: 14px; transition: background-color 0.3s, color 0.3s;"
                                            onmouseover="this.style.backgroundColor='#007bff'; this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#007bff';">Unit
                                            Finish</a></li>
                                    <li><a class="dropdown-item" href="#"
                                            style="border-radius: 10px; padding: 12px 20px; color: #007bff; font-size: 14px; transition: background-color 0.3s, color 0.3s;"
                                            onmouseover="this.style.backgroundColor='#007bff'; this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#007bff';">WIP</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row" style="position: relative; z-index: -4;">
                        <!-- Unit Pre-Order -->
                        <div class="col-12 col-md-3 mb-4">
                            <div class="card shadow-lg rounded-3"
                                style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 15px;">
                                <div class="card-body d-flex flex-column align-items-center justify-content-between"
                                    style="padding: 25px;">
                                    <div class="text-center">
                                        <h6 class="text-muted font-semibold" style="color: #bdc3c7;">Unit Pre-Order</h6>
                                        <h6 class="font-extrabold mb-0" style="font-size: 28px;"><?= $preOrderCount; ?>
                                        </h6>
                                    </div>
                                    <div class="mt-3 icon-container" style="font-size: 40px; color: #6a1b9a;">
                                        <i class="fas fa-cogs icon-hover" id="icon-preorder"
                                            style="transition: transform 0.3s ease;"></i>
                                    </div>
                                    <div class="d-flex gap-3 justify-content-center mt-3">
                                        <span class="badge bg-info"
                                            style="font-size: 14px; padding: 8px 15px;"><?= $asuransistatus; ?>
                                            Asuransi</span>
                                        <span class="badge bg-success"
                                            style="font-size: 14px; padding: 8px 15px;"><?= $umumststus; ?>
                                            Pribadi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Unit Repair Order -->
                        <div class="col-12 col-md-3 mb-4">
                            <div class="card shadow-lg rounded-3"
                                style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 15px;">
                                <div class="card-body d-flex flex-column align-items-center justify-content-between"
                                    style="padding: 25px;">
                                    <div class="text-center">
                                        <h6 class="text-muted font-semibold" style="color: #bdc3c7;">Unit Repair Order
                                        </h6>
                                        <h6 class="font-extrabold mb-0" style="font-size: 28px;"><?= $repairOrder; ?>
                                        </h6>
                                    </div>
                                    <div class="mt-3 icon-container" style="font-size: 40px; color: #43a047;">
                                        <i class="fas fa-wrench icon-hover" id="icon-repair"
                                            style="transition: transform 0.3s ease;"></i>
                                    </div>
                                    <div class="d-flex gap-3 justify-content-center mt-3">
                                        <span class="badge bg-info"
                                            style="font-size: 14px; padding: 8px 15px;"><?= $repairasuransi; ?>
                                            Asuransi</span>
                                        <span class="badge bg-success"
                                            style="font-size: 14px; padding: 8px 15px;"><?= $repairumum; ?>
                                            Pribadi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Unit Finish -->
                        <div class="col-12 col-md-3 mb-4">
                            <div class="card shadow-lg rounded-3"
                                style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 15px;">
                                <div class="card-body d-flex flex-column align-items-center justify-content-between"
                                    style="padding: 25px;">
                                    <div class="text-center">
                                        <h6 class="text-muted font-semibold" style="color: #bdc3c7;">Unit Finish</h6>
                                        <h6 class="font-extrabold mb-0" style="font-size: 28px;">
                                            <?= $unitkeluarCount; ?></h6>
                                    </div>
                                    <div class="mt-3 icon-container" style="font-size: 40px; color: #1e88e5;">
                                        <i class="fas fa-check-circle icon-hover" id="icon-finish"
                                            style="transition: transform 0.3s ease;"></i>
                                    </div>
                                    <div class="d-flex gap-1 justify-content-center mt-3">
                                        <span class="badge bg-info"
                                            style="font-size: 14px; padding: 8px 15px;"><?= $mobilKeluarasuransi; ?>
                                            Asuransi</span>
                                        <span class="badge bg-success"
                                            style="font-size: 14px; padding: 8px 15px;"><?= $mobilkeluarumum; ?>
                                            Pribadi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- WIP (Work In Progress) -->
                        <div class="col-12 col-md-3 mb-4">
                            <div class="card shadow-lg rounded-3"
                                style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 15px;">
                                <div class="card-body d-flex flex-column align-items-center justify-content-between"
                                    style="padding: 25px;">
                                    <div class="text-center">
                                        <h6 class="text-muted font-semibold" style="color: #bdc3c7;">WIP (Work In
                                            Progress)</h6>
                                        <h6 class="font-extrabold mb-0" style="font-size: 28px;">120</h6>
                                    </div>
                                    <div class="mt-3 icon-container" style="font-size: 40px; color: #fbc02d;">
                                        <i class="fas fa-hourglass-half icon-hover" id="icon-wip"
                                            style="transition: transform 0.3s ease;"></i>
                                    </div>
                                    <div class="d-flex gap-3 justify-content-center mt-3">
                                        <span class="badge bg-info" style="font-size: 14px; padding: 8px 15px;">40
                                            Asuransi</span>
                                        <span class="badge bg-success" style="font-size: 14px; padding: 8px 15px;">80
                                            Pribadi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                var ctx = document.getElementById('unitLineChart').getContext('2d');
                var unitLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Unit Pre-Order', 'Unit Repair Order', 'Unit Finish',
                            'WIP'
                        ],
                        datasets: [{
                            label: 'Jumlah Asuransi',
                            data: [2, 1, 1, 3],
                            borderColor: '#1e88e5',
                            backgroundColor: 'rgba(30, 136, 229, 0.2)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 2,
                            yAxisID: 'y1',
                        }, {
                            label: 'Jumlah Pribadi',
                            data: [3, 3, 1, 8],
                            borderColor: '#f39c12',
                            backgroundColor: 'rgba(243, 156, 18, 0.2)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 2,
                            yAxisID: 'y2',
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y1: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    max: 20,
                                },
                                position: 'left'
                            },
                            y2: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    max: 20,
                                },
                                position: 'right',
                                grid: {
                                    drawOnChartArea: false,
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        },
                        elements: {
                            point: {
                                radius: 5,
                                hoverRadius: 8,
                                backgroundColor: '#1e88e5',
                            }
                        },
                    }
                });
                </script>








                <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
                <script>
                // Animasi untuk ikon menggunakan anime.js
                anime({
                    targets: '#icon-preorder',
                    rotate: '360deg',
                    loop: true,
                    duration: 3000,
                    easing: 'easeInOutSine',
                });

                anime({
                    targets: '#icon-repair',
                    translateY: [-10, 10],
                    loop: true,
                    duration: 1500,
                    easing: 'easeInOutQuad',
                });

                anime({
                    targets: '#icon-finish',
                    scale: [1, 1.2],
                    loop: true,
                    duration: 2000,
                    easing: 'easeInOutSine',
                });

                anime({
                    targets: '#icon-wip',
                    rotate: '360deg',
                    loop: true,
                    duration: 2500,
                    easing: 'easeInOutSine',
                });
                </script>






                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card shadow-lg rounded-3"
                            style="transition: transform 0.3s ease, box-shadow 0.3s ease;  border-radius: 15px; transform: translateY(0); box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
                            <div class="card-body d-flex flex-column align-items-center justify-content-between"
                                style="padding: 25px;">
                                <div class="text-center">
                                    <h6 class="text-muted font-semibold" style="color: #bdc3c7;">Unit Pre Order</h6>
                                    <h6 class="font-extrabold mb-0" style="font-size: 28px;">350</h6>
                                    <p class="text-muted">Tanggal Hari Ini</p>
                                </div>
                                <div class="mt-3 icon-container"
                                    style="font-size: 40px; color: #6a1b9a; transition: transform 0.3s ease;">
                                    <i class="bi bi-car-front-fill icon-hover"
                                        style="transition: transform 0.3s ease;"></i>
                                </div>
                                <div class="d-flex gap-3 justify-content-center mt-3">
                                    <span class="badge bg-info" style="font-size: 14px; padding: 8px 15px;">120
                                        Asuransi</span>
                                    <span class="badge bg-success" style="font-size: 14px; padding: 8px 15px;">230
                                        Pribadi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <div class="card shadow-lg rounded-3"
                            style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 15px; transform: translateY(0); box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
                            <div class="card-body d-flex flex-column align-items-center justify-content-between"
                                style="padding: 25px;">
                                <div class="text-center">
                                    <h6 class="text-muted font-semibold" style="color: #bdc3c7;">Unit Repair Order</h6>
                                    <h6 class="font-extrabold mb-0" style="font-size: 28px;">500</h6>
                                    <p class="text-muted">Tanggal Hari Ini</p>
                                </div>
                                <div class="mt-3 icon-container"
                                    style="font-size: 40px; color: #43a047; transition: transform 0.3s ease;">
                                    <i class="bi bi-file-earmark-check icon-hover"
                                        style="transition: transform 0.3s ease;"></i>
                                </div>
                                <div class="d-flex gap-3 justify-content-center mt-3">
                                    <span class="badge bg-info" style="font-size: 14px; padding: 8px 15px;">200
                                        Asuransi</span>
                                    <span class="badge bg-success" style="font-size: 14px; padding: 8px 15px;">300
                                        Pribadi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card shadow-lg rounded-3"
                            style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 15px; transform: translateY(0); box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
                            <div class="card-body d-flex flex-column align-items-center justify-content-between"
                                style="padding: 25px;">
                                <div class="text-center">
                                    <h6 class="text-muted font-semibold" style="color: #bdc3c7;">Daily Report Bengkel
                                    </h6>
                                    <h6 class="font-extrabold mb-0" style="font-size: 28px;">350</h6>
                                    <p class="text-muted">Mobil Masuk</p>
                                </div>
                                <div class="mt-3 icon-container"
                                    style="font-size: 40px; color: #6a1b9a; transition: transform 0.3s ease;">
                                    <i class="bi bi-car-front-fill icon-hover"
                                        style="transition: transform 0.3s ease;"></i>
                                </div>
                                <div class="d-flex gap-3 justify-content-center mt-3">
                                    <span class="badge bg-info" style="font-size: 14px; padding: 8px 15px;">120
                                        Asuransi</span>
                                    <span class="badge bg-success" style="font-size: 14px; padding: 8px 15px;">230
                                        Pribadi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <div class="card shadow-lg rounded-3"
                            style="transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 15px; transform: translateY(0); box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
                            <div class="card-body d-flex flex-column align-items-center justify-content-between"
                                style="padding: 25px;">
                                <div class="text-center">
                                    <h6 class="text-muted font-semibold" style="color: #bdc3c7;">Daily Report Invoice
                                    </h6>
                                    <h6 class="font-extrabold mb-0" style="font-size: 28px;">500</h6>
                                    <p class="text-muted">Total Invoice</p>
                                </div>
                                <div class="mt-3 icon-container"
                                    style="font-size: 40px; color: #43a047; transition: transform 0.3s ease;">
                                    <i class="bi bi-file-earmark-check icon-hover"
                                        style="transition: transform 0.3s ease;"></i>
                                </div>
                                <div class="d-flex gap-3 justify-content-center mt-3">
                                    <span class="badge bg-info" style="font-size: 14px; padding: 8px 15px;">200
                                        Asuransi</span>
                                    <span class="badge bg-success" style="font-size: 14px; padding: 8px 15px;">300
                                        Pribadi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                document.querySelectorAll('.card').forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        card.style.transform = 'translateY(-10px)';
                        card.style.boxShadow = '0px 12px 20px rgba(0, 0, 0, 0.2)';
                    });
                    card.addEventListener('mouseleave', () => {
                        card.style.transform = 'translateY(0)';
                        card.style.boxShadow = '0px 4px 12px rgba(0, 0, 0, 0.1)';
                    });
                });

                document.querySelectorAll('.icon-container i').forEach(icon => {
                    icon.addEventListener('mouseenter', () => {
                        icon.style.transform = 'rotate(360deg)';
                    });
                    icon.addEventListener('mouseleave', () => {
                        icon.style.transform = 'rotate(0deg)';
                    });
                });
                </script>

                <!-- INI BEKERJA JIKA ROLE YANG LOGIN SEBAGAI KEUNAGAN. -->
                <?php if (session() && session('role_label') == 'keuangan')   { ?>
                <div class="page-heading">
                    <section class="row">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">Line Chart</h6>
                                        <h6 class="card-title">Detail</h6>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="bar"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">LAPORAN OUTSTANDING PIUTANG >< HUTANG</h6>
                                                <h6 class="card-title">Detail</h6>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="line"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title">CV. TITANIUM - MTD 2024</h6>
                                    <h6 class="card-title">Detail</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="mtdChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>


                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




                <script>
                // Line Chart
                var ctx = document.getElementById('line').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['01-Oct', '05-Oct', '10-Oct', '15-Oct', '20-Oct', '25-Oct',
                            '31-Oct'
                        ], // Sesuaikan label
                        datasets: [{
                                label: 'Piutang',
                                borderColor: 'green',
                                // backgroundColor: 'rgba(0, 255, 0, 0.2)',
                                data: [700000000, 750000000, 770000000, 780000000, 650000000, 780000000,
                                    774773293
                                ], // Data Piutang
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'Hutang',
                                borderColor: 'yellow',
                                // backgroundColor: 'rgba(255, 255, 0, 0.2)',
                                data: [690000000, 720000000, 730000000, 740000000, 660000000, 770000000,
                                    669933026
                                ], // Data Hutang
                                fill: true,
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tanggal'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Nilai (IDR)'
                                },
                                // ticks: {
                                //     callback: function(value) {
                                //         return value.toLocaleString("id-ID", {
                                //             style: 'currency',
                                //             currency: 'IDR'
                                //         });
                                //     }
                                // }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.raw.toLocaleString("id-ID", {
                                            style: 'currency',
                                            currency: 'IDR'
                                        });
                                    }
                                }
                            }
                        }
                    }
                });


                // Bar Chart
                var ctx = document.getElementById('bar').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // Months
                        datasets: [{
                            label: 'Profit', // Changed label from "Students" to "Profit"
                            backgroundColor: ['#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff',
                                '#0000ff',
                                '#0000ff'
                            ], // Adjust colors
                            data: [10, 20, 30, 50, 35, 55, 15] // Example data
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Months'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Profit'
                                },
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    color: 'white' // To match the dark theme in your image
                                }
                            }
                        }
                    }
                });


                // kwitans
                var ctx = document.getElementById('mtdChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Nov-23', 'Jan-24', 'Feb-24', 'Apr-24', 'Jun-24', 'Jul-24', 'Sep-24',
                            'Nov-24'
                        ], // Sesuaikan label waktu
                        datasets: [{
                                label: 'JUMLAH KWITANSI',
                                borderColor: 'blue',
                                backgroundColor: 'rgba(0, 0, 255, 0.1)',
                                data: [114, 113, 114, 93, 150, 120, 114, 139], // Data jumlah kwitansi
                                yAxisID: 'y-axis-2',
                                tension: 0.4,
                                fill: false,
                                pointStyle: 'circle',
                                pointRadius: 5
                            },
                            {
                                label: 'NOMINAL',
                                borderColor: 'orange',
                                backgroundColor: 'rgba(255, 165, 0, 0.1)',
                                data: [723214688, 540042243, 652848526, 1133486978, 644882329, 800536134,
                                    548632085,
                                    625213420
                                ], // Data nominal
                                yAxisID: 'y-axis-1',
                                tension: 0.4,
                                fill: false,
                                pointStyle: 'circle',
                                pointRadius: 5
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        let value = tooltipItem.raw;
                                        if (tooltipItem.dataset.label === 'NOMINAL') {
                                            return value.toLocaleString("id-ID", {
                                                style: 'currency',
                                                currency: 'IDR'
                                            });
                                        } else {
                                            return 'Jumlah: ' + value;
                                        }
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Periode'
                                }
                            },
                            'y-axis-1': {
                                type: 'linear',
                                position: 'left',
                                title: {
                                    display: true,
                                    text: 'Nominal (IDR)'
                                },
                                // ticks: {
                                //     callback: function(value) {
                                //         return value.toLocaleString("id-ID", {
                                //             style: 'currency',
                                //             currency: 'IDR'
                                //         });
                                //     }
                                // }
                            },
                            'y-axis-2': {
                                type: 'linear',
                                position: 'right',
                                title: {
                                    display: true,
                                    text: 'Jumlah Kwitansi'
                                },
                                ticks: {
                                    stepSize: 20
                                }
                            }
                        }
                    }
                });
                </script>

                <?php } ?>



                <div class="row mt-3">
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header" style="background-color: #1e88e5;">
                                <h5 class="font-semibold" style="color: #ffffff !important;">Unit Terinvoice</h5>
                            </div>
                            <div class="card-body">
                                <hr class="my-3" style="border-top: 4px solid #1e88e5;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="font-extrabold mb-0">Jumlah</h6>
                                        <h4 id="mobilMasuk" class="mt-2 font-bold text-primary text-center">
                                            <?= $kwitasniCount; ?>
                                        </h4>
                                        <p class="text-muted mt-1"></p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="font-extrabold mb-0">Asuransi</h6>
                                        <h4 id="mobilMasuk" class="mt-2 font-bold text-primary text-center">
                                            <?= $kwitansiasuransi; ?></h4>
                                        <p class="text-muted mt-1"></p>
                                    </div>
                                    <div>
                                        <h6 class="font-extrabold mb-0">Pribadi</h6>
                                        <h4 id="mobilMasuk" class="mt-2 font-bold text-primary text-center">
                                            <?= $kwitansiumum; ?>
                                        </h4>
                                        <p class="text-muted mt-1"></p>
                                    </div>
                                </div>
                                <hr class="my-3" style="border-top: 4px solid #1e88e5;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
.table-sm td,
.table-sm th {
    font-size: 12px;
    /* Ukuran font lebih kecil */
    padding: 4px;
    /* Padding lebih kecil */
}
</style>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tandem') === 'true') {
        // Pindah ke tab Tandem
        const tandemTab = document.getElementById('tandem-tab');
        if (tandemTab) {
            tandemTab.click();
        }
    }
});






document.querySelectorAll('.stats-icon').forEach(function(icon) {
    const colorClass = icon.classList.contains('purple') ? '#6a1b9a' :
        icon.classList.contains('blue') ? '#1e88e5' :
        icon.classList.contains('green') ? '#43a047' :
        icon.classList.contains('red') ? '#e53935' : '#000';

    icon.style.backgroundColor = colorClass;
    icon.style.color = 'white';
    icon.style.width = '50px';
    icon.style.height = '50px';
    icon.style.display = 'flex';
    icon.style.alignItems = 'center';
    icon.style.justifyContent = 'center';
    icon.style.borderRadius = '10px';
    icon.style.fontSize = '30px';
});


// Memuat data harian
document.addEventListener('DOMContentLoaded', function() {
    // Ganti URL ini dengan API atau endpoint server Anda
    const apiUrl = '/api/getDailyReport';

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            // Menampilkan jumlah mobil masuk
            document.getElementById('mobilMasuk').textContent = data.mobilMasuk || 0;
        })
        .catch(error => {
            console.error('Error fetching daily report:', error);
        });
});
</script>


<!-- end card -->



<?= $this->endSection(); ?>