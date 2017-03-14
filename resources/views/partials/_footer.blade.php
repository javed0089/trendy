 <footer>
    <div class="footer">
        <div class="container"> 
            <!-- Prefooter Section -->
            <div class="row pre-footer">
                <div class="col-md-4">
                    <div class="contact-box">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <div class="contact-details">
                            <h4 class="pre-footer-title">{!! isset($footer_blocks->get(0)->{lang_col('title')})?$footer_blocks->get(0)->{lang_col('title')}:'Not set' !!}</h4>
                            <p>{!! isset($footer_blocks->get(0)->{lang_col('value')})?nl2br($footer_blocks->get(0)->{lang_col('value')}):'Not set' !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-box">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <div class="contact-details">
                            <h4 class="pre-footer-title">{!! isset($footer_blocks->get(1)->{lang_col('title')})?$footer_blocks->get(1)->{lang_col('title')}:'Not set' !!}</h4>
                            <p>{!! isset($footer_blocks->get(1)->{lang_col('value')})?nl2br($footer_blocks->get(1)->{lang_col('value')}):'Not set' !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-box">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <div class="contact-details">
                            <h4 class="pre-footer-title">{!! isset($footer_blocks->get(2)->{lang_col('title')})?$footer_blocks->get(2)->{lang_col('title')}:'Not set' !!}</h4>
                            <p>{!! isset($footer_blocks->get(2)->{lang_col('value')})?nl2br($footer_blocks->get(2)->{lang_col('value')}):'Not set' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Prefooter Section -->
            <!-- Footer widgets -->
            <div class="row widgets">
                <div class="col-md-4 col-sm-6">
                    <div class="about-txt widget">
                        <img src="{{asset('images/footer-logo.png')}}" alt="logo" />
                        <p>{!! isset($footer_blocks->get(3)->{lang_col('value')})?$footer_blocks->get(3)->{lang_col('value')}:'Not set' !!} </p>
                        <div class="widgets-social">
                            <a href="{!! isset($social_blocks->get(0)->{lang_col('value')})?$social_blocks->get(0)->{lang_col('value')}:'#' !!}"> <i class="fa fa-facebook" aria-hidden="true"></i> </a>
                            <a href="{!! isset($social_blocks->get(1)->{lang_col('value')})?$social_blocks->get(1)->{lang_col('value')}:'#' !!}"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="{!! isset($social_blocks->get(2)->{lang_col('value')})?$social_blocks->get(2)->{lang_col('value')}:'#' !!}"> <i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            <a href="{!! isset($social_blocks->get(3)->{lang_col('value')})?$social_blocks->get(3)->{lang_col('value')}:'#' !!}"> <i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            <a href="{!! isset($social_blocks->get(4)->{lang_col('value')})?$social_blocks->get(4)->{lang_col('value')}:'#' !!}"> <i class="fa fa-instagram" aria-hidden="true"></i></a>

                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="quick-links widget">
                        <h2 class="widget-title">{{__("QUICK LINKS")}}</h2>
                        <ul>
                            <li> <a href="#"> Products </a> </li>
                            <li> <a href="#"> Contact </a> </li>
                            <li> <a href="#"> Services </a> </li>
                            <li> <a href="#"> Industry info </a> </li>
                            <li> <a href="#"> Latest News </a> </li>
                        </ul>
                    </div>
                </div>
                <div class="spacer-50 visible-sm"></div>
                <div class="col-md-3 col-sm-6">
                    <div class="our-services widget">
                        <h2 class="widget-title">OUR SERVICES</h2>
                        <ul>
                            <li> <a href="#"> Chemicals &amp; Commercial Fuels </a> </li>
                            <li> <a href="#"> Aviation Fuels &amp; Marine Fuels </a> </li>
                            <li> <a href="#"> Lubricants Services </a> </li>
                            <li> <a href="#"> Liquified Petrolium Gas </a> </li>
                            <li> <a href="#"> Shell Sulphur, Trading &amp; Supply </a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="newsletter widget">
                        <h2 class="widget-title">{{__('Newsletter')}}</h2>
                        <p>{{__('Subscribe to our newsletters to receive latest news and updates.')}}</p>
                        <!-- ============= Mailchimp Subscribe Form ============= -->
                        <form action="php/subscribe.php" id="subscribeform" method="post">
                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="{{__('Enter your email')}}" class="form-control" title="Please enter your email" data-msg-email="{{__('Please enter a valid email')}}">
                            </div>
                            <button type="submit" class="btn btn-block" id="js-subscribe-btn"> {{__('Subscribe Now!')}} </button>
                            <div id="js-subscribe-result" data-success-msg="Done. Subscribed" data-error-msg="Oops. Error!"></div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Footer widgets -->
        </div>
    </div>
    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row copyright-bar">
                <div class="col-md-6">
                    <p>{{__('Copyright')}} © {{Date('Y')}} {{__('GAP Polymers')}}. {{__('All rights reserved')}}.</p>
                </div>
                <div class="col-md-6 text-right">
                    <p> <a href="#"> {{__('Terms of use')}}</a> <a href="#">{{__('Privacy Policy')}}</a> <span> | </span>{{__('Powered By')}} : {{__('GAP Holding')}} </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright -->
</footer>