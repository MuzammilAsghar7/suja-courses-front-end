@extends('layouts.default')
@section('content')

<?php
	if(isset($chapter) && isset($chapter['lesson']->id)){
		if($chapter['lesson']->id == $chapter['last_lesson_id']){
			$pagenumber = $page + 1;
      $lastnumner = 'last';
			$nextchapter = $chapter['next_chapter'];
      $chapter_id = $chapter->id;
		} else{
			$pagenumber = $page + 1;
			$chapter_id = $chapter->id;
      $lastnumner = 'notlast';
		}
	}
?>

<div class="page getting-started">

@if($chapter['lesson']->questions[0]->qtype[0]->id == '3')
  

  <section id="main" class="wrap">
  <div class="container">
  <!-- /.container -->
  <div class="container">
    @foreach($chapter['lesson']->questions as $key => $ques)
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h4 class="u-mb2">Question</h4>
        <h4 class="question u-mb2">{{ $ques->title }}:</h4>
        <h4 class="u-mb2">Answers</h4>
        @if(isset($ques->qoptions))
          @foreach($ques->qoptions as $key2 => $option)
          <a href="#" for="answer_{{$key}}{{$key2}}" class="question-option append-answer">
              <span class="question-option__text">{{$option->title}}</span>
          </a>
            <input type="radio" id="answer_{{$key}}{{$key2}}" name="answer_{{$key}}" class="d-none" value="{{$option->id}}">
             <!-- class="question-option append-answer  selected  correct     locked "> -->
          @endforeach
        @endif
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @endforeach
    <div class="row u-mt2">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        @if(($pagenumber-1) > 1)
          <a class="button -purple u-block" href="/{{session('module_name')}}/{{$chapter_id}}/{{$pagenumber-2}}">
          <i class="fa fa-chevron-left"></i> Previous Question</a>
        @else
          <a class="button -purple u-block" href="/{{session('module_name')}}/1">
          <i class="fa fa-chevron-left"></i> Getting Started</a>
        @endif
      </div>
      <!-- /.col-lg-4 -->
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <a class="button -purple u-block" href="https://my-adi-course.co.uk/getting-started/multiple-choice/review-best">Back To Review</a>
      </div>
      <!-- /.col-lg-4 -->
        @if($lastnumner == 'last')
					@if($nextchapter == 'finish')
						<a class="started-back" href="/getting-started/1/">
							<span class="desktop">Geeting Started</span><i class="fa fa-chevron-right"></i>
						</a>
					@else
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <a class="button -purple u-block" href="/{{session('module_name')}}/{{$nextchapter}}/1">Next Topic <i class="fa fa-chevron-right"></i></a>
            </div>
					@endif
				@else
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <a class="button -purple u-block" href="/{{session('module_name')}}/{{$chapter_id}}/{{$pagenumber}}">Next Question <i class="fa fa-chevron-right"></i></a>
          </div>
				@endif
          <!-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <a class="button -purple u-block" >Next Question <i class="fa fa-chevron-right"></i></a>
          </div> -->
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <input type="hidden" class="question_id" value="12">
  <input type="hidden" class="unit_id" value="0">
  <input type="hidden" class="answer_id" value="42927">
  <input type="hidden" class="score_id" value="39448">
  <input type="hidden" class="gs_append" value="true">
</section>



@elseif($chapter['lesson']->questions[0]->qtype[0]->id == '2')
  <h1 ng-bind="answer.answer"></h1>
  <h1 ng-bind="answer.reference"></h1>
  <section>
        <div class="container">
          @foreach($chapter['lesson']->questions as $key => $ques)
            <div class="row" ng-if="step == {{$key}}" >
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class=""><h4 class="question">{{$ques->title}}</h4>
                  <form class="foundation-form foundation-0" data-toggle="validator" novalidate="true">
                    <div class="form-group"> 
                      <label class="control-label">My Answer</label>
                      <textarea name="answer" class="form-control form__input form__textarea answer" ng-model="answer.answer" minlength="0" placeholder="My Answer" data-minlength="180" data-error="In order to move on, please give a more comprehensive explanation" required="" min="0"></textarea>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Reference</label>
                      <textarea name="reference" class="form-control form__input form__textarea" min="10" ng-model="answer.reference" placeholder="Reference" data-error="Please enter a reference" required=""></textarea>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="row u-mt2">
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <button type="submit" class="foundation-save button -purple u-pt1 u-pb1 disabled" data-question="0" ng-click="saveQuestion({{count($chapter['lesson']->questions)}})">Save</button>
                      </div>
                      @if(count($chapter['lesson']->questions) == ($key+1))
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                          <button type="submit" class="foundation-save button -purple u-pt1 u-pb1 disabled" data-question="0" >Getting Started</button>
                        </div>
                      @endif
                    </div>
                  </form>
                </div><!-- /.foundation-area -->
              </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
          @endforeach
        </div><!-- /.container -->
    </section>
  
@else
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

<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="page-block text   block-2 ">
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


@if(isset($chapter['lesson']->questions[0]))
@php 
  $question = $chapter['lesson']->questions[0];
  $question_id = $question->id;
@endphp

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
@endif
</section>
<!-- Populate Hidden Fields -->
<input type="hidden" class="user_id" value="{{ auth()->user()->id }}">
<input type="hidden" class="module_id" value="{{ $module_id }}">
<input type="hidden" class="chapter_id" value="{{ $chapter_id }}">
<input type="hidden" class="lesson_id" value="{{ $lesson_id }}">
@if(isset($question_id))
 <input type="hidden" class="question_id" value="{{ $question_id }}">
@endif
@endisset
@endif
</div>
<style>
@media (min-width: 768px){
    .container {
        width: 720px !important;
    }
}
</style>
@endsection

