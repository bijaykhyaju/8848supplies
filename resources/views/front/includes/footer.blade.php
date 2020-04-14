<div class="footer">
	<div class="footer-middle">
				<div class="container">
					<div class="col-md-3 footer-middle-in">
						<a href="/"><img src="{{asset('images/front/8848.png')}}" width="200px" alt=""></a>
						<?php /*<p>Suspendisse sed accumsan risus. Curabitur rhoncus, elit vel tincidunt elementum, nunc urna tristique nisi, in interdum libero magna tristique ante. adipiscing varius. Vestibulum dolor lorem.</p>*/ ?>
					</div>
					
					<div class="col-md-3 footer-middle-in">
						<h6>Menu</h6>
						<ul class="in">
							<li><a class="color" href="{{url('/index')}}">Home</a></li>
							<li><a class="color" href="{{url('/about')}}">About</a></li>
							<li><a class="color" href="{{url('/category')}}">Category</a></li>
							
							
						</ul>
						<ul class="in in1">
							<li><a class="color" href="{{url('/products')}}">Products</a></li>
							<li><a class="color" href="{{url('/contact')}}">Contact</a></li>

							<?php /*<li><a href="#">Order History</a></li>
							<li><a href="wishlist.html">Wish List</a></li>
							<li><a href="login.html">Login</a></li>*/ ?>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-3 footer-middle-in">
						<?php /*<h6>Hot Deals</h6>
						<ul class="tag-in">
							<li><a href="#">Lorem</a></li>
							<li><a href="#">Sed</a></li>
							<li><a href="#">Ipsum</a></li>
							<li><a href="#">Contrary</a></li>
							<li><a href="#">Chunk</a></li>
							<li><a href="#">Amet</a></li>
							<li><a href="#">Omnis</a></li>
						</ul>*/ ?>
					</div>
					<div class="col-md-3 footer-middle-in">
						<h6 style="margin-bottom:5px;">Newsletter</h6>
						<span class="res-msg success-msg">&nbsp;</span></br>
						<span>Sign up for News Letter</span>
							<form>
								<input type="text" name="newsletter_email" id="newsletter_email" placeholder="Enter your email" required>
								<input id="newsletter_submit" type="button" value="Subscribe">	
							</form>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="container">
					<ul class="footer-bottom-top">
						<?php /*<li><a href="#"><img src="{{asset('images/front/f1.png')}}" class="img-responsive" alt=""></a></li>
						<li><a href="#"><img src="{{asset('images/front/f2.png')}}" class="img-responsive" alt=""></a></li>
						<li><a href="#"><img src="{{asset('images/front/f3.png')}}" class="img-responsive" alt=""></a></li>*/ ?>
					</ul>
					<p class="footer-class">&copy; 2020 8848 Supplies. All Rights Reserved
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		

<script type="text/javascript">
	//add item to cart
	$(document).on('click','#newsletter_submit', function(){
		//alert("hello");
		var eml = $('#newsletter_email').val();
		if(eml==''){
			$('.res-msg').removeClass('success-msg').addClass('err-msg').html("Please enter your email");
			
		}else if(eml=='' || eml.indexOf('@')==-1 || eml.indexOf('.')==-1 ){
			$('.res-msg').removeClass('success-msg').addClass('err-msg').html("Please enter valid email");
		}else{
			var token = '{{csrf_token()}}';
			$.ajax({
				url: '{{url('/subscribe-newsletter')}}',
				type: 'post',
				data: {"_token": token, "nl_email": eml },
				error: function(data) {
					console.log(data+" This is error section");
				},
				success: function(data){
					if(data=="exist"){
						$('.res-msg').removeClass('success-msg').addClass('err-msg').html("You have already subscribed.");
					}else{
						$('#newsletter_email').val('');
						$('.res-msg').addClass('success-msg').removeClass('err-msg').html("Thank you for the subscription.");
						console.log(data+" Suscribed successfully");
					}
				}
			});
		}
	});
	$(document).ready(function(){

		var highestBox = 0;
		//console.log(highestBox);
		$('.item-grid .mid-pop .pro-img').each(function(){  
			if($(this).height() > highestBox){  
				highestBox = $(this).height();  
			}
			//console.log(highestBox);
		});  
		$('.item-grid .mid-pop .pro-img').height(highestBox);


		$("#fullscreen-slider").slider();
		$("#demo1").slider({
		speed : 500,
		delay : 2500
		});
	

		//add newsletter
		$(document).on('click','.item_add', function(){
			var t = $(this);
			var pId = t.attr('rel');
			//console.log(pId);
			var qnt = '1';
			var token = '{{csrf_token()}}';
			$.ajax({
				url: '{{url('/add-item')}}',
				type: 'post',
				data: {"_token": token, "product_id": pId, "quantity":qnt},
				error: function(data) {
					console.log(data+" This is error section");
				},
				success: function(data){
					console.log(data+" Updated successfully");
				}
			});
		});

	});
</script>	

<script src="{{asset('js/simpleCart.min.js')}}"> </script>
<!-- slide -->

<!--light-box-files -->
<script src="{{asset('js/jquery.chocolat.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/chocolat.css')}}" type="text/css" media="screen" charset="utf-8">
<!--light-box-files -->
<script type="text/javascript" charset="utf-8">
	$(function() {
		$('a.picture').Chocolat();
	});
</script>
