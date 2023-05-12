
@extends('layouts.default')
@section('content')
<div class="page">

<section id="main" class="wrap">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h4 class="u-mb2">Question</h4>
      <h4 class="question u-mb2">The online element of your instructor training is self-study with unlimited email support. In this self-study course: </h4>
      <h4 class="u-mb2">Answers</h4>
      <a href="#" data-answer="a" class="question-option append-answer  ">
        <span class="question-option__text">your training company is responsible for your study;</span>
      </a>
      <a href="#" data-answer="b" class="question-option append-answer  selected  correct     locked ">
        <span class="question-option__text">you are responsible for your own study;</span>
      </a>
      <a href="#" data-answer="c" class="question-option append-answer   locked ">
        <span class="question-option__text">the DVSA are responsible for your study;</span>
      </a>
      <a href="#" data-answer="d" class="question-option append-answer   locked ">
        <span class="question-option__text">the training support provider is responsible for your study;</span>
      </a>
    </div>
    
  </div>
  
  <div class="row u-mt2">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      <a class="button -purple u-block" href="/getting-started">Getting Started Home</a>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      <a class="button -purple u-block" href="/getting-started/multiple-choice/review-best">Back To Review</a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      <a class="button -purple u-block" href="/getting-started/multiple-choice/review/1/review-detail">Next Question <i class="fa fa-chevron-right"></i>
      </a>
    </div>
  </div>
</div>
</section>


<!-- Populate Hidden Fields -->
<input type="hidden" class="user_id" value="{{ auth()->user()->id }}">
<style>
@media (min-width: 768px){
.container {
    width: 720px;
}
}
</style>
@endsection

