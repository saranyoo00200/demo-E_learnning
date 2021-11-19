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
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($room as $item)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                                <article class="article">
                                    <div class="article-header">
                                        <div class="article-image" data-background="{{ asset($item->image) }}"
                                            style="background-image: url(&quot;../assets/img/news/img08.jpg&quot;);">
                                        </div>
                                        <div class="article-title text-center">
                                            <h2><a href="#">[ <u>{{ $item->subjectId }}</u> ]</a></h2>
                                            <h2><a href="#">{{ $item->subjectName }}</a></h2>
                                        </div>
                                    </div>
                                    <div class="article-details">
                                        <p class="h6 text-center font-weight-bold">ห้องที่ {{ $i++ }}</p>
                                        <div class="article-cta">
                                            <a href="{{ route('chat_system.show', 1) }}" class="btn btn-primary mt-4"><i
                                                    class="fas fa-door-open"></i>เข้าห้องการสนทนา</a>
                                            <div class="mt-4 text-success text-small text-center font-600-bold"><i
                                                    class="fas fa-circle"></i>ออนไลน์</div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
