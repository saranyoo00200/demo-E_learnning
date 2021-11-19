@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>จัดการเรียนการสอน</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>ตารางเรียนออฟไลน์ (วิชา {{ $subjectLearning['subjectName']}})</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-hover">
                        <table class="table table-striped mb-5" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">
                                        <i class="fas fa-th"></i>
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
