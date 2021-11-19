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
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-12 col-md-6 col-sm-12">
                <div class="card bg-light">
                  <div class="card-body">
                    <div class="empty-state" data-height="400" style="height: 400px;">
                      <div class="empty-state-icon bg-success">
                        <i class="fas fa-calendar-check"></i>
                      </div>
                      <h2>การเรียนแบบออนไลน์ (Online)</h2>
                      <a href="{{ url('subject_calendar/manage_schedule','1') }}" class="btn btn-primary mt-4">ดูรายละเอียด</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-sm-12">
                <div class="card bg-light">
                  <div class="card-body">
                    <div class="empty-state" data-height="400" style="height: 400px;">
                      <div class="empty-state-icon bg-danger">
                        <i class="fas fa-calendar-times"></i>
                      </div>
                      <h2>การเรียนแบบออฟไลน์ (Offline)</h2>
                      <a href="{{ url('subject_calendar/manage_synchronous','2') }} " class="btn btn-primary mt-4">ดูรายละเอียด</a>
                    </div>
                  </div>
                </div>
              </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
@endsection
