@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>วิชาที่เปิดสอน</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>บทนำ</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            <div>
                                <a href="{{ url('/introduction/content/addContentMore/' . $subject_id) }}"
                                    class="btn btn-success">เพิ่มข้อมูล</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-hover">
                        <table class="table table-striped" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10%">
                                        <i class="fas fa-th"></i>
                                    </th>
                                    <th style="width: 20%">บทนำ</th>
                                    <th style="width: 20%">รูปภาพ</th>
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

                                        <td>{!! Str::limit($item->title, 100) !!}</td>
                                        <td>
                                            <img src="{{ asset($item->image) }}" width="100%" alt="">
                                        </td>
                                        <td>
                                            @if ($item->show_intro == 1)
                                                <span class="badge badge-success">แสดง</span>
                                            @else
                                                <span class="badge badge-danger">ไม่แสดง</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form class="delete-news-form_{{ $item->id }}"
                                                action="{{ url('/introduction/content/delete/' . $item->id) }}"
                                                method="post">
                                                <a href="{{ url('/introduction/content/show/' . $item->id) }}"
                                                    class="btn btn-info"><i class="far fa-eye"></i></a>
                                                <a href="{{ url('/introduction/content/edit/' . $item->id) }}"
                                                    class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                <button class="btn btn-danger remove_news" data-id="{{ $item->id }}"
                                                    onclick="return false"><i class="fas fa-trash"></i></button>
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
    @if (session('success'))
        <script type="text/javascript">
            swal({
                title: "Good job!",
                text: "{{ session('success') }}",
                icon: "success",
                button: "ตกลง",
            });
        </script>
    @endif
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.remove_news').click(function() {
                var news_id = $(this).attr('data-id');
                swal({
                        title: "เเจ้งเตือน",
                        text: "คุณต้องการลบข้อมูลหรือไม่",
                        icon: "warning",
                        buttons: {
                            confirm: 'ตกลง',
                            cancel: 'ยกเลิก'
                        },
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('.delete-news-form_' + news_id).submit();
                        }
                    });
            });
        });
    </script>
@endsection
