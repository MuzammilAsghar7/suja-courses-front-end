@extends('layouts.default')

@section('content')
<div class="page" style="padding-bottom: 50px;">
@isset($lessons)
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="text-center">
          <div class="progress-chart -center incomplete">
            <span class="progress-chart__text">1/2 </span>
          </div>
        </div>
      </div>
    </div>
  @if(isset($chapter->chapter_image))
  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-7 mx-auto">
          <video class="embed-responsive-item video w-100" controlslist="nodownload" data-id="267992569" data-title="The foundation for your new career" 
          data-source="{{$chapter->chapter_image}}" poster="/assets/img/video-poster.jpg" controls="controls">
            <source src="{{$chapter->chapter_image}}" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
  </section>
  @endif
@foreach($lessons as $lesson)
  <section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 mx-auto">
                <a class="page-list__link" href="/{{$module->id}}/{{$chapter->id}}/{{$lesson->id}}">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                          <i class="page-list__icon fa {{$chapter->icon}}"></i>
                        </div>
                      
                        @php
                            $children_question_ids = $lesson->children_question_ids();
                            $commonElements = array_intersect($children_question_ids, auth()->user()->questions_ids());
                            $count = count($commonElements);
                        @endphp
                        
                        <div class="col-lg-10">
                            <div class="pro_text_box d-flex justify-content-between align-items-center">
                                <div class="pro_text_inner">
                                    <span class="page-list__title">{{$lesson->title}}</span>
                                    <p class="page-list__text">Welcome to iCourse</p>
                                </div>
                                <div class="progress-chart {{ ($count == count($chapter->questions_id())) ? 'complete' : 'incomplete' }} ">
                                    <span class="progress-chart__text">{{$count}}/{{count($children_question_ids)}}</span>
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


@isset($chapters)
asd
<section class="u-pt0 py-5">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="text-center">
          <div class="progress-chart -center incomplete {{ count(auth()->user()->questions_ids()) == count($module->questions_id()) ? 'complete' : 'incomplete' }}">
            <span class="progress-chart__text">{{count(auth()->user()->questions_ids())}}/{{count($module->questions_id())}}</span>
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

@foreach($chapters as $chapter)
@php
if($lesson = $chapter->lessons->first())
{
  $lessonid = $lesson->id;
}
else
{
  $lessonid = 0;
}
if($chapter->parent)
{
  $url = "/$module->id/$chapter->id/";
}else
{
  $url = "/$module->id/$chapter->id/$lessonid";
}
@endphp
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 mx-auto">
                <a class="page-list__link" href="{{$url}}">
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