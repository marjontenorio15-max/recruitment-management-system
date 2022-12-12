@extends('layouts.app-master')
@section('content')

    <div class="container margin_60">
        <div class="main_title">
            <h2>Trusted Company</h2>
            <p>
                Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie. Sed ad debet scaevola, ne mel lorem legendos.
            </p>
        </div>
        <!--Team Carousel -->
        <div class="row">
            <div class="owl-carousel owl-theme team-carousel">
                <div class="team-item">
                    <div class="team-item-img">
                        <img src="{{asset('assets/img/Nestlelogo.jpg')}}" alt="">
                        <div class="team-item-detail">
                            <div class="team-item-detail-inner">
                                <h4>Nestle ph.</h4>
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
                                <a href="https://www.nestle.com/jobs/search-jobs" class="btn_1 white">View porfile</a>
                            </div>
                        </div>
                    </div>
                    <div class="team-item-info">
                        <h4>Mitchell Young</h4>
                        <p>CEO</p>
                    </div>
                </div>
                <!-- /team-item -->
                <div class="team-item">
                    <div class="team-item-img">
                        <img src="{{asset('assets/img/delmonte.png')}}" alt="">
                        <div class="team-item-detail">
                            <div class="team-item-detail-inner">
                                <h4>Ronald Green</h4>
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
                                <a href="" class="btn_1 white">View porfile</a>

                             </div>
                        </div>
                    </div>
                    <div class="team-item-info">
                        <h4>Ronald Green</h4>
                        <p>Business Strategy</p>
                    </div>
                </div>
                <!-- /team-item -->
                <div class="team-item">
                    <div class="team-item-img">
                        <img src="{{asset('assets/img/wyeth.png')}}" alt="">
                        <div class="team-item-detail">
                            <div class="team-item-detail-inner">
                                <h4>Carl Peppard</h4>
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
                                <a href="" class="btn_1 white">View porfile</a>
                            </div>
                        </div>
                    </div>
                    <div class="team-item-info">
                        <h4>Carl Peppard</h4>
                        <p>General Manager</p>
                    </div>
                </div>
                <!-- /team-item -->
                <div class="team-item">
                    <div class="team-item-img">
                        <img src="{{asset('assets/img/goldilocks.png')}}" alt="">
                        <div class="team-item-detail">
                            <div class="team-item-detail-inner">
                                <h4>Sandra Bullock</h4>
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
                                <a href="" class="btn_1 white">View porfile</a>
                            </div>
                        </div>
                    </div>
                    <div class="team-item-info">
                        <h4>Sandra Bullock</h4>
                        <p>Customer Support</p>
                    </div>
                </div>
                <!-- /team-item -->
            </div>
        </div>
        <!--End Team Carousel-->
    </div>
    <!-- End container -->

@endsection
