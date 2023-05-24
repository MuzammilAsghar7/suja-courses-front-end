@isset($innerlesson)
asdadasdasd asd asda s
@foreach($innerlesson as $lesson)
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
                            $commonElements = array_intersect($chapter->questions_id(), auth()->user()->questions_ids());
                            $count = count($commonElements);
                        @endphp
                        
                        <div class="col-lg-10">
                            <div class="pro_text_box d-flex justify-content-between align-items-center">
                                <div class="pro_text_inner">
                                    <span class="page-list__title">{{$lesson->title}}</span>
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