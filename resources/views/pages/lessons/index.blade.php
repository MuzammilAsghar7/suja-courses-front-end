@extends('layouts.default')



@section('content')

<div class="page getting-started">
@isset($chapter)
@php 
   $module_id = $chapter->module_id; 
   $chapter_id = $chapter->id; 
   $lesson_id = $chapter['lesson']->id; 
@endphp

 <section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="page-block video  block-1 ">
          <h2 class="u-block t-bold u-mt1 u-mb1">{{ $chapter['lesson']->title}}</h2>
          <div class="embed-responsive embed-responsive-16by9 ">
            <video class="embed-responsive-item video w-100" controlslist="nodownload" data-id="267992569" data-title="The foundation for your new career" data-source="
https://player.vimeo.com/external/267992569.sd.mp4?s=49d1618383afccfce3cf5908c9b4ea686b5ffd7c&amp;profile_id=164

" poster="/assets/img/video-poster.jpg" controls="controls">
              <source src="

https://player.vimeo.com/external/267992569.sd.mp4?s=49d1618383afccfce3cf5908c9b4ea686b5ffd7c&amp;profile_id=164

" type="video/mp4">
            </video>
          </div>
          <!-- /.embed-responsive -->
          <span class="reporting__text -watched u-block u-mt1 u-mb1">Watched</span>
          <span class="reporting__text -watched u-block u-mt1 u-mb1 watched-267992569" style="display:none;">Watched</span>
        </div>
        <!-- /.page-block -->
      </div>
    </div>
  </div>
</section>

<!-- @if($chapter['lesson']->id == $chapter['last_lesson_id'])
  @section('page_number', 'last')
@else
  @section('page_number', ( $page + 1))
@endif -->

<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="page-block text block-2 ">
         {!! $chapter['lesson']->description !!}
<!-- 
          <h2 class="u-block t-bold u-mb1">Next...</h2>
          <p>You are now ready to get started.</p>
          <p>When you are satisfied that you have fully understood the information in the video, move on to 'Getting Started Unit 1' for an overview of the course and qualification process. </p> -->
        </div>
      </div>
    </div>
  </div>
</section>

<section>
@foreach($chapter['lesson']->questions as $question)
<div class="container">
  <div class="row u-mt2 u-mb2">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="checkbox-area u-mt1">
        <div class="checkbox">
          <div class="fs-checkbox fs-light">
            <div class="fs-checkbox-marker" aria-hidden="true">
              <div class="fs-checkbox-flag"></div>
              <input class="custom-checkbox section-read fs-checkbox-element" id="checkbox-{{$question->id}}" type="checkbox" value="" checked="checked">
            </div>
            <label class="fs-checkbox-label" for="checkbox-{{$question->id}}">
              <span class="fs-checkbox-element_placeholder"></span> {{$question->title}} </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
  
</section>
<!-- Populate Hidden Fields -->
<input type="hidden" class="user_id" value="{{ auth()->user()->id }}">
<input type="hidden" class="module_id" value="{{ $module_id }}">
<input type="hidden" class="chapter_id" value="{{ $chapter_id }}">
<input type="hidden" class="lesson_id" value="{{ $lesson_id }}">
<input type="hidden" class="question_id" value="{{ $lesson_id }}">
@endisset
</div>
@endsection

