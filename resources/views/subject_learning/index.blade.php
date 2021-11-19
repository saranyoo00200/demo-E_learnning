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
                            <h4>วิชาเรียน</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            @role('admin')
                                <a href="{{ url('/categorie') }}" class="btn btn-primary">หมวดหมู่วิชา</a>
                            @endrole
                            <a href="{{ url('/subject_learning/addSubject') }}" class="btn btn-success">เพิ่มข้อมูล</a>
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
                                    <th>ปี พ.ศ.</th>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา</th>
                                    <th>หมวดหมู</th>
                                    <th>สถานะ</th>
                                    <th>เครื่องมือ</th>
                                </tr>
                            </thead>
                            @if ($user_id == 1)
                                <tbody>
                                    @foreach ($SubjectLearning_admin as $item)
                                        <tr>
                                            <td>
                                                <div class="text-center">
                                                    <i class="fas fa-th"></i>
                                                </div>
                                            </td>
                                            <td>{{ $item->schoolYear }}</td>
                                            <td>{{ $item->subjectId }}</td>
                                            <td>{{ $item->subjectName }}</td>
                                            <td>
                                                <div class="badge badge-secondary">{{ $item->category_name }}</div>
                                            </td>

                                            <td>
                                                @if ($item->show_subject == 1)
                                                    <span class="badge badge-success">แสดง</span>
                                                @else
                                                    <span class="badge badge-danger">ไม่แสดง</span>
                                                @endif
                                            </td>

                                            <td>
                                                <form class="delete-news-form_{{ $item->id }}"
                                                    action="{{ url('/subject_learning/delete/' . $item->id) }}"
                                                    method="post">
                                                    <div class="dropdown d-inline">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton2" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            ตัวเลือก
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
                            @else
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
                                            <td>
                                                <div class="badge badge-secondary">{{ $item->category_name }}</div>
                                            </td>

                                            <td>
                                                @if ($item->show_subject == 1)
                                                    <span class="badge badge-success">แสดง</span>
                                                @else
                                                    <span class="badge badge-danger">ไม่แสดง</span>
                                                @endif
                                            </td>

                                            <td>
                                                <form class="delete-news-form_{{ $item->subject_id }}"
                                                    action="{{ url('/subject_learning/delete/' . $item->subject_id) }}"
                                                    method="post">
                                                    <div class="dropdown d-inline">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton2" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            ตัวเลือก
                                                        </button>
                                                        <div class="dropdown-menu p-3">
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ url('/introduction/content/' . $item->subject_id) }}"></i>
                                                                บทนำ</a>
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ url('/pretest/subject/show/' . $item->subject_id) }}"></i>
                                                                สอบก่อนเรียน</a>
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ url('/lesson/subject/show/' . $item->subject_id) }}"></i>
                                                                บทเรียน</a>
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ url('/posttest/subject/show/' . $item->subject_id) }}"></i>
                                                                สอบหลังเรียน</a>
                                                        </div>
                                                    </div>
                                                    <a href="{{ url('/subject_learning/edit/' . $item->subject_id) }}"
                                                        class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                    <button class="btn btn-danger remove_news"
                                                        data-id="{{ $item->subject_id }}" onclick="return false"><i
                                                            class="fas fa-trash"></i></button>
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
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
