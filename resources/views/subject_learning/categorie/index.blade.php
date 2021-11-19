@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>หมวดวิชาเรียน</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>หมวดหมู่วิชา</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            <a href="{{ url('/categorie/addIndex') }}" class="btn btn-success">เพิ่มข้อมูล</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-hover">
                        <table class="table table-striped mb-5 text-center" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <i class="fas fa-th"></i>
                                    </th>
                                    <th>รูปภาพ</th>
                                    <th>ชื่อวิชา</th>
                                    <th>สถานะ</th>
                                    <th>เครื่องมือ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subject_categories as $item)
                                    <tr>
                                        <td>
                                            <div class="text-center">
                                                <i class="fas fa-th"></i>
                                            </div>
                                        </td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>
                                            <div class="badge badge-info">{{ $item->category_name }}</div>
                                        </td>
                                        <td>
                                            @if ($item->category_status == 1)
                                                <div class="badge badge-success">ใช้งาน</div>
                                            @elseif ($item->category_status == 2)
                                                <div class="badge badge-danger">ไม่ใช้งาน</div>
                                            @endif
                                        </td>
                                        <td>
                                            <form class="delete-news-form_{{ $item->id }}"
                                                action="{{ url('/categorie/delete/' . $item->id) }}"
                                                method="post">
                                                <a href="{{ url('/categorie/' . $item->id . '/edit') }}"
                                                    class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                <button class="btn btn-danger remove_news"
                                                    data-id="{{ $item->id }}" onclick="return false"><i
                                                        class="fas fa-trash"></i></button>
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
