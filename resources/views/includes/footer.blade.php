<div id="footer">
        <div class="container">
            <div class="row">
            	<div class="col-md-6 mx-auto">
            		<div class="row">
		                <div class="col-sm-3 col-md-3 col-lg-3">
		                    <div class="text-center">
		                        <a class="footer-icon" href="index.html">
		                            <span class="footer-icon__icon fa fa-home"></span>
		                            <span class="footer-icon__text t-white u-block text-uppercase">Home</span>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-sm-3 col-md-3 col-lg-3">
		                    <div class="text-center">
		                        <a class="footer-icon" href="Theory.html">
		                            <span class="footer-icon__icon fa fa-leanpub"></span>
		                            <span class="footer-icon__text t-white u-block text-uppercase">Theory</span>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-sm-3 col-md-3 col-lg-3">
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
		                </div>
                	</div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular.js">   </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="_assets/js/script.js"></script>
<script>
angular.module('myApp', [])
.controller('myController', function($scope) {
    $scope.count = 0;
    $scope.name = 'Dummy User';
    $scope.countIncrement = function(data) {
        $scope.name = data.name;
        ++$scope.count;
    };  
});
</script>