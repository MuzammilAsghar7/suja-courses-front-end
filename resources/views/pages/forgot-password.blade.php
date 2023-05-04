<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="SS9az57kBwFE5U4hyFRVFkAB4DTtl0VXVHxsqAH3">

    <title>Forgot Password</title>

    <meta name="msapplication-TileColor" content="#ffffff">
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
                <div class="col-md-8 col-md-offset-2">
                    <form class="login__form" role="form" method="POST" action="#" data-toggle="validator"
                        novalidate="true">
                        <div class="text-center">
                            <h1 class="page__title u-mt1 u-mb1">Forgotten Password</h1>
                        </div><!-- /.text-center -->
                        <input type="hidden" name="_token" value="SS9az57kBwFE5U4hyFRVFkAB4DTtl0VXVHxsqAH3">
                        <div class="form-group has-error">
                            <label for="email" class="control-label form__label" your="">E-Mail Address</label>
                            <input id="email" type="email" class="form-control form__input -login" name="email" value=""
                                placeholder="Enter Your Email Address" data-error="Please enter your Email Address"
                                required="" autofocus="">
                            <span class="" aria-hidden="true"></span>
                            <div class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li>Please enter your Email Address</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row u-mt2">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="text-center">
                                    <button type="submit" class="button -purple disabled">Reset Password</button>
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
    <script src="../_assets/js/validator.js"></script>

</body>

</html>