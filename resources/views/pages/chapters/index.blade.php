@extends('layouts.default')

@section('content')

<div class="page">

@isset($course->chapters)
@foreach($course->chapters as $chapter)
<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 mx-auto">
                <a class="page-list__link" href="/getting-started/{{$chapter->id}}/1">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <i class="page-list__icon fa {{$chapter->icon}}"></i>
                        </div>
                        
                        <div class="col-lg-10">
                            <div class="pro_text_box d-flex justify-content-between align-items-center">
                                <div class="pro_text_inner">
                                    <span class="page-list__title">{{$chapter->title}}</span>
                                    <p class="page-list__text">Welcome to iCourse</p>
                                </div>
                                <div class="progress-chart incomplete">
                                    <span class="progress-chart__text">0/{{$chapter->lessons_count}}</span>
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
</div>


@endsection