@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>บทนำ</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">บทนำ</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>จัดการบทนำ</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            <div>
                                <a href="{{ url('/introduction/content/addContentMore/'. $subject_id) }}" class="btn btn-success">เพิ่ม</a>
                            </div>
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
                        <table class="table table-striped" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10%">
                                        <i class="fas fa-th"></i>
                                    </th>
                                    <th style="width: 30%">บทนำ</th>
                                    <th style="width: 40%">รูปภาพ</th>
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
                                        <td>{!! $item->title !!}</td>
                                        <td>
                                            <img src="{{ asset($item->image) }}" width="40%" alt="">
                                        </td>
                                        <td>
                                            {{-- <a href="#" class="btn btn-secondary"><i class="far fa-eye"></i></a> --}}
                                            <a href="{{ url('/introduction/content/edit/' . $item->id) }}"
                                                class="btn btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="{{ url('/introduction/content/delete/' . $item->id) }}"
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
