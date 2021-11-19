@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>คะแนนสอบ[ก่อน-หลัง]</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-7">
                            @foreach ($subject as $item)
                                <h4>ผลคะแนน วิชา: {{ $item->subjectName }} </h4>
                            @endforeach
                        </div>
                    </div>
                </div>
                @php
                    $i = 1;
                    $j = 1;
                @endphp
                @php
                    $dataPre = DB::table('users')
                        ->join('pretest_scores', 'users.id', '=', 'pretest_scores.users_id')
                        ->where('pretest_scores.subject_id', '=', $id)
                        ->select('users.name', 'pretest_scores.score as preScore')
                        ->get();

                    $dataPost = DB::table('users')
                        ->join('posttest_scores', 'users.id', '=', 'posttest_scores.users_id')
                        ->where('posttest_scores.subject_id', '=', $id)
                        ->select('users.name', 'posttest_scores.score as postScore')
                        ->get();
                @endphp
                <div class="card-header">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#data1">คะแนนสอบก่อนเรียน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#data2">คะแนนสอบหลังเรียน</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-0 tab-content">
                    <div id="data1"
                        class="table-responsive table-invoice tab-pane active table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-striped mb-5" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <i class="fas fa-th"></i>
                                    </th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>คะแนนสอบก่อนเรียน ({{ $preScore }} คะแนน)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPre as $value)
                                    <tr>
                                        <td>
                                            <div class="text-center">
                                                {{ $i++ }}
                                            </div>
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->preScore }} คะแนน</td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="data2"
                        class="table-responsive table-invoice tab-pane fade table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-striped mb-5" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <i class="fas fa-th"></i>
                                    </th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>คะแนนสอบหลังเรียน ({{ $postScore }} คะแนน)</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($dataPost as $item)

                                    <tr>
                                        <td>
                                            <div class="text-center">
                                                {{ $j++ }}
                                            </div>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->postScore }} คะแนน</td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
