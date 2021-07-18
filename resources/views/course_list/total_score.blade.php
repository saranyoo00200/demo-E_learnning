@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>คะแนนสอบ[ก่อน-หลัง]</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
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
                        <div class="col-md">
                            <div class="d-flex">
                                <input type="search" class="form-control" value="">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $i = 1;
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body p-0">
                            <div class="table-responsive table-hover">
                                <table class="table table-striped mb-5" id="sortable-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <i class="fas fa-th"></i>
                                            </th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>คะแนนสอบก่อนเรียน ({{ $preScore->count() }} คะแนน)</th>
                                            <th>คะแนนสอบหลังเรียน ({{ $postScore->count() }} คะแนน)</th>
                                            {{-- <th>ผลต่างของคะแนน</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($score as $item)

                                            <tr>
                                                <td>
                                                    <div class="text-center">
                                                        {{ $i++ }}
                                                    </div>
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->preScore }} คะแนน</td>
                                                <td>{{ $item->postScore }} คะแนน</td>
                                                {{-- <td>#</td> --}}
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
