@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>คะแนนสอบ</h1>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>คะแนน</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive table-hover">
                    <table class="table table-striped mb-5 text-center" id="sortable-table">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fas fa-th"></i>
                                </th>
                                <th>ปี พ.ศ.</th>
                                <th>รหัสวิชา</th>
                                <th>ชื่อวิชา</th>
                                <th>หมวดหมู</th>
                                <th>เครื่องมือ</th>
                            </tr>
                        </thead>
                        @if ($user_id == 1)
                            <tbody>
                                @foreach ($subjectLearning_admin as $item)
                                    <tr>
                                        <td>
                                            <div class="text-center">
                                                <i class="fas fa-th"></i>
                                            </div>
                                        </td>
                                        <td>{{ $item->schoolYear }}</td>
                                        <td>{{ $item->subjectId }}</td>
                                        <td>{{ $item->subjectName }}</td>

                                        <td>
                                            <div class="badge badge-secondary">{{ $item->category_name }}</div>
                                        </td>

                                        <td>
                                            {{-- <div class="dropdown d-inline">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Option!
                                            </button>
                                            <div class="dropdown-menu p-3">
                                                <a class="dropdown-item has-icon"
                                                    href="{{ url('/student_index/' . $item->id) }}"></i>
                                                    บทนำ</a>
                                                <a class="dropdown-item has-icon"
                                                    href="{{ url('/student_pretest/' . $item->id) }}"></i>
                                                    สอบก่อนเรียน</a>
                                                <a class="dropdown-item has-icon"
                                                    href="{{ url('/student_lesson/' . $item->id) }}"></i>
                                                    บทเรียน</a>
                                                <a class="dropdown-item has-icon"
                                                    href="{{ url('/student_posttest/' . $item->id) }}"></i>
                                                    สอบหลังเรียน</a>
                                            </div>
                                        </div> --}}
                                            <a href="{{ url('/total_score/' . $item->id) }}" class="btn btn-info"><i
                                                    class="fas fa-table"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
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
                                            {{-- <div class="dropdown d-inline">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Option!
                                            </button>
                                            <div class="dropdown-menu p-3">
                                                <a class="dropdown-item has-icon"
                                                    href="{{ url('/student_index/' . $item->id) }}"></i>
                                                    บทนำ</a>
                                                <a class="dropdown-item has-icon"
                                                    href="{{ url('/student_pretest/' . $item->id) }}"></i>
                                                    สอบก่อนเรียน</a>
                                                <a class="dropdown-item has-icon"
                                                    href="{{ url('/student_lesson/' . $item->id) }}"></i>
                                                    บทเรียน</a>
                                                <a class="dropdown-item has-icon"
                                                    href="{{ url('/student_posttest/' . $item->id) }}"></i>
                                                    สอบหลังเรียน</a>
                                            </div>
                                        </div> --}}
                                            <a href="{{ url('/total_score/' . $item->id) }}" class="btn btn-info"><i
                                                    class="fas fa-table"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
