@extends('layouts.app')
@section('content')
<section class="section">
	<div class="section-header">
            <h1>ห้องสนทนา (Chatting Room)</h1>
     </div>
     <div class="section-body">
     			<div class="card">
     				<div class="card-header" style="display:block;">
							<div class="row">
								<div class="col-md-12">
									<h4>ห้องที่ 1</h4>
								</div>
							</div>
            </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                                    <div class="card">
                  <div class="card-header">
                    <h4>สมาชิกห้อง</h4>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                      <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('assets/backend/img/avatar/avatar-1.png')}}">
                        <div class="media-body">
                          <div class="mt-0 mb-1 font-weight-bold">Hasan Basri</div>
                          <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div>
                        </div>
                      </li>
                      <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('assets/backend/img/avatar/avatar-2.png')}}">
                        <div class="media-body">
                          <div class="mt-0 mb-1 font-weight-bold">Bagus Dwi Cahya</div>
                          <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Offline</div>
                        </div>
                      </li>
                      <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('assets/backend/img/avatar/avatar-3.png')}}">
                        <div class="media-body">
                          <div class="mt-0 mb-1 font-weight-bold">Wildan Ahdian</div>
                          <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i> Online</div>
                        </div>
                      </li>
                      <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset('assets/backend/img/avatar/avatar-4.png')}}">
                        <div class="media-body">
                          <div class="mt-0 mb-1 font-weight-bold">Rizal Fakhri</div>
                          <div class="text-small font-weight-600 text-success"><i class="fas fa-circle"></i> Online</div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                      </div>
                      <div class="col-8">
                <div class="card chat-box" id="mychatbox">
                  <div class="card-header">
                    <h4>ช่องทางการสนทนา</h4>
                  </div>
                  <div class="card-body chat-content">
                  </div>
                  <div class="card-footer chat-form">
                    <form id="chat-form">
                      <input type="text" class="form-control" placeholder="Type a message">
                      <button class="btn btn-primary">
                        <i class="far fa-paper-plane"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
                    </div>
                  </div>
     			</div>
     </div>
</section>
@endsection
@section('scripts')
<script src="{{asset('assets/backend/js/page/components-chat-box.js')}}"></script>
@endsection