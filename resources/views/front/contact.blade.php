@extends('front.layouts.front-template')

@section('mainContainer')

<div class="banner-top">
	<div class="container">
		<h1>Contact</h1>
		<em></em>
		<h2><a href="{{url('/index')}}">Home</a><label>/</label>Contact</h2>
	</div>
</div>

<div class="contact">
					
				<div class="contact-form">
					<div class="container">
					<div class="col-md-6 contact-left">
						<!-- <h3>At vero eos et accusamus et iusto odio dignissimos ducimus qui </h3>
						<p>Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas.
						At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas.At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas. </p> -->
					
			
					<div class="address">
					<div class=" address-grid">
							<i class="glyphicon glyphicon-map-marker"></i>
							<div class="address1">
								<h3>Address</h3>
								<p>Unit 12/5 Integration Court,<br>
                                    Truganina, VIC 3029, Australia
								</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class=" address-grid ">
							<i class="glyphicon glyphicon-phone"></i>
							<div class="address1">
							<h3>Our Phone:</h3><h3>
								<p>1300 85 02 95</p>
							</h3></div>
							<div class="clearfix"> </div>
						</div>
						<div class=" address-grid ">
							<i class="glyphicon glyphicon-envelope"></i>
							<div class="address1">
							<h3>Email:</h3>
								<p><a href="mailto:info@example.com"> rajthala.bj@gmail.com</a></p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class=" address-grid ">
							<i class="glyphicon glyphicon-bell"></i>
							<div class="address1">
								<h3>Open Hours:</h3>
								<p>Monday-Friday, 7AM-5PM</p>
							</div>
							<div class="clearfix"> </div>
						</div>
</div>
				</div>
				<div class="col-md-6 contact-top">
					<h3></h3>
					<form>
						<div>
							<span>Your Name </span>		
							<input type="text" value="">						
						</div>
						<div>
							<span>Your Email </span>		
							<input type="text" value="">						
						</div>
						<div>
							<span>Subject</span>		
							<input type="text" value="">	
						</div>
						<div>
							<span>Your Message</span>		
							<textarea> </textarea>	
						</div>
						<label class="hvr-skew-backward">
								<input type="submit" value="Send">
						</label>
</form>						
				</div>
		<div class="clearfix"></div>
		</div>
		</div>
		<div class="map">
						
				<iframe frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/place?q=place_id:EjI1IEludGVncmF0aW9uIENvdXJ0LCBUcnVnYW5pbmEgVklDIDMwMjksIEF1c3RyYWxpYSIwEi4KFAoSCZuGg6nUi9ZqEZwLWL-jvCyxEAUqFAoSCbVJjEvTi9ZqEWKF3XhkRaJK&key=AIzaSyBHy0kl_JslHz15sXWgT_PZP0IU5QKBD7o" allowfullscreen></iframe>
					</div>
	</div>
 

@endsection