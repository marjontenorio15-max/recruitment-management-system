@extends('layouts.app-master')
@section('content')

    <main id="general_page">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3866.750331842739!2d121.12489671420299!3d14.267777388972618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d887b96bbf75%3A0x6827238058a0cd!2sAlimagno%20Enterprises%2C%20Inc.!5e0!3m2!1sen!2sph!4v1666698087865!5m2!1sen!2sph" width="600" height="450" allowfullscreen id="map_iframe"></iframe>
        <!-- end map-->
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Contact us</h3>
                    <p>
                        For all enquiries, please email us using the form below.
                    </p>
                    @if(session('message'))
                        <div class='alert alert-success'>
                            {{ session('message') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                      <form class="form-horizontal" method="POST" action="{{route('contact.mailContactForm')}}">

                          {{ csrf_field() }}

                          <div class="form-group">
                              <label for="name">Name: </label>
                              <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                          </div>
                          <div class="form-group">
                              <label for="email">Email: </label>
                              <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
                          </div>
                          <div class="form-group">
                              <label for="message">Message: </label>
                              <textarea type="text" class="form-control" id="message" placeholder="Enter your message here" name="message" required> </textarea>
                          </div>
                          <div class="form-group">
                              <button type="submit" class="btn btn-primary" value="Send">Send</button>
                          </div>

                      </form>

{{--                    <div>--}}
{{--                        <div id="message-contact"></div>--}}
{{--                        <form method="post" action="{{asset('assets/assets/contact.php')}}" id="contactform">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name_contact">First Name</label>--}}
{{--                                        <input type="text" class="form-control" id="name_contact" name="name_contact">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="lastname_contact">Last Name</label>--}}
{{--                                        <input type="text" class="form-control" id="lastname_contact" name="lastname_contact">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="email_contact">Email</label>--}}
{{--                                        <input type="email" id="email_contact" name="email_contact" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="phone_contact">Phone number</label>--}}
{{--                                        <input type="text" id="phone_contact" name="phone_contact" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="message_contact">Your message</label>--}}
{{--                                        <textarea rows="5" id="message_contact" name="message_contact" class="form-control" style="height:100px;"></textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="verify_contact">Are you human? 3 + 1 =</label>--}}
{{--                                        <input type="text" id="verify_contact" class=" form-control">--}}
{{--                                    </div>--}}
{{--                                    <p><input type="submit" value="Submit" class="btn_1 add_bottom_15" id="submit-contact"></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                </div>
                <!-- End col lg 9 -->
                <aside class="col-lg-4">
                    <div class="box_style_2">
                        <h4>Contacts info</h4>
                        <p>
                            149 JP Rizal St, Cabuyao, 4025 Laguna
                            <br>  (049) 531 2610
                            <br>
                            <a href="">info@domain.com</a>
                        </p>
                        <h5>Get directions</h5>
                        <form action="http://maps.google.com/maps" method="get" target="_blank">
                            <div class="form-group">
                                <input type="text" name="saddr" placeholder="Enter your location" class="form-control" style="background:none;">
                                <input type="hidden" name="daddr" value="149 JP Rizal St, Cabuyao, 4025 Laguna">
                                <!-- Write here your end point -->
                            </div>
                            <input type="submit" value="Get directions" class="btn_1 add_bottom_15">
                        </form>
                        <hr class="styled">
                        <h4>Departments</h4>
                        <ul class="contacts_info">
                            <li>Administration
                                <br>
                                <a href="tel://003823932342">0038 23932342</a>
                                <br><a href="tel://003823932342">admin@potenza.com</a>
                                <br>
                                <small>Monday to Friday 9am - 7pm</small>
                            </li>
                            <li>General questions
                                <br>
                                <a href="tel://003823932342">0038 23932342</a>
                                <br><a href="tel://003823932342">questions@potenza.com</a>
                                <br>
                                <small>Monday to Friday 9am - 7pm</small>
                            </li>
                        </ul>
                    </div>
                </aside>
                <!--End aside -->
            </div>
            <!-- end row-->
        </div>
        <!-- end container-->
    </main>

@endsection
