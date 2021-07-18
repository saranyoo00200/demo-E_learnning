@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section class="section">
        <div class="section-header">
            <h1>หมวดวิชาเรียน</h1>
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
                        <div class="col-md-6">
                            <h4>หมวดวิชาเรียน</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            <a href="{{ url('/subject_learning/addSubject') }}" class="btn btn-success">เพิ่ม</a>
                        </div>
                    </div>
                    {{-- <div class="card-header-action">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div> --}}
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
                                            {{-- <a href="{{ url('/student_index') }}" class="btn btn-secondary">เริ่มเรียน</a> --}}
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Option!
                                                </button>
                                                <div class="dropdown-menu p-3">
                                                    <a class="dropdown-item has-icon"
                                                        href="{{ url('/introduction/content/' . $item->id) }}"></i>
                                                        บทนำ</a>
                                                    <a class="dropdown-item has-icon"
                                                        href="{{ url('/pretest/subject/show/' . $item->id) }}"></i>
                                                        สอบก่อนเรียน</a>
                                                    <a class="dropdown-item has-icon"
                                                        href="{{ url('/lesson/subject/show/' . $item->id) }}"></i>
                                                        บทเรียน</a>
                                                    <a class="dropdown-item has-icon"
                                                        href="{{ url('/posttest/subject/show/' . $item->id) }}"></i>
                                                        สอบหลังเรียน</a>
                                                </div>
                                            </div>
                                            <a href="{{ url('/subject_learning/edit/' . $item->id) }}"
                                                class="btn btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="{{ url('/subject_learning/delete/' . $item->id) }}"
                                                class="btn btn-danger"
                                                onclick="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่ ?');"><i
                                                    class="far fa-trash-alt"></i></a>
                                        </td>
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
