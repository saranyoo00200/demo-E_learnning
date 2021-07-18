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
									<h4>ห้องสนทนา (Chatting Room)</h4>
								</div>
							</div>
            </div>
                  <div class="card-body">
                    <div class="row">
              <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article">
                  <div class="article-header">
                    <div class="article-image" data-background="{{asset('assets/backend/img/news/img01.jpg')}}" style="background-image: url(&quot;../assets/img/news/img08.jpg&quot;);">
                    </div>
                    <div class="article-title">
                      <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                    </div>
                  </div>
                    <div class="article-details">
                    <p class="h6 text-center font-weight-bold">ห้องที่ 1</p>
                    <div class="article-cta">
                      <a href="{{ route('chat_system.show',1) }}" class="btn btn-primary mt-4"><i class="fas fa-door-open"></i>เข้าห้องการสนทนา</a>
                       <div class="mt-4 text-success text-small text-center font-600-bold"><i class="fas fa-circle"></i>ออนไลน์</div>
                    </div>
                  </div>
                </article>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article">
                  <div class="article-header">
                    <div class="article-image" data-background="{{asset('assets/backend/img/news/img02.jpg')}}" style="background-image: url(&quot;../assets/img/news/img04.jpg&quot;);">
                    </div>
                    <div class="article-title">
                      <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                    </div>
                  </div>
                  <div class="article-details">
                    <p class="h6 text-center font-weight-bold">ห้องที่ 2</p>
                    <div class="article-cta">
                      <a href="#" class="btn btn-primary mt-4"><i class="fas fa-door-open"></i>เข้าห้องการสนทนา</a>
                       <div class="mt-4 text-muted text-small text-center font-600-bold"><i class="fas fa-circle"></i>ออฟไลน์</div>
                    </div>
                  </div>
                </article>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article">
                  <div class="article-header">
                    <div class="article-image" data-background="{{asset('assets/backend/img/news/img03.jpg')}}" style="background-image: url(&quot;../assets/img/news/img09.jpg&quot;);">
                    </div>
                    <div class="article-title">
                      <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                    </div>
                  </div>
                  <div class="article-details">
                    <p class="h6 text-center font-weight-bold">ห้องที่ 3</p>
                    <div class="article-cta">
                      <a href="#" class="btn btn-primary mt-4"><i class="fas fa-door-open"></i>เข้าห้องการสนทนา</a>
                       <div class="mt-4 text-success text-small text-center font-600-bold"><i class="fas fa-circle"></i>ออนไลน์</div>
                    </div>
                  </div>
                </article>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <article class="article">
                  <div class="article-header">
                    <div class="article-image" data-background="{{asset('assets/backend/img/news/img04.jpg')}}" style="background-image: url(&quot;../assets/img/news/img12.jpg&quot;);">
                    </div>
                    <div class="article-title">
                      <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                    </div>
                  </div>
                  <div class="article-details">
                    <p class="h6 text-center font-weight-bold">ห้องที่ 4</p>
                    <div class="article-cta">
                      <a href="#" class="btn btn-primary mt-4"> <i class="fas fa-door-open"></i>เข้าห้องการสนทนา</a>
                       <div class="mt-4 text-muted text-small text-center font-600-bold"><i class="fas fa-circle"></i>ออฟไลน์</div>
                    </div>
                  </div>
                </article>
              </div>
            </div>
                  </div>
     			</div>
     </div>
</section>
@endsection
