@extends('layouts.app')
@section('content')
    <section class="section" data-id=''>
        <div class="section-header">
            <h1>จัดการผู้ใช้งาน(User Manager)</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header" style="display:block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>จัดการผู้ใช้งาน (User_manager)</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            <div class="form-group row" style="margin-top: 31px;margin-bottom: -3px;" align="right">
                                <label class="col-md-3 col-form-label">ประเภทผู้ใช้</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="user_type" name="user_type">
                                        <option value=''>เลือกทั้งหมด</option>
                                        <option <?php if ($user_type == 1): ?> selected <?php endif ?> value="1">เจ้าหน้าที่
                                        </option>
                                        <option <?php if ($user_type == 2): ?> selected <?php endif ?> value="2">ผู้ใช้บริการ
                                        </option>
                                        <option <?php if ($user_type == 3): ?> selected <?php endif ?> value="3">คุณครู</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <span class="dropdown show">

                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            ส่งออกข้อมูล
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#" onclick="loadPdf();">PDF</a>
                                            <a class="dropdown-item" href="#" onclick="loadExcel();">Excel</a>
                                        </div>
                                    </span>
                                    <a href="{{ route('users.create') }}" class="btn btn-success">เพิ่มข้อมูล</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table class="table table-striped" id="sortable-table">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%"><i class="fas fa-th"></i></th>
                                    <th scope="col">รหัสผู้ใช้</th>
                                    <th scope="col">ชื่อผู้ใช้</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">ประเภทผู้ใช้งาน</th>
                                    <th scope="col">เครื่องมือ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($users as $value): ?>
                                <tr>
                                    <td>{{ $i++ }}</th>
                                    <td>{{ $value->username }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td><?php if ($value->user_status == 1): ?>
                                        <p class="text-success mb-0">ใช้งาน</p>
                                        <?php else: ?>
                                        <p class="text-danger mb-0">ไม่ใช้งาน</p>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php if ($value->user_type == 1): ?>
                                        เจ้าหน้าที่
                                        <?php elseif($value->user_type == 2): ?>
                                        ผู้ใช้บริการ
                                        <?php elseif($value->user_type == 3): ?>
                                        ครู
                                        <?php else: ?>
                                        นักเรียน
                                        <?php endif; ?></td>
                                    <td>

                                        <form class="delete-user-form_{{ $value->id }}"
                                            action="{{ route('users.destroy', $value->id) }}" method="POST">
                                            @if ($value->user_type == 3)
                                                <a class="btn btn-secondary"
                                                    href="{{ url('/access_lesson/' . $value->id) }}"><i
                                                        class="fas fa-book"></i></a>
                                            @endif

                                            <a href="{{ route('users.show', $value->id) }}" class="btn btn-info"> <i
                                                    class="fas fa-eye"></i></a>
                                            <?php if (auth()->user()->user_type != 3): ?>
                                            <a href="{{ route('users.edit', $value->id) }}" class="btn btn-warning"><i
                                                    class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger remove_user" data-id="{{ $value->id }}"
                                                onclick="return false"><i class="fas fa-trash"></i></button>
                                            <?php endif; ?>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#user_type").change(function() {
                var user_type = $('#user_type').val();
                window.open("{{ url('users') }}" + '?user_type=' + user_type, '_self');
            });
            $('.remove_user').click(function() {
                var user_id = $(this).attr('data-id');
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
                            $('.delete-user-form_' + user_id).submit();
                        }
                    });
            });
        });

        function loadPdf() {
            var user_type = $('#user_type').val();
            window.open("{{ url('export_pdf') }}" + '?user_type=' + user_type, '_blank');
        }

        function loadExcel() {
            var user_type = $('#user_type').val();
            window.open("{{ url('export_excel') }}" + '?user_type=' + user_type, '_blank');
        }
    </script>
@endsection
