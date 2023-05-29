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
<header class="site-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
                @if(request()->is('getting-started/*') || request()->is('theory/*')) 
                   <a class="header-icon u-mr1" href="/">
                        <i class="fa fa-home" style="font-size: 26px;"></i>
                    </a>
                    <a class="header-icon -back" href="{{ url()->previous() }}">
                            <i class=" fa fa-chevron-left"></i>
                        <span>&nbsp; Back</span>
                    </a>
                @endif
                </div>
                <div class="col-xs-6 col-sm-8 col-md-8 col-lg-8">
                <div class="text-center">
                @if(request()->is('getting-started/*')) 
                  <span class="page__title"> Getting Started  </span>
                @elseif(request()->is('theory/*'))
                  <span class="page__title"> Theory </span>
                @else
                  <span class="page__title"> Home </span>
                @endif

                    
                </div>
            </div>
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
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/1">Getting Started</a>
                </li>
                <li>
                    <a href="/2">Theory</a>
                    <span class="nav-toggle-area">
                        <a href="#" class="nav-chevron" data-toggle="theory">
                            <i class="chev " aria-hidden="true"></i>
                        </a>
                    </span>
                    <!-- <ul class="sub-nav theory">
                        <li>
                            <a href="study.html">Study</a>
                        </li>
                        <li>
                            <a href="practice.html">Practise</a>
                        </li>

                    </ul> -->
                </li>

                <!-- <li>
                    <a href="#" target="_blank">Driving</a>
                </li>
                <li>
                    <a href="#" target="_blank">Teaching</a>
                </li> -->

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
        <div class="container" style="max-width: 1140px;">
           @if(Route::currentRouteName() == 'chapters')
            <div class="row py-2">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="text-center">
                        @isset($lessons)
                        <span class="t-bold score-number average-score u-block text-white">{{ $lessons->count() }}</span>
                        <span class="score-text t-light-grey text-white">Units Complete</span>
                        @endisset
                    </div><!-- /.text-center -->
                </div><!-- /.col-lg-4 -->
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="text-center">
                        <span class="t-bold score-number average-score u-block text-white">{{ $question_attemp_count }} / {{$children_question_count}}</span>
                        <span class="score-text t-light-grey text-white">Total Score</span>
                    </div><!-- /.text-center -->
                </div><!-- /.col-lg-4 -->
            </div>
            @else
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="company-logo text-center">
                       <a href="/">
                            <img src="{{asset('_assets/img/logo.png')}}">
                       </a>
                    </div>
                    <!-- <div class="company-brand -brand-1"></div> -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @endif
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    