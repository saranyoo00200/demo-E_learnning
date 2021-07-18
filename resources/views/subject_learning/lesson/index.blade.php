@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>บทเรียน</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">บทเรียน</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>บทเรียน</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            <div>
                                <a href="{{ url('/lesson/content/addIndex/' . $subject_id) }}"
                                    class="btn btn-success">เพิ่ม</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive table-hover">
                        <table class="table table-striped" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10%">
                                        <i class="fas fa-th"></i>
                                    </th>
                                    <th style="width: 20%">บทเรียน</th>
                                    <th style="width: 35%">การบรรยาย</th>
                                    <th style="width: 10%">สถานะ</th>
                                    <th style="width: 20%">เครื่องมือ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $item)
                                    <tr>
                                        <td>
                                            <div class="text-center">
                                                <i class="fas fa-th"></i>
                                            </div>
                                        </td>
                                        <td>บทเรียนที่: {{ $item->lesson }}</td>
                                        <td>
                                            {!! Str::limit($item->title, 80) !!}
                                        </td>
                                        <td>
                                            @if ($item->show_lesson == 1)
                                                <span class="badge badge-success">แสดง</span>
                                            @else
                                                <span class="badge badge-danger">ไม่แสดง</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/lesson/content/show/' . $item->id) }}"
                                                class="btn btn-secondary"><i class="far fa-eye"></i></a>
                                            <a href="{{ url('/lesson/content/edit/' . $item->id) }}"
                                                class="btn btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="{{ url('/lesson/content/delete/' . $item->id) }}"
                                                class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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
