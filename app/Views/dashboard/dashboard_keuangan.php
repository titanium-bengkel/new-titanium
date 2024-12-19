<?= $this->extend('layout/template'); ?>
<?= $this->section('content');  ?>

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


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




    <script>
        // Line Chart
        var ctx = document.getElementById('line').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['01-Oct', '05-Oct', '10-Oct', '15-Oct', '20-Oct', '25-Oct', '31-Oct'], // Sesuaikan label
                datasets: [{
                        label: 'Piutang',
                        borderColor: 'green',
                        // backgroundColor: 'rgba(0, 255, 0, 0.2)',
                        data: [700000000, 750000000, 770000000, 780000000, 650000000, 780000000, 774773293], // Data Piutang
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Hutang',
                        borderColor: 'yellow',
                        // backgroundColor: 'rgba(255, 255, 0, 0.2)',
                        data: [690000000, 720000000, 730000000, 740000000, 660000000, 770000000, 669933026], // Data Hutang
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
                    backgroundColor: ['#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff'], // Adjust colors
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
                labels: ['Nov-23', 'Jan-24', 'Feb-24', 'Apr-24', 'Jun-24', 'Jul-24', 'Sep-24', 'Nov-24'], // Sesuaikan label waktu
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
                        data: [723214688, 540042243, 652848526, 1133486978, 644882329, 800536134, 548632085, 625213420], // Data nominal
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


    <!-- end card -->



    <?= $this->endSection(); ?>