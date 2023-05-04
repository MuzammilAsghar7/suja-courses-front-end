<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log In</title>

    <meta name="theme-color" content="#ffffff">
    <!-- Styles -->
    <link href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../_assets/style/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../_assets/style/style.css" rel="stylesheet">
    
</head>

<body cz-shortcut-listen="true">
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  @if (session('success'))
                        <div class="alert alert-success" role="alert">
                          {!! session('success') !!}
                        </div>
                  @endif
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form class="login__form" role="form" method="POST" action="/login"
                        novalidate="true">
                        @csrf
                        <div class="text-center">
                            <h1 class="page__title u-mt1 u-mb1">Welcome, Please Login</h1>
                        </div><!-- /.text-center -->
                        <input type="hidden" name="" value="">
                        <div class="form-group @error('email') has-error @enderror mb-3">
                            <label for="email" class="control-label form__label">E-Mail Address</label>
                            <input id="email" type="email" class="form-control form__input -login" name="email" value=""
                                placeholder="Enter Your Email Address" data-error="Please enter your Email Address"
                                required="" autofocus="">
                                <i class="fa-solid fa-xmark"></i>
                            <div class="help-block with-errors">
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                            
                        </div>
                        <div class="form-group @error('password') has-error @enderror">
                            <label for="password" class="control-label form__label">Password</label>
                            <input id="password" type="password" class="form-control form__input -login" name="password"
                                placeholder="Enter your password" data-error="Please enter your password" required="">
                                <i class="bi bi-x"></i>
                                
                                <div class="help-block with-errors">   
                                  @error('password')                           
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                                
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="text-center">
                                    <a class="t-dark text-uppercase" href="#">Forgotten Password</a>
                                </div>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="text-center">
                                    <a class="t-dark text-uppercase" href="#">Change Password</a>
                                </div>
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                        <div class="row u-mt2">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="text-center">
                                    <button type="submit" class="button -purple disabled">Login</button>
                                </div><!-- /.text-center -->
                            </div><!-- /.col-lg-l12 -->
                        </div><!-- /.row -->
                    </form>
                </div><!-- /.col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>
    <!-- Scripts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- <script src="../_assets/js/validator.js"></script> -->


</body>

</html>





<!-- <div class="container">
<div class="col-lg-6 mx-auto">
<h1>Login Page</h1>
<form action="/login" method="post">
    @csrf
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="email"  value="{{old('email')}}" required>
    
    
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" value="{{old('password')}}" required>
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
</div>
</div>-->
<style>
  /*
form {
  border: 3px solid #f1f1f1;
} 

 Full-width inputs 
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons 
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons 
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) 
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container 
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image 
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers 
.container {
  padding: 16px;
}

/* The "Forgot password" text 
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}
 */
</style>