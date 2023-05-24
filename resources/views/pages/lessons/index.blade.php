@extends('layouts.default')
@section('content')
<div class="page getting-started">
  @if(count($questions) > 1)
  <section id="main" class="wrap">
    <div class="container">
      @foreach($lesson->questions as $key => $question)
    
      <div class="tab-{{ $question->id }}" ng-if="step == {{$key}}">
      @if(isset($question->id))
        <input type="hidden" class="question_id" value="{{ $question->id }}">
        @endif
        @if($question->qtype[0]->id == 1)
          @include('includes.questions.confirm')
        @elseif($question->qtype[0]->id == 2)
        
          @include('includes.questions.refference')
        @elseif($question->qtype[0]->id == 3)
          @include('includes.questions.mcqs')
        @elseif($question->qtype[0]->id == 4)
          @include('includes.questions.thoughts')
        @endif
      </div>
      @endforeach
    </div>
  </section>
  @else
    @if(isset($lesson->questions[0]))
      @php 
        $question = $lesson->questions[0];
        $question_id = $question->id;
      @endphp
    @endif
    @if($question->qtype[0]->id == 1)
      @include('includes.questions.confirm')
    @elseif($question->qtype[0]->id == 2)
      @include('includes.questions.refference')
    @elseif($question->qtype[0]->id == 3)
      @include('includes.questions.mcqs')
    @elseif($question->qtype[0]->id == 4)
      @include('includes.questions.thoughts')
    @endif
  @endif
</div>
<input type="hidden" class="user_id" value="{{ auth()->user()->id }}">
<input type="hidden" class="module_id" value="{{ $module->id }}">
<input type="hidden" class="chapter_id" value="{{ $chapter->id }}">
<input type="hidden" class="lesson_id" value="{{ $lesson->id }}">
@if(isset($question->id))
  <input type="hidden" class="question_id" value="{{ $question->id }}">
@endif
<style>
@media (min-width: 768px){
    .container {
        width: 720px !important;
    }
}
</style>
@endsection

