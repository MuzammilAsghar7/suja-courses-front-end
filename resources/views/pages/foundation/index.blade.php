@extends('layouts.default')
@section('content')
<div class="page">
  <section>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="foundation-area">
            <h4 class="question">Taking responsibility for learning is sometimes referred to as 'taking ownership of learning' or 'empowering the learner'. Use Google to search for 'ownership of learning' and then briefly explain in your own words any benefits that you think this approach has.</h4>
            <form class="foundation-form foundation-0" data-toggle="validator" novalidate="true">
              <div class="form-group">
                <label class="control-label">My Answer</label>
                <textarea name="answer" class="form-control form__input form__textarea answer" minlength="0" placeholder="My Answer" data-minlength="180" data-error="In order to move on, please give a more comprehensive explanation" required="" min="0"></textarea>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="control-label">Reference</label>
                <textarea name="reference" class="form-control form__input form__textarea" min="10" placeholder="Reference" data-error="Please enter a reference" required=""></textarea>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
              <div class="row u-mt2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <button type="submit" class="foundation-save button -purple u-pt1 u-pb1 disabled" data-question="0">Save</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.foundation-area -->
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h3 class="u-mb1 u-mt1">Previous Answers</h3>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!--/ .row -->
    </div>
    <!-- /.container -->
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="foundation-answer-area u-mt2 u-mb2">
            <div class="foundation-answer">
              <h4 class="u-block u-mb1">Saved on 8th October 2021 (12:27) </h4>
              <div class="u-mt2 u-mb2">
                <p class="t-f16 t-bold">Reference</p>
                <p>https://kathleenmcclaskey.com/2018/11/18/ownership-to-learning-what-does-it-really-mean/</p>
              </div>
              <div class="u-mt2 u-mb2">
                <p class="t-f16 t-bold">My Answer</p>
                <p>my understanding of ownership for learning is personalised to the learner itself finding what best works for them and how they learn making a plan, goal settings , what keep them motivated and engage to achieving great results not everyone's understanding of learning is the same taking ownership of how best you learn will have greater results</p>
              </div>
            </div>
            <div class="foundation-answer">
              <h4 class="u-block u-mb1">Saved on 12th May 2023 (10:57) </h4>
              <div class="u-mt2 u-mb2">
                <p class="t-f16 t-bold">Reference</p>
                <p>my understanding of ownership for learning is personalised to the learner itself finding what best works for them and how they learn making a plan, goal settings , what keep them motivated and engage to achieving great results not everyone's understanding of learning is the same taking ownership of how best you learn will have greater results</p>
              </div>
              <div class="u-mt2 u-mb2">
                <p class="t-f16 t-bold">My Answer</p>
                <p>https://kathleenmcclaskey.com/2018/11/18/ownership-to-learning-what-does-it-really-mean/</p>
              </div>
            </div>
          </div>
          <!-- /.foundation-answer-area -->
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
</div>
@endsection
