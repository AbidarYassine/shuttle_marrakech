@extends('layouts.admin.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/fonts/simple-line-icons/style.min.css')}}">
@endsection
@section('content')
    <section id="icon-section-bg">
        <div class="row">
            <div class="col-12 mt-3 mb-1">
                <h4 class="text-uppercase text-center font-weight-bold mb-1">Des Statistique
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-info bg-darken-2 rounded-left">
                                <!-- <i class="icon-camera font-large-2 text-white"></i> -->
                                <!-- <i class="fa font-large-2 text-white  fa-money-check-alt"></i> -->
                                <i class="fas font-large-2 text-white fa-concierge-bell"></i>
                            </div>
                            <div class="p-2 bg-info text-white media-body rounded-right">
                                <h5 class="text-white">Mission Demandé</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$missionDemande}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-danger bg-darken-2 rounded-left">
                                <i class="fas fa-award font-large-2 text-white"></i>
                            </div>
                            <div class="p-2 bg-danger text-white media-body rounded-right">
                                <h5 class="text-white">Mission Réalisée</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{count($missionRealiser)}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-success bg-darken-2 rounded-left">
                                <i class="fa font-large-2 text-white  fa-money-check-alt"></i>
                            </div>
                            <div class="p-2 bg-success text-white media-body rounded-right">
                                <h5 class="text-white">Chiffre D'affaire</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$chiffreAffiare." DH"}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <canvas id="myChart" width="600" height="300"></canvas>
        </div>
        <div class="row">
            <canvas id="myChart2" width="600" height="300"></canvas>
        </div>
        <div class="row">
            <canvas id="myChart3" width="600" height="300"></canvas>
        </div>
        <div class="row">
            <canvas id="myChart4" width="600" height="300"></canvas>
        </div>
    </div>
@endsection
@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
            integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg=="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{route('admin.statistique')}}",
                method: "POST",
                data: {
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                    console.log(data);
                    var ctx = document.getElementById('myChart');
                    var ctx2 = document.getElementById('myChart2');
                    var ctx3 = document.getElementById('myChart3');
                    var ctx4 = document.getElementById('myChart4');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.array,
                            datasets: [{
                                label: '# Mission Realisé Densité de chaque véhicule',
                                data: data.numCount,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                    var myLineChart = new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: data.array,
                            datasets: [{
                                label: '# Mission Realisé Densité de chaque véhicule',
                                data: data.numCount,
                                backgroundColor: [

                                    'rgba(54, 162, 235, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(75, 192, 192, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },

                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }

                    });
                    var myLineChart1 = new Chart(ctx3, {
                        type: 'line',
                        data: {
                            labels: ['Janvier', 'février', 'mars', 'avril', 'Mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
                            datasets: [{
                                label: '#La reservation en fonction du mois',
                                data: data.MonthReservation,
                                backgroundColor: [

                                    'rgba(255, 99, 132, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(75, 192, 192, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },

                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }

                    });
                    var myLineChart4 = new Chart(ctx4, {
                        type: 'bar',
                        data: {
                            labels: ['Janvier', 'février', 'mars', 'avril', 'Mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
                            datasets: [{
                                label: '# La reservation en fonction du mois',
                                data: data.MonthReservation,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },

                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }

                    });
                },

                error: function (one, two, three) {
                    console.log(one, two, three);
                }
            });
        });
    </script>
@endsection
