@extends('layouts.default')

@section('content')



<div class="page">

@isset($chapter)


 <section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="page-block video  block-1 ">
          <h2 class="u-block t-bold u-mt1 u-mb1">{{ $chapter['lesson']->title}}</h2>
          <div class="embed-responsive embed-responsive-16by9 ">
            <video class="embed-responsive-item video" controlslist="nodownload" data-id="267992569" data-title="The foundation for your new career" data-source="

https://player.vimeo.com/external/267992569.sd.mp4?s=49d1618383afccfce3cf5908c9b4ea686b5ffd7c&amp;profile_id=164

" poster="https://my-adi-course.co.uk/assets/img/video-poster.jpg" controls="controls">
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
  <div class="container">
    <div class="row u-mt2 u-mb2">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="checkbox-area u-mt1">
          <div class="checkbox">
            <div class="fs-checkbox fs-light  fs-checkbox-checked">
              <div class="fs-checkbox-marker" aria-hidden="true">
                <div class="fs-checkbox-flag"></div>
                <input class="custom-checkbox section-read fs-checkbox-element" type="checkbox" value="" checked="checked">
              </div>
              <label class="fs-checkbox-label">
                <span class="fs-checkbox-element_placeholder"></span> I confirm that I have completed the required learning tasks covered on this page </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endisset

</div>

<div class="question-footer">
  <div class="container">
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="text-left">
          <a class="started-back" href="0">
            <i class="fa fa-chevron-left"></i>
            <span class="desktop">Back</span>
          </a>
          <!-- /.started-back -->
        </div>
      </div>
      <!-- /.col-lg-4 -->
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="text-center">
          <a class="question-nav -show quick-nav" href="#">
            <span class="desktop">Quick navigation</span>
            <span class="fa fa-chevron-up"></span>
          </a>
        </div>
        <!-- /.text-left -->
      </div>
      <!-- /.col-lg-4 -->
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="text-right">
          <div class="next-button">
            <div class="text-right">
              <a class="started-back" href="https://my-adi-course.co.uk/getting-started/3/0">
                <span class="desktop">Next Unit</span>
                <i class="fa fa-chevron-right"></i>
              </a>
              <!-- /.started-back -->
            </div>
            <!-- /.pull-right -->
          </div>
          <!-- /.next-button -->
        </div>
        <!-- /.text-right -->
      </div>
      <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</div>


@endsection