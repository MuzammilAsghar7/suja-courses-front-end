<?php
	// if(isset($chapter) && isset($chapter['lesson']->id)){
	// 	if($chapter['lesson']->id == $chapter['last_lesson_id']){
	// 		$pagenumber = 'last';
	// 		$nextchapter = $chapter['next_chapter'];
	// 	} else{
	// 		$pagenumber = $page + 1;
	// 		$chapter_id = $chapter->id;
	// 	}
	// }
?>

@if(Route::currentRouteName() == 'parentlessons')
<div class="question-footer">
  <div class="container">
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="text-left"></div>
      </div>
      
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <div class="text-right text-center">
		@if(isset($question))	  
			@if($question->checkuserAns($question->id))
				<div class="next-button show-button">
			@else
				<div class="next-button no-show">
			@endif
		@else
			<div class="next-button no-show">
		@endif
          <!-- <div class="next-button no-show"> -->
            <div class="text-right">
						<a class="started-back" href="{{ $next_page }}">
							<span class="desktop">{{ $next_name }}</span>
							<i class="fa fa-chevron-right"></i>
						</a>
					
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@else
<div id="footer">
        <div class="container">
            <div class="row">
            	<div class="col-md-6 mx-auto">
            		<div class="row justify-content-center">
		                <div class="col-sm-3 col-md-3 col-lg-3">
		                    <div class="text-center">
		                        <a class="footer-icon" href="/">
		                            <span class="footer-icon__icon fa fa-home"></span>
		                            <span class="footer-icon__text t-white u-block text-uppercase">Home</span>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-sm-3 col-md-3 col-lg-3">
		                    <div class="text-center">
		                        <a class="footer-icon" href="/2">
		                            <span class="footer-icon__icon fa fa-leanpub"></span>
		                            <span class="footer-icon__text t-white u-block text-uppercase">Theory</span>
		                        </a>
		                    </div>
		                </div>
		                <!-- <div class="col-sm-3 col-md-3 col-lg-3">
		                    <div class="text-center">
		                        <a class="footer-icon" href="#" target="_blank">
		                            <span class="footer-icon__icon fa fa-car"></span>
		                            <span class="footer-icon__text t-white u-block text-uppercase">Driving</span>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-sm-3 col-md-3 col-lg-3">
		                    <div class="text-center">
		                        <a class="footer-icon" href="#">
		                            <span class="footer-icon__icon fa fa-graduation-cap"></span>
		                            <span class="footer-icon__text t-white u-block text-uppercase">Teaching</span>
		                        </a>
		                    </div>
		                </div> -->
                	</div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
  @endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="{{asset('_assets/js/script.js')}}"></script>
<script>
angular.module('myApp', [])
.controller('myController', function($scope, $http,$timeout) {
    $scope.step = 0;
    $scope.name = 'Dummy User';
	$scope.thoughts = [];
	$scope.answer = {};
	$scope.foundation = {};
	$scope.loading = false;
	$scope.token = document.querySelector('meta[name="csrf-token"]').content;
	$scope.saveQuestion = function(limit) {
		if($scope.step < limit-1){
			++$scope.step;
		}
		else {
			window.location = "http://192.168.1.23:8000/getting-started/1"
		}
    }; 
    $scope.stepIncrement = function(limit) {
		$scope.loading = true;
		if($scope.step < limit-1){
			$timeout(() => {
			  $scope.loading = false;
			  loading = false;
			  ++$scope.step; 
			}, 300);
		}
    }; 
	$scope.stepDecrement = function(limit) {
		if($scope.step > 0){
			--$scope.step;
		}
    }; 
	
	$scope.foundationIncrement = function(limit, question_id) {
		var req = {
			method: 'POST',
			url: '/foundation-answer',
			data: { _token : $scope.token, answer: $scope.foundation.answer, reference: $scope.foundation.reference, question_id: question_id, limit: limit }
		}
		if($scope.foundation.answer && question_id){
			$http(req).then(function successCallback(response){
				if(response.data){
					
				}
			}, 
			function errorCallback(response){
				console.log(error)
			});
		}
		if($scope.step < limit-1){
			++$scope.step;
		}
		$scope.foundation = {};
    };
	$scope.saveThoughts = function(limit,question_id) {
		$scope.loading = true;
		if($scope.step < limit-1){
			var req = {
			method: 'POST',
			url: '/foundation-answer',
			data: { _token : $scope.token, thoughts : $scope.thoughts[$scope.step],question_id }
		}
		if($scope.thoughts[$scope.step]){
			$http(req).then(function successCallback(response){
				console.log(response);
				// if(response.data){
					
				// }
			}, 
			function errorCallback(response){
				console.log(error)
			});
		}

			$timeout(() => {
			  $scope.loading = false;
			  loading = false;
			  ++$scope.step; 
			}, 300);
		}
    };  
});

</script>
