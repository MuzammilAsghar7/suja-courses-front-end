@extends('layouts.default')

@section('content')
<section id="main" class="wrap">
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
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <a class="page-list__link" href="#">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-2">
                                        <i class="page-list__icon fa fa-book"></i>
                                    </div><!-- /.col-lg-1 -->
                                    <div class="col-lg-10 col-xs-10">
                                        <div class="pull-right">
                                            <div class="progress-chart  complete ">
                                                <span class="progress-chart__text">852/852</span>
                                            </div><!-- /.progress-chart -->
                                        </div><!-- /.pull-right -->
                                        <span class="page-list__title">Study</span>
                                        <p class="page-list__text">Study, practise and complete theory mock tests</p>
                                    </div><!-- /.col-lg-9 -->
                                </div><!-- /.row -->
                            </a><!-- /.main-link-nav -->
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section>
        </div><!-- /.page -->
    </section>

    @stop