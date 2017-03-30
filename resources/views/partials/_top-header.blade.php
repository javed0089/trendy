<div class="row logo-top-info">
    <div class="container">
        <div class="col-md-3 logo">
            <!-- Main Logo -->
            <a href="/"><img src="{{asset('images/logo.png')}}" alt="Gap-Polymers Logo" /></a>
            <!-- Responsive Toggle Menu -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only"> Main Menu </span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="col-md-9 top-info-social">
            <div class="pull-right">
                <div class="top-info">
                    <div class="call">
                        <h3> {{$header_blocks->get(0)->{lang_col('title')} }}</h3>
                        <p> {{$header_blocks->get(0)->{lang_col('value')} }} </p>
                    </div>
                    <div class="email">
                        <h3> {{$header_blocks->get(1)->{lang_col('title')} }} </h3>
                        <p> {{$header_blocks->get(1)->{lang_col('value')} }} </p>
                    </div>
                    <div class="market">
                        <h3> {{$header_blocks->get(2)->{lang_col('title')} }} </h3>
                        <p> {{$header_blocks->get(2)->{lang_col('value')} }} </p>
                    </div>

                </div>
                <div class="social" >
                    <ul class="social-icons pull-right">
                        <li><a target="_blank" href="{{$social_blocks->get(0)->{lang_col('value')} }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="{{$social_blocks->get(1)->{lang_col('value')} }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="{{$social_blocks->get(2)->{lang_col('value')} }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="{{$social_blocks->get(3)->{lang_col('value')} }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="{{$social_blocks->get(4)->{lang_col('value')} }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>

                  
                </div>
            </div>

        </div>

    </div>
</div>