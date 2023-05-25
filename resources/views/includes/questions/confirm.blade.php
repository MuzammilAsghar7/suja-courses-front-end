<section>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="page-block video  block-1 ">
            <h2 class="u-block t-bold u-mt1 u-mb1">{{ $lesson->title}}</h2>
            <div class="embed-responsive embed-responsive-16by9 ">
              <video class="embed-responsive-item video w-100" controlslist="nodownload" data-id="267992569" data-title="The foundation for your new career" 
                data-source="{{$lesson->lessonimage}}" poster="/assets/img/video-poster.jpg" controls="controls">
                <source src="{{$lesson->lessonimage}}" type="video/mp4">
              </video>
            </div>
            <span class="reporting__text -watched u-block u-mt1 u-mb1">Watched</span>
            <span class="reporting__text -watched u-block u-mt1 u-mb1 watched-267992569" style="display:none;">Watched</span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="page-block text   block-2 ">
            {!! $lesson->description !!}
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row u-mt2 u-mb2">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="checkbox-area u-mt1">
            <div class="checkbox">
              @if($question->checkuserAns($question->id))
                <div class="fs-checkbox fs-light fs-checkbox-checked">
              @else
                <div class="fs-checkbox fs-light ">
              @endif
                <div class="fs-checkbox-marker" aria-hidden="true">
                  <div class="fs-checkbox-flag"></div>
                  <input class="custom-checkbox section-read fs-checkbox-element" id="checkbox-{{$question->id}}" type="checkbox" value="" checked="checked">
                </div>
                <label class="fs-checkbox-label" for="checkbox-{{$question->id}}">
                  <span class="fs-checkbox-element_placeholder"></span> {{$question->title}}</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>