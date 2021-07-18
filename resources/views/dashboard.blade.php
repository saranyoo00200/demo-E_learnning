@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="section-header">
            <h1>dashboard!</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">
                </div>
            </div>
        </div>
        <div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-primary">
        <i class="far fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>จำนวนผู้ใช้งาน</h4>
        </div>
        <div class="card-body">
          10
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-danger">
        <i class="far fa-newspaper"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>ข่าว</h4>
        </div>
        <div class="card-body">
          42
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-warning">
        <i class="far fa-file"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>จำนวนวิชา</h4>
        </div>
        <div class="card-body">
          1,201
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
      <div class="card-icon bg-success">
      <i class="fas fa-book"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>จำนวนบทเรียน</h4>
        </div>
        <div class="card-body">
          47
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
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
