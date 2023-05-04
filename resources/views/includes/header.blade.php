<header class="site-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2"></div>
                <!-- /.col-lg-3 -->
            <div class="col-xs-6 col-sm-8 col-md-8 col-lg-8">
                <div class="text-center">
                    <span class="page__title"> Home </span>
                </div>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-xs-3 col-sm-10 col-md-3 col-lg-2">
                <span class="toggle-button">
                    <div class="menu-bar menu-bar-top"></div>
                    <div class="menu-bar menu-bar-middle"></div>
                    <div class="menu-bar menu-bar-bottom"></div>
                </span><!-- /.toggle-button -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</header>

<div class="overlay">
        <a href="#" class="close-overlay">×</a>
        <div class="overlay-content">
            <a href="#">Unit Home</a>
        </div>
        <!-- /.overlay-content -->
    </div>
    <!-- /.overlay -->

    <div class="menu-wrap">
        <div class="menu-sidebar">
            <ul class="menu">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="getting_started.html">Getting Started</a>
                </li>
                <li>
                    <a href="#">Theory</a>
                    <span class="nav-toggle-area">
                        <a href="#" class="nav-chevron" data-toggle="theory">
                            <i class="chev fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                    </span>
                    <ul class="sub-nav theory">
                        <li>
                            <a href="study.html">Study</a>
                        </li>
                        <li>
                            <a href="practice.html">Practise</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#" target="_blank">Driving</a>
                </li>
                <li>
                    <a href="#" target="_blank">Teaching</a>
                </li>

                <li>
                    <a href="mailto:demo@gmail.com">Contact Us</a>
                </li>
                @auth
                <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                 </form>
                </li>
                @else
                <li>
                    <a href="/login">Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
    <section class="section-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="company-logo text-center">
                        <img src="_assets/img/logo.png">
                    </div>
                    <!-- <div class="company-brand -brand-1"></div> -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    