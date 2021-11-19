@extends('layouts.app')
@section('css-step')


<style type="text/css">
    .form-section {
        display: none
    }

    .form-section.current {
        display: block !important;
    }

    .parsley-errors-list {
        color: red
    }

    .parsley-success {
        color: green;
    }

    /* radio */

    .radio {
        display: block;
        width: 1em;
        height: 1em;
        border-radius: 50%;
        border: 0.1em solid currentColor;
        transform: translateY(-0.05em);
    }
</style>
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1>ทดสอบก่อนเรียน</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>
    @php
    $i = 1;
    $s = 1;
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="text-danger text-center"><span style="font-size: 20px" class="time">00:00</span> นาที!</div>

        </div>
    </div>
    <div class="section-body">
        <div class="card p-3">

            <form class="demo-form" action="{{ url('/check_pretest_save/' . $subject_id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @foreach ($pretestExam as $item)
                <section class="form-section py-3">

                    <div class="py-2">
                        <h5>{!! $item->question !!}</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-4 ml-5">
                            <label>
                                <input class="form-control-input" name="answer[{{ $item->id }}]" type="radio" value="1" required>
                                <span>ตัวเลือกที่ 1: {!! $item->aq1 !!}</span>
                            </label>
                        </div>
                        <div class="col-md ml-5">
                            <label>
                                <input class="form-control-input" name="answer[{{ $item->id }}]" type="radio" value="2" required>
                                <span>ตัวเลือกที่ 2: {!! $item->aq2 !!}</span>
                            </label>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 ml-5">
                            <label>
                                <input class="form-control-input" name="answer[{{ $item->id }}]" type="radio" value="3" required>
                                <span>ตัวเลือกที่ 3: {!! $item->aq3 !!}</span>
                            </label>
                        </div>
                        <div class="col-md ml-5">
                            <label>
                                <input class="form-control-input" name="answer[{{ $item->id }}]" type="radio" value="4" required>
                                <span>ตัวเลือกที่ 4: {!! $item->aq4 !!}</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="subject_id" value="{{ $subject_id }}">
                    </div>
                </section>
                @endforeach

                <div class="form-navigation">
                    <button type="button" class="previous btn btn-primary pull-left">&lt; Previous</button>
                    <button type="button" class="next btn btn-primary pull-right">Next &gt;</button>
                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                    <span class="clearfix"></span>
                </div>
                <input type="hidden" name="timer" value="" id="myText">
            </form>

        </div>
    </div>
</section>
@endsection
@section('script')
<!-- {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}} -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" integrity="sha512-kg7MoLszG9YIjdIHV03Z47UjWllE+GJ7PRmBgeBBponYSCvd2IpytGMbTIlA0uQwNRcJDUqDdRzUdAkmHRfRXg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var $sections = $('.form-section');


    function navigateTo(index) {
        // Mark the current section with the class 'current'
        $sections
            .removeClass('current')
            .eq(index)
            .addClass('current');
        // Show only the navigation buttons that make sense for the current section:
        $('.form-navigation .previous').toggle(index > 0);
        var atTheEnd = index >= $sections.length - 1;
        $('.form-navigation .next').toggle(!atTheEnd);
        $('.form-navigation [type=submit]').toggle(atTheEnd);
    }

    function curIndex() {
        // Return the current index by looking at which section has the class 'current'
        return $sections.index($sections.filter('.current'));
    }

    // Previous button is easy, just go back
    $('.form-navigation .previous').click(function() {
        // console.log('click previous');
        navigateTo(curIndex() - 1);
    });

    // Next button goes forward iff current block validates
    $('.form-navigation .next').click(function() {
        // console.log('click next');
        if ($('.demo-form').parsley().validate({
                group: 'block-' + curIndex()
            })) {
            // console.log('section is valid moved to next');
            navigateTo(curIndex() + 1);
        } else {
            // console.log('section is not valid')
        }

    });

    // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
    $sections.each(function(index, section) {
        $(section).find(':input').attr('data-parsley-group', 'block-' + index);
    });
    navigateTo(0); // Start at the beginning
</script>



<script>
    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            // save time
            //document.getElementById("myText").value = minutes+':'+seconds;
            $('#myText').val(minutes + ':' + seconds);

            //document.getElementById('time').value(minutes+':'+seconds);
            if (++timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    window.onload = function() {
        var fiveMinutes = 0,
            display = document.querySelector('.time');

        startTimer(fiveMinutes, display);
    };
</script>
@endsection
