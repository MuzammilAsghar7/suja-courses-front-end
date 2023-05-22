@extends('layouts.default')

@section('content')

<div class="page" style="padding-bottom: 50px;">
@isset($course->chapters)

<section class="u-pt0 py-5">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="text-center">
          <div class="progress-chart -center incomplete">
            <span class="progress-chart__text">{{count(auth()->user()->questions_ids())}}/80 {{count($course->questions_id())}}</span>
          </div>
          <!-- /.progress-chart -->
        </div>
        <!-- /.text-center -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="text-center">
          <span class="reporting__text -low u-block u-mt1 u-mb1">You are not ready yet. More work needed.</span>
        </div>
        <!-- /.text-center -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
@foreach($course->chapters_with_lesson as $chapter)
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 mx-auto">
                <a class="page-list__link" href="/getting-started/{{$chapter->id}}/1">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <i class="page-list__icon fa {{$chapter->icon}}"></i>
                        </div>
                       
                        @php
                            $commonElements = array_intersect($chapter->questions_id(), auth()->user()->questions_ids());
                            $count = count($commonElements);
                        @endphp
                        
                        <div class="col-lg-10">
                            <div class="pro_text_box d-flex justify-content-between align-items-center">
                                <div class="pro_text_inner">
                                    <span class="page-list__title">{{$chapter->title}}</span>
                                    <p class="page-list__text">Welcome to iCourse</p>
                                </div>
                                <div class="progress-chart {{ ($count == count($chapter->questions_id())) ? 'complete' : 'incomplete' }} ">
                                    <span class="progress-chart__text">{{$count}}/{{count($chapter->questions_id())}}</span>
                                </div>                 
                            </div>                       
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>        
@endforeach
@endisset
</div>


@endsection