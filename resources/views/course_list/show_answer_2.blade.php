@extends('layouts.app')
@section('css-script')
<!-- donut chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['title', 'score pretest'],
            <?php echo $chartData; ?>,
            <?php echo $chartTotal; ?>,

        ]);

        var options = {
            title: 'ทดสอบก่อนเรียน',
            pieHole: 0.0,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>

<!-- posttest -->
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['title', 'score pretest'],
            <?php echo $chartData2; ?>,
            <?php echo $chartTotal2; ?>,

        ]);

        var options = {
            title: 'ทดสอบหลังเรียน',
            pieHole: 0.0,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart.draw(data, options);
    }
</script>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>ผลการทดสอบหลังเรียน</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>
    <div class="row p-0">
        <div class="col-md-3">
            <div class="card">
                @foreach ($introduction as $item)
                <img src="{{ asset($item->image) }}" width="100%" height="220px" alt="">
                @endforeach
            </div>
        </div>
        <div class="col-md-3 text-center">
            <div class="card p-4" style="height: 220px">
                <div style="font-size: 14px;" class="py-2">
                    @foreach ($subject as $item)
                    วิชา: {{ $item->subjectName }}<br>
                    @endforeach

                    <span class="text-danger">ใช้เวลา {{ $item->timer }} นาที</span><br>

                    <button class="btn btn-outline-secondary">ดูผลเฉลย</button>
                </div>
                <div class="py-2">
                    <a href="{{ url('/course_list') }}" class="btn btn-primary">กลับสู่บทเรียน</a>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card p-4" style="height: 220px">
                <span><b>วันที่ {{ formatDateThai(date($item->created_at)) }}</b></span>
                @foreach ($introduction as $item)
                <p style="text-indent: 50px">{!! $item->title !!}</p>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
            <div class="p-3 text-center">
                <div id="donutchart" style="width: 100%; height: 100%;"></div><br>
                @foreach($preScore as $value)
                <b>คะแนนก่อนเรียน {{ $value->score }}/{{ $pretestExam->count() }} คะแนน</b>
                @endforeach
            </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-white p-3">
                <canvas id="myChart1" style="width: 100%; height: 240px;"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 text-center">
                <div id="donutchart2" style="width: 100%; height: 100%;"></div><br>
                @foreach($postScore as $value2)
                <b>คะแนนหลังเรียน {{ $value2->score }}/{{ $posttestExam->count() }} คะแนน</b>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-white p-3">
                <canvas id="myChart2" style="width: 100%; height: 240px;"></canvas>
            </div>
        </div>
    </div>

</section>
@endsection

@section('script')
<!-- line chart  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- annotions -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.min.js" integrity="sha512-FuXN8O36qmtA+vRJyRoAxPcThh/1KJJp7WSRnjCpqA+13HYGrSWiyzrCHalCWi42L5qH1jt88lX5wy5JyFxhfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- line chart1  -->
<script>
    var ctx = document.getElementById('myChart1');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo $label_score ?>],
            datasets: [{
                label: 'คะแนนสอบก่อนเรียน',
                fill: false,
                data: [<?php echo $data_score ?>],
                backgroundColor: [
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgb(75, 192, 192)'
                ],
                borderWidth: 1,
                tension: 0.3,
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'ช่วงคะแนนของผู้ทดสอบก่อนเรียนทั้งหมด'
                },
                autocolors: false,
                annotation: {
                    annotations: {
                        line1: {
                            type: 'point',
                            xValue: <?php echo $scoreMe_score ?>,
                            yValue: <?php echo $scoreMe_label ?>,
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.25)',
                        },

                    }
                }
            },
            scales: {
                x: {
                    title: {
                        color: 'red',
                        display: true,
                        text: 'คะแนน'
                    }
                },
                y: {
                    title: {
                        color: 'red',
                        display: true,
                        text: 'จำนวนนักเรียน (คน)'
                    }
                },
            }
        }
    });
</script>

<!-- line chart2  -->
<script>
    var ctx = document.getElementById('myChart2');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo $label_score2 ?>],
            datasets: [{
                label: 'คะแนนสอบก่อนเรียน',
                fill: false,
                tension: 0.3,
                data: [<?php echo $data_score2 ?>],
                backgroundColor: [
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'ช่วงคะแนนของผู้ทดสอบก่อนเรียนทั้งหมด'
                },
                autocolors: false,
                annotation: {
                    annotations: {
                        line2: {
                            type: 'point',
                            xValue: <?php echo $scoreMe_score2 ?>,
                            yValue: <?php echo $scoreMe_label2 ?>,
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.25)',
                        },

                    }
                }
            },
            scales: {
                x: {
                    title: {
                        color: 'red',
                        display: true,
                        text: 'คะแนน'
                    }
                },
                y: {
                    title: {
                        color: 'red',
                        display: true,
                        text: 'จำนวนนักเรียน (คน)'
                    }
                },
            }
        }
    });
</script>
@endsection