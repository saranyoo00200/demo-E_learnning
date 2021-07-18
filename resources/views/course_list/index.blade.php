@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>วิชาเรียน</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-hover">
                <table class="table table-striped mb-5" id="sortable-table">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <i class="fas fa-th"></i>
                            </th>
                            <th>ปี พ.ศ.</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th>หมวดหมู</th>
                            <th>เครื่องมือ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjectLearning as $item)
                            <tr>
                                <td>
                                    <div class="text-center">
                                        <i class="fas fa-th"></i>
                                    </div>
                                </td>
                                <td>{{ $item->schoolYear }}</td>
                                <td>{{ $item->subjectId }}</td>
                                <td>{{ $item->subjectName }}</td>
                                @if ($item->subjectType == 1)
                                    <td>
                                        <div class="badge badge-success">คอมพิวเตอร์</div>
                                    </td>
                                @elseif ($item->subjectType == 2)
                                    <td>
                                        <div class="badge badge-info">ภาษาไทย</div>
                                    </td>
                                @elseif ($item->subjectType == 3)
                                    <td>
                                        <div class="badge badge-secondary">ภาษาอังกฤษ</div>
                                    </td>
                                @endif
                                <td>
                                    <a href="{{ url('/total_score/' . $item->id) }}" class="btn btn-secondary"><i
                                            class="fas fa-table"></i></a>
                                    <a href="{{ url('/student_index/' . $item->id) }}" class="btn btn-warning"><i
                                            class="fas fa-play"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
