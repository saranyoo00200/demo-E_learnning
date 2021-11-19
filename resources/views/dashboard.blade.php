@extends('layouts.app')
@section('css-step')
    <style>
        /* tables */
        .my-custom-scrollbar {
            position: relative;
            max-height: 400px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }

        /* enc tables */
        .rd-container {
            display: none;
            /*border: 1px solid #333;*/
            background-color: #fff;
            padding: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);

        }

        .rd-container-attachment {
            position: absolute;
        }

        .rd-month {
            display: inline-block;
            margin-right: 25px;
        }

        .rd-month:last-child {
            margin-right: 0;
        }

        .rd-back,
        .rd-next {
            cursor: pointer;
            border: none;
            outline: none;
            background: none;
            padding: 0;
            margin: 0;
        }

        .rd-back[disabled],
        .rd-next[disabled] {
            cursor: default;
        }

        .rd-back {
            float: left;
            margin-left: 10px;
        }

        .rd-next {
            float: right;
            margin-right: 10px;
        }

        .rd-back:before {
            display: block;
            content: '\2190';
        }

        .rd-next:before {
            display: block;
            content: '\2192';
        }

        .rd-day-body {
            cursor: pointer;
            text-align: center;
            /* new */
            line-height: 0;
            width: 50px !important;
            height: 50px !important;
        }

        .rd-day-selected,
        .rd-time-selected,
        .rd-time-option:hover {
            cursor: pointer;
            background-color: #f67280;
            color: #fff;
            /* new */
            border-radius: 50%;
        }

        .rd-day-prev-month,
        .rd-day-next-month {
            color: #ccc;
        }

        .rd-day-disabled {
            cursor: default;
            color: #fcc;
        }

        .rd-time {
            position: relative;
            display: inline-block;
            margin-top: 5px;
            min-width: 80px;
        }

        .rd-time-list {
            display: none;
            position: absolute;
            overflow-y: scroll;
            max-height: 160px;
            left: 0;
            right: 0;
            background-color: #fff;
            color: #333;
        }

        .rd-time-selected {
            padding: 5px;
        }

        .rd-time-option {
            padding: 5px;
        }

        .rd-day-concealed {
            visibility: hidden;
        }

        .rd-days {
            margin-top: 20px;
        }

    </style>
@endsection
@section('content')
    <div class="section">
        <div class="section-header">
            <h1>หน้าหลัก</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>จำนวนผู้ใช้งาน</h4>
                        </div>
                        <div class="card-body">
                            {{ $user_student }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>จำนวนข่าวและกิจกรรม</h4>
                        </div>
                        <div class="card-body">
                            {{ $news }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>จำนวนวิชาเรียน</h4>
                        </div>
                        <div class="card-body">
                            {{ $subject }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>จำนวนบทเรียน</h4>
                        </div>
                        <div class="card-body">
                            {{ $lesson }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>สถิติการเข้าใช้งาน</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="180"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div id="inline_cal" class="card">
                    <div class="card-header">
                        <h4>ปฏิทิน</h4>
                    </div>
                </div>
            </div>
        </div>
        @role('admin')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#data1">นักเรียน</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#data2">อาจารย์</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-0 tab-content">
                            <div id="data1"
                                class="table-responsive table-invoice tab-pane active table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-striped">
                                    <tr>
                                        <th>ID</th>
                                        <th>ชื่อผู้ใช้</th>
                                        <th>สถานะ</th>
                                        {{-- <th>สถานะการใช้งาน</th> --}}
                                        <th>ข้อมูลส่วนตัว</th>
                                    </tr>
                                    @foreach ($student as $item)
                                        <tr>
                                            <td><a href="#">LE-{{ $item->id }}</a></td>
                                            <td class="font-weight-600">{{ $item->name }}</td>
                                            <td>
                                                @if ($item->user_status == 1)
                                                    <div class="badge badge-success">ใช้งาน</div>
                                                @elseif ($item->user_status == 2)
                                                    <div class="badge badge-danger">ไม่ใช้งาน</div>
                                                @endif
                                            </td>
                                            {{-- <td>July 19, 2018</td> --}}
                                            <td>
                                                <a href="{{ url('/dashboard/' . $item->id . '/detail') }}"
                                                    class="btn btn-primary">รายละเอียด</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div id="data2"
                                class="table-responsive table-invoice tab-pane fade table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-striped">
                                    <tr>
                                        <th>ID</th>
                                        <th>ชื่อผู้ใช้</th>
                                        <th>สถานะ</th>
                                        {{-- <th>สถานะการใช้งาน</th> --}}
                                        <th>ข้อมูลส่วนตัว</th>
                                    </tr>
                                    @foreach ($teacher as $value)
                                        <tr>
                                            <td><a href="#">LE-{{ $value->id }}</a></td>
                                            <td class="font-weight-600">{{ $value->name }}</td>
                                            <td>
                                                @if ($value->user_status == 1)
                                                    <div class="badge badge-success">ใช้งาน</div>
                                                @elseif ($value->user_status == 2)
                                                    <div class="badge badge-danger">ไม่ใช้งาน</div>
                                                @endif
                                            </td>
                                            {{-- <td>July 19, 2018</td> --}}
                                            <td>
                                                <a href="{{ url('/dashboard/' . $value->id . '/detail') }}"
                                                    class="btn btn-primary">รายละเอียด</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <h4>{{ $tickets_count }}</h4>
                            <div class="card-description">Customers need help</div>
                        </div>
                        <div class="card-body p-0">
                            <div class="tickets-list my-custom-scrollbar">
                                @foreach ($tickets as $ticket)
                                    <a href="{{ url('/dashboard/' . $ticket->tickets_id . '/tickets') }}"
                                        class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>{!! Str::limit($ticket->message, 20) !!}</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>{{ $ticket->name }}</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary">
                                                {{ Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}</div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            {{-- // --}}
                        </div>
                    </div>
                </div>
            </div>
        @endrole
    </div>
    @if (session('success'))
        <script type="text/javascript">
            swal({
                title: "Good job!",
                text: "{{ session('success') }}",
                icon: "success",
                button: "ตกลง",
            });
        </script>
    @endif
@endsection
@section('script')
    {{-- calendar dashboard --}}
    <script src="{{ asset('assets/backend/js/rome.js') }}"></script>
    <script>
        $(function() {

            rome(inline_cal, {
                time: false
            });

        });
    </script>
    {{-- end calendar dashboard --}}

    {{-- chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- annotions -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.min.js"
        integrity="sha512-FuXN8O36qmtA+vRJyRoAxPcThh/1KJJp7WSRnjCpqA+13HYGrSWiyzrCHalCWi42L5qH1jt88lX5wy5JyFxhfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        const labels = [
            <?php echo $monthname; ?>
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'จำนวนผู้เข้าใช้(คน)',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [<?php echo $count; ?>],
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {

            }
        };
        // === include 'setup' then 'config' above ===

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection
