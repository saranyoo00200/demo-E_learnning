@extends('layouts.app')

@section('content')
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
                            <h4>ตาราง การเรียนไม่ประสานเวลา (วิชา {{ $subjectLearning['subjectName']}})</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-hover">
                        <table class="table table-striped mb-5" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">
                                        #
                                    </th>
                                    <th>ชื่อหลักสูตร</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i=1; foreach ($LessonSynch as $key => $value): ?>
                                <tr>
                                  <td class="text-center">{{ $i++ }}</td>
                                  <td>{{ $value->lessonName }}</td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
