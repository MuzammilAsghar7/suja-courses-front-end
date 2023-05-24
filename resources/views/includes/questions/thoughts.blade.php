<div class="reflections-area">
   <div class="page">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <h2 class="u-block t-bold u-mb1">{{ $lesson->title }}</h2>
                  {!! $lesson->description !!}
                  <form class="reflections-form" data-toggle="validator" novalidate="true">
                     <div class="form-group has-error">
                        <label class="control-label">{{ $question->title }}</label>
                        <span ng-bind="thoughts"></span>
                        <textarea name="reflection_text" ng-model="thoughts[{{$key}}]" class="form-control form__input form__textarea reflection_text -open" placeholder="Your Thoughts" data-error="Please enter your thoughts" required=""></textarea>
                        <span class="glyphicon form-control-feedback glyphicon-remove" aria-hidden="true"></span>
                        
                        <div class="u-mt1">
                           <button type="submit" ng-click="saveThoughts({{count($questions)}},{{$question->id}})" class="button -purple reflection-save disabled">Save</button>
                        </div>
                        <input name="reflection_section" type="hidden" class="unit_name" value="Getting Started">
                        <input name="unit_id" type="hidden" class="unit_id" value="999">
                     </div>
                  </form>
               </div>
            </div>
         </div>
   
@php 
    $foundationText = $question->foundation($question->id);
@endphp         
@if(isset($foundationText))
         <div class="container">
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <h3 class="u-mt2 u-mb2">Previous Submissions</h3>
               </div>
            </div>
            
         </div>
         
@foreach($foundationText as $text)
      @if(isset($text))

         <div class="container">
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="foundation-answer u-mt2">
                     <div class="u-mt2 u-mb2">
                        <h4 class="u-mb1">Saved On - {{$text->formatDate($text->created_at)}}</h4>
                        <p>{{$text->thoughts}}</p>
                     </div>
                     
                  </div>
                  
               </div>
               
            </div>
         </div>
   </div>
   
</div>
     @endif
    @endforeach
@endif