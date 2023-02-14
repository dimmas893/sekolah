@extends('layouts.template.template')
@section('content')
    <div class="main-content">
        @php
            $menuAkses = Auth::user()->role;
            if ($menuAkses === 5) {
                $anda = 'Siswa';
            } elseif ($menuAkses === 4) {
                $anda = 'Wali Siswa';
            } elseif ($menuAkses === 3) {
                $anda = 'Guru';
            } elseif ($menuAkses === 1) {
                $anda = 'Administrator';
            }
        @endphp
        <section class="section">
            <div class="section-header">
                <h1>Dashboard {{ $anda }}</h1>
            </div>

            <div class="section-body">
                <div id="isiDashboard">

                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Statistik Siswa</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="myBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Kalender</h4>
                            </div>
                            <div class="card-body">
                                <div class="fc-overflow">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </div>
@endsection

@section('js')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: [
                    @foreach ($kegiatans as $kegiatan)
                        {
                            title: '{{ $kegiatan->nama_kegiatan }}',
                            start: '{{ $kegiatan->tanggal }}'
                        },
                    @endforeach
                ]
            })
        });
    </script>
    <script>
        $(function() {

            // fetch all employees ajax request
            showDataDashboard();

            function showDataDashboard() {
                $.ajax({
                    url: '{{ route('isi-dashboard') }}',
                    method: 'get',
                    success: function(response) {
                        $("#isiDashboard").html(response);

                    }
                });
            }
        });
    </script>
    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
        // Bar Chart Example
        var ctx = document.getElementById('myBarChart');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($jenjang as $p)
                        '{{ $p['nama'] }}',
                    @endforeach
                ],
                datasets: [{
                    label: "Jumlah",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: [
                        {{ $tot_sis_sd }},
                        {{ $tot_sis_smp }},
                        {{ $tot_sis }}
                    ],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'jumlah'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        },
                        maxBarThickness: 25,
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: {{ $siswa }},
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + tooltipItem.yLabel;
                        }
                    }
                },
            }
        });
    </script>
@endsection
