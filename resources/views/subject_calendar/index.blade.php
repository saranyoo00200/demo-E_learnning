@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section class="section">
        <div class="section-header">
            <h1>จัดการเรียนการสอน</h1>
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
                            <h4>ตาราง หมวดวิชาเรียน</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-hover">
                        <table class="table table-striped mb-5" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                      #
                                    </th>
                                    <th>ปี พ.ศ.</th>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>หมวดหมู่</th>
                                    <th>เครื่องมือ</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i=1; ?>
                                @foreach ($subjectLearning as $item)
                                    <tr>
                                        <td>
                                            <div class="text-center">
                                                {{ $i++ }}
                                            </div>
                                        </td>
                                        <td>{{ $item->schoolYear }}</td>
                                        <td>{{ $item->subjectId }}</td>
                                        <td>{{ $item->subjectName }}</td>
                                        <td>
                                          <?php if ($item->subjectType == 1): ?>
                                            <div class="badge badge-success">คอมพิวเตอร์</div>
                                          <?php elseif($item->subjectType == 2): ?>
                                            <div class="badge badge-info">ภาษาไทย</div>
                                          <?php else: ?>
                                            <div class="badge badge-secondary">ภาษาอังกฤษ</div>
                                          <?php endif; ?>
                                        </td>
                                        <td>
                                        <a href="{{ url('/subject_calendar/manage_lesson',[1,$item->id]) }}" class="btn btn-warning"><i class="fas fa-calendar-check"></i></a>
                                        <a href="{{ url('/subject_calendar/manage_lesson_type2',$item->id) }}" class="btn btn-success"><i class="fas fa-calendar-times"></i></a>
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
