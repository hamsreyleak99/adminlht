@extends('FrontEnd.layout.app')

@section('content')
	<!-- Page Content -->
    <div class="container">

        <div class="row" style=" margin-top: 95px;">
            <div class="col-lg-12">
                <h3>Our Location</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-md-8">
                <!-- Embedded Google Map -->
		 <div class="animated zoomIn">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.9431351440876!2d104.9203670147919!3d11.55593434748099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109513b6718dc61%3A0xfb868ef4f39a478b!2s160+Preah+Sihanouk+Blvd+(274)%2C+Phnom+Penh!5e0!3m2!1sen!2skh!4v1464056365510" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
         </div>       
            </div>
            <!-- Contact Details Column -->
            <div class="col-md-4">
			 <div class="animated zoomIn">
                <h3>Contact Details</h3>
                <p>
                   N0 . 160 E2, Preah Sihanouk Boulevard <br>Beoung Keng Kong I, Khan Chamkarmon<br> Phnom Penh, Cambodia <br>
                </p>
			</div>
		 <div class="animated zoomIn">
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Phone">Tel</abbr>: (+855) 23 224 487</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email">E-mail</abbr>: <a href="kao.sokharany@lhtcapital.com">kao.sokharany@lhtcapital.com</a>
                </p>
                <p><i class="fa fa-clock-o"></i> 
                    <abbr title="Hours">H</abbr>: Monday - Sunday: 8:00 AM to 7:00 PM</p>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
		 </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">
                <h3>Send us a Message</h3>
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Phone Number:</label>
                            <input type="tel" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@stop