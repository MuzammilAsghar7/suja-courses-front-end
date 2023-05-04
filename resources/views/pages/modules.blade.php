
  
@extends('layouts.default')

@section('content')
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text-center">
                            <div class="progress-chart -center  incomplete ">
                                <span class="progress-chart__text">852/1122</span>
                            </div><!-- /.progress-chart -->
                        </div><!-- /.text-center -->
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text-center">
                            <span class="reporting__text -low u-block u-mt1 u-mb1">You are not ready yet. More work
                                needed.</span>
                        </div><!-- /.text-center -->
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section>
        <div class="page">

         @if($data->courses)
            @foreach($data->courses as $course)
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-7 mx-auto">
                            <a class="page-list__link" href="#">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-2">
                                        <i class="page-list__icon {{$course->icon}}"></i>
                                    </div>
                                    <div class="col-lg-10 col-xs-10">
                                        <div class="pull-right">
                                            <div class="progress-chart  complete ">
                                                <span class="progress-chart__text">852/852</span>
                                            </div>
                                        </div>
                                        <span class="page-list__title">{{$course->title}}</span>
                                        <p class="page-list__text">{{$course->subtitle}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            @endforeach
        @else
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-7 mx-auto">
                            <a class="page-list__link" href="#">
                                <div class="row">
                                    <div class="col-lg-10 col-xs-10">
                                        <h2>No Courses available yet.</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif