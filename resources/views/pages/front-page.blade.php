@extends('layouts.app-master')
@section('content')
    <style>
        .company{
            height:340px;
            width: 363px;

        }
    </style>
    <section class="parallax_window_in" data-parallax="scroll" data-image-src="{{asset('assets/img/recruitment-.jpg')}}" data-natural-width="1400" data-natural-height="800">
        <div id="sub_content_in">
            <h1>AEI | Recruitment Management System</h1>
{{--            <p>"Usu habeo equidem sanctus no ex melius labitur conceptam eos"</p>--}}
{{--          <button class="btn btn-primary">VIEW JOBS</button>--}}
{{--            <a href="{{route('view-jobs')}}" class="btn_1 rounded mobile_btn yellow shadow">VIEW JOBS!</a>--}}
        </div>
    </section>
    <main id="general_page">
        <div class="container_styled_1">
                <div class="container margin_60_35">
{{--                    @include('view_jobs.view-jobs')--}}

                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="nomargin_top">A Quick Guide to a Successful Recruitment Process</h2>
                        <p class="lead">What Is the HR Recruitment Process?</p>
                        <p style="text-indent: 50px; letter-spacing: 2px; text-align: justify;">The recruitment process is the steps involved in attracting and
                            hiring a new employee to fill a position in an organization. Managers,
                            Human Resource Management (HRM), recruiters, or a combination of the three are
                            typically in charge of this task. Human resource managers are typically in charge
                            of this process, working with relevant departments and team members to streamline
                            recruitment.

                            The recruitment process entails identifying the candidate with the
                            best combination of skills, experience, and personality for the job. It
                            entails gathering and reviewing resumes, conducting job interviews, and
                            finally selecting and onboarding an employee to begin working for the company.</p>

                    </div>
                    <div class="col-lg-5 ml-lg-5 add_top_30">
                        <img src="{{asset('assets/img/about.svg')}}" alt="" class="img-fluid" width="500" height="360">
                    </div>
                </div>
                <!-- End row -->
            </div>
        </div>


        <div class="container margin_60">
            <div class="main_title">
                <h2>Trusted Companies</h2>
                <p>
                    A trust company is a legal entity that acts as a fiduciary, agent, or trustee on behalf of a person or business for the purposes of administration, management, and the eventual transfer of assets to a beneficial party.
                </p>
            </div>
            <!--Team Carousel -->
            <div class="row">
                <div class="owl-carousel owl-theme team-carousel">
                    <div class="team-item">
                        <div class="team-item-img">
                            <img class="company" src="{{asset('assets/img/Nestlelogo.jpg')}}" alt="">
                            <div class="team-item-detail">
                                <div class="team-item-detail-inner">
                                    <h4>Nestle ph.</h4>
                                    <p>Nestlé S.A. is a Swiss multinational food and drink processing conglomerate corporation headquartered
                                        in Vevey, Vaud, Switzerland. It is the largest publicly held food company in the world, measured by revenue
                                        and other metrics, since 2014</p>
                                    <ul class="social">
                                        <li><a href=""><i class="icon-facebook"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-twitter"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-google"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-linkedin"></i></a>
                                        </li>
                                    </ul>
                                    <a href="https://www.nestle.com/jobs/search-jobs" class="btn_1 white">View porfile</a>
                                </div>
                            </div>
                        </div>
                        <div class="team-item-info">
                            <h4>Nestle Ph.</h4>
                        </div>
                    </div>
                    <!-- /team-item -->
                    <div class="team-item">
                        <div class="team-item-img">
                            <img class="company" src="{{asset('assets/img/delmonte.png')}}" alt="">
                            <div class="team-item-detail">
                                <div class="team-item-detail-inner">
                                    <h4>Del Monte</h4>
                                    <p>Similique sunt culpa qui officia deserunt mollitia animi dolorum fuga.</p>
                                    <ul class="social">
                                        <li><a href=""><i class="icon-facebook"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-twitter"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-google"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-linkedin"></i></a>
                                        </li>
                                    </ul>
                                    <a href="https://www.delmonte.com/" class="btn_1 white">View porfile</a>
                                </div>
                            </div>
                        </div>
                        <div class="team-item-info">
                            <h4>Del Monte</h4>
                        </div>
                    </div>
                    <!-- /team-item -->
                    <div class="team-item">
                        <div class="team-item-img">
                            <img class="company" src="{{asset('assets/img/wyeth.png')}}" alt="">
                            <div class="team-item-detail">
                                <div class="team-item-detail-inner">
                                    <h4>Wyeth</h4>
                                    <p>Similique sunt culpa qui officia deserunt mollitia animi dolorum fuga.</p>
                                    <ul class="social">
                                        <li><a href=""><i class="icon-facebook"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-twitter"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-google"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-linkedin"></i></a>
                                        </li>
                                    </ul>
                                    <a href="https://www.wyeth.com.ph/" class="btn_1 white">View porfile</a>
                                </div>
                            </div>
                        </div>
                        <div class="team-item-info">
                            <h4>Wyeth</h4>
                        </div>
                    </div>
                    <!-- /team-item -->
                    <div class="team-item">
                        <div class="team-item-img">
                            <img class="company" src="{{asset('assets/img/goldilocks.png')}}" alt="">
                            <div class="team-item-detail">
                                <div class="team-item-detail-inner">
                                    <h4>Goldilocks</h4>
                                    <p>Similique sunt culpa qui officia deserunt mollitia animi dolorum fuga.</p>
                                    <ul class="social">
                                        <li><a href=""><i class="icon-facebook"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-twitter"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-google"></i></a>
                                        </li>
                                        <li><a href=""><i class="icon-linkedin"></i></a>
                                        </li>
                                    </ul>
                                    <a href="https://www.goldilocks.com.ph/" class="btn_1 white">View porfile</a>
                                </div>
                            </div>
                        </div>
                        <div class="team-item-info">
                            <h4>Goldilocks</h4>
                        </div>
                    </div>
                    <!-- /team-item -->
                </div>
            </div>
            <!--End Team Carousel-->
        </div>
        <!-- End container -->

        <!-- End container -->
    </main>

@endsection
