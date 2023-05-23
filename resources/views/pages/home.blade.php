@extends('layouts.default')

@section('content')

<section id="main" class="wrap pt-4">
        <section>
            <div class="container">
                <div class="row align-items-center">
                @if (session('success'))
                  <div class="col-md-7 mx-auto">
                    <div class="alert alert-success">
                        {!! session('success') !!}
                    </div>
                  </div>
                @endif
                    <div class="col-md-7 mx-auto">
                        <div class="progress-chart -center incomplete">
                            <span class="progress-chart__text">0/0</span>
                        </div>
                    </div>
                  </div>
                <div class="row align-items-center">
                    <div class="col-md-7 mx-auto">
                        <div class="text-center">
                            <span class="reporting__text -low u-block u-mt1 u-mb1">You are not ready yet. More work
                                needed.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="page">
        	
          @foreach($modules as $module)
        	 <section>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-7 mx-auto">
                            <a class="page-list__link" href="{{$module->name}}/{{$module->id}}">
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <i class="page-list__icon {{$module->icon}}"></i>
                                    </div>
                                    
                                    <div class="col-lg-10">
                                    	<div class="pro_text_box d-flex justify-content-between align-items-center">
                                    		<div class="pro_text_inner">
		                                    	<span class="page-list__title">{{$module->title}}</span>
		                                    	<p class="page-list__text">{{$module->subtitle}}</p>
	                                    	</div>
	                                        <div class="progress-chart {{ count(auth()->user()->questions_ids()) == count($module->questions_id()) ? 'complete' : 'incomplete' }}">
	                                            <span class="progress-chart__text">{{count(auth()->user()->questions_ids())}}/{{count($module->questions_id())}}</span>
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

        	 <section class="d-none">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-7 mx-auto">
                            <a class="page-list__link" href="#">
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <i class="page-list__icon fa fa-leanpub"></i>
                                    </div>
                                    
                                    <div class="col-lg-10">
                                    	<div class="pro_text_box d-flex justify-content-between align-items-center">
                                    		<div class="pro_text_inner">
		                                    	<span class="page-list__title">Theory</span>
		                                    	<p class="page-list__text">Welcome to iCourse</p>
	                                    	</div>
	                                        <div class="progress-chart incomplete">
	                                            <span class="progress-chart__text">852/1122</span>
	                                        </div>                 
                                        </div>                       
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>        
        </div>
    </section>

<!-- <div class="container d-none">
<div class="">
<span ng-bind="name"></span>
<span ng-bind="count"></span>
<button ng-click="countIncrement({{Auth::user()}})">increment One</button>
</div>


<input type="text" ng-model="searchuser">
<table class="table" ng-init="users=$users ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>
 

    <tr ng-repeat="user in users | filter: searchuser">
      <th scope="row">1</th>
      <td ng-bind="user.name"></td>
      <td ng-bind="user.email"></td>
      <td ng-bind="user.created_at"></td>
    </tr>


  </tbody>
</table>
</div> -->

@stop