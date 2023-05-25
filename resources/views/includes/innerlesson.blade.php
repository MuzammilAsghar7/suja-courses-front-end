@isset($innerlesson)
    @php
        $count_question = count($children_question_ids);

        $question_attempt = array_intersect($children_question_ids, auth()->user()->questions_ids());
        $question_attempt_count = count($question_attempt);
    @endphp
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="text-center">
          <div class="progress-chart -center  {{ ($question_attempt_count == $count_question) ? 'complete' : 'incomplete' }}">
            <span class="progress-chart__text">{{ $question_attempt_count }}/{{ $count_question }}</span>
          </div>
        </div>
      </div>
    </div>
    @if(isset($innerlesson[0]->lessonname))
        {!! $innerlesson[0]->lessonname->description !!}
    @endif
    @foreach($innerlesson as $lesson)
        <section>
            <div class="container">
                <div class="row align-items-center">
                    <div class="mx-auto">
                        <a class="page-list__link" href="/{{$module->id}}/{{$chapter->id}}/{{$lesson->id}}">
                            <div class="row align-items-center">
                                <div class="col-lg-2">
                                    <i class="page-list__icon fa {{$lesson->icon}}"></i>
                                </div>
                            
                                @php
                                    $commonElements = array_intersect($chapter->questions_id(), auth()->user()->questions_ids());
                                    $count = count($commonElements);
                                @endphp
                                
                                <div class="col-lg-10">
                                    <div class="pro_text_box d-flex justify-content-between align-items-center">
                                        <div class="pro_text_inner">
                                            <span class="page-list__title">{{$lesson->title}} </span>
                                            <p class="page-list__text">Welcome to iCourse</p>
                                        </div>
                                        <div class="progress-chart {{ ($lesson->questionsattempcount() == $lesson->questionscount()) ? 'complete' : 'incomplete' }}">
                                            <span class="progress-chart__text">{{$lesson->questionsattempcount()}}/{{$lesson->questionscount()}}</span>
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