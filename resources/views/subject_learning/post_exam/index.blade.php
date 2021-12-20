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
                            <h4>แบบทดสอบหลังเรียน</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            <div>
                                <a href="{{ url('/posttest/exam/addIndex/' . $subject_id) }}"
                                    class="btn btn-success">เพิ่มข้อมูล</a>
                            </div>
                        </div>
                    </div>
                </div>
                @php($i = 1)
                <div class="card-body p-2">
                    <div class="row">
                        @foreach ($result as $item)
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h4>ข้อที่: {{ $i++ }}</h4>
                                        <div class="card-header-action">
                                            <div class="dropdown">
                                                <a href="#" data-toggle="dropdown"
                                                    class="btn btn-warning dropdown-toggle">เครื่องมือ</a>
                                                <div class="dropdown-menu">
                                                    <form class="delete-news-form_{{ $item->id }}"
                                                        action="{{ url('/posttest/exam/delete/' . $item->id) }}"
                                                        method="post">
                                                        <a href="{{ url('/posttest/exam/edit/' . $item->id) }}"
                                                            class="dropdown-item has-icon"><i class="far fa-edit"></i>
                                                            Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item has-icon text-danger remove_news"
                                                            data-id="{{ $item->id }}" onclick="return false"><i
                                                                class="far fa-trash-alt"></i>Delete</a>
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                                <a data-collapse="#mycard-collapse{{ $item->id }}"
                                                    class="btn btn-icon btn-info" href="#"><i
                                                        class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse " id="mycard-collapse{{ $item->id }}">
                                        <div class="card-body">
                                            <h4>{!! $item->question !!}</h4>
                                            <div class="row ml-2">
                                                <div class="col-md-6">
                                                    <div class="d-flex">
                                                        <p>1. </p>
                                                        <p>{!! $item->aq1 !!}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex">
                                                        <p>2. </p>
                                                        <p>{!! $item->aq2 !!}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex">
                                                        <p>3. </p>
                                                        <p>{!! $item->aq3 !!}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="d-flex">
                                                        <p>4. </p>
                                                        <p>{!! $item->aq4 !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-danger ml-4">เฉลยคำตอบข้อที่ถูกคือ: {{ $item->answer }}</p>
                                        </div>
                                        {{-- <div class="card-footer"></div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
