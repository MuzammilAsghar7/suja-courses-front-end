<!doctype html>
<html>
<head>
   @include('includes.head')    
</head>
<body ng-app="myApp" ng-controller="myController">
<div class="">
       @include('includes.header')
   <div id="main" class="">
           @yield('content')
   </div>
   <footer class="">
       @include('includes.footer')
   </footer>
</div>
</body>
</html>