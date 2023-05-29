<section style="background:unset">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h4 class="u-mb2">Question</h4>
          <h4 class="question u-mb2">{{ $question->title }}:</h4>
           @if(isset($question->questionimage))
             <img src="{{$question->questionimage}}" style="width: 180px;margin-bottom: 22px;">
           @endif
          <h4 class="u-mb2">Answers</h4>
          <?php 
            if($question->checkuserAns($question->id)){
              $ans = true;
            } else{
              $ans = false;
            }
          ?>
          @if(isset($question->qoptions))
            @foreach($question->qoptions as $key => $option)
              <a href="#" for="answer_{{$key}}" data-answer="{{$option->id}}" 
              data-module_id = "{{$chapter->module_id}}"
              data-chapter_id = "{{$chapter->id}}"
              data-lesson_id = "{{$lesson->id}}"
              data-status="{{$option->status}}" 
              data-question_id = "{{$question->id}}"
              class="question-option append-answer {!! ($ans && $option->status == 1) ? 'selected correct' : '' !!}">
                <span class="question-option__text">{{$option->title}}</span>
              </a>
              <input type="radio" id="answer_{{$key}}" name="answer_{{$key}}" class="d-none" value="{{$option->id}}">
              <!-- class="question-option append-answer  selected  correct     locked "> -->
            @endforeach
          @endif
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <div class="row u-mt2">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          @if(isset($loop))
            @if(!$loop->first)
              <a class="button -purple u-block" href="javascript:;" ng-click="stepDecrement({{count($lesson->questions)}})">
              <i class="fa fa-chevron-left"></i> Previous Question</a>
            @endif
          @endif
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <a class="button -purple u-block" href="https://my-adi-course.co.uk/getting-started/multiple-choice/review-best">Back To Review</a>
        </div>
            @if(isset($loop))
              @if($loop->last)
              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <a class="button -purple u-block" href="{{$next_page}}">Next Topic <i class="fa fa-chevron-right"></i></a>
              </div>
              @else
              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <a class="button -purple u-block" href="javascript:;" ng-click="stepIncrement({{count($lesson->questions)}})"><span ng-if="loading == true"> Loading... </span><span ng-if="loading == false">Next Question <i class="fa fa-chevron-right"></i></span></a>
              </div>
              @endif
            @endif
            <!-- @ endif -->
          <!-- @ else -->
          <!-- @ endif -->
      </div>
    </div>
    <input type="hidden" class="question_id" value="12">
    <input type="hidden" class="unit_id" value="0">
    <input type="hidden" class="answer_id" value="42927">
    <input type="hidden" class="score_id" value="39448">
    <input type="hidden" class="gs_append" value="true">
  </section>