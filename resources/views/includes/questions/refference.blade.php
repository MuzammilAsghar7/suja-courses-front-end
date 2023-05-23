<section style="background:unset">
    <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class=""><h4 class="question">{{$question->title}}</h4>
              <form class="foundation-form foundation-0" method="post" action="/foundation-answer">
                @csrf
                <input type="hidden" ng-model="foundation.question_id" ng-value="{{$question->id}}" /> 
                <div class="form-group"> 
                  <label class="control-label">My Answer</label>
                  <textarea name="answer" class="form-control form__input form__textarea answer" ng-model="foundation.answer"  required minlength="0" placeholder="My Answer" data-minlength="180" data-error="In order to move on, please give a more comprehensive explanation" required="" min="0"></textarea>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label class="control-label">Reference</label>
                  <textarea name="reference" class="form-control form__input form__textarea" min="10" required ng-model="foundation.reference" placeholder="Reference" data-error="Please enter a reference" required=""></textarea>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="row u-mt2">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                   @if(!$loop->first)
                    <button type="button" class="foundation-save button -purple u-pt1 u-pb1 disabled" ng-click="stepDecrement({{count($lesson->questions)}})">Previous</button>
                   @endif 
                  </div>
                 
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                      @if($loop->last)
                        <button type="button" ng-click="foundationIncrement({{count($lesson->questions)}},{{$question->id}})" style="margin-left: auto; display: table;" class="foundation-save button -purple u-pt1 u-pb1 disabled" data-question="0">
                          <a href="{{$next_page}}" class="text-white">Finish</a>
                        </button>
                      @else
                        <button type="button" style="margin-left: auto; display: table;" ng-click="foundationIncrement({{count($lesson->questions)}},{{$question->id}})" class="foundation-save button -purple u-pt1 u-pb1 disabled" data-question="0">Save</button>
                      @endif
                  </div>
                  <input type="hidden" name="question_id" value="{{$question->id}}">
                  <input type="hidden" name="chapter_id" value="{{$chapter->id}}">
                  <input type="hidden" name="page_number" value="{{-- $pagenumber --}}">
                  <input type="hidden" name="last" value="{--!! ($lastnumner == 'last') ? true : false !!--}">
                  @isset($nextchapter)
                    <input type="hidden" name="next_chapter" value="{{$nextchapter}}">
                  @endisset
                </div>
              </form>
            </div><!-- /.foundation-area -->
          </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
  </section>
  @php 
    $foundationText = $question->foundation($question->id);
  @endphp
  @if(isset($foundationText))
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 class="u-mb1 u-mt1">Previous Answers</h3>
                </div><!-- /.col-lg-12 -->
            </div><!--/ .row -->
        </div><!-- /.container -->
    @foreach($foundationText as $text)
      @if(isset($text))
  
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="foundation-answer-area u-mt2 u-mb2">
                          <div class="foundation-answer"> 
                            
                            <h4 class="u-block u-mb1">Saved on {{$text->formatDate($text->created_at)}}</h4> 
                            <div class="u-mt2 u-mb2"> 
                              <p class="t-f16 t-bold">Reference</p> 
                              <p>{{$text->reference}}</p>
                            </div>
                            <div class="u-mt2 u-mb2"> 
                              <p class="t-f16 t-bold">My Answer</p> 
                              <p>{{$text->answer}}</p>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
      @endif
    @endforeach
  @endif