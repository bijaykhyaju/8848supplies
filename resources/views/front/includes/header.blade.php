
<div class="header">
<div class="container">
		<div class="head">
			<div class=" logo">
				<a href="{{url('/index')}}"><img src="{{asset('images/front/logo.png')}}" alt=""></a>	
			</div>
		</div>
	</div>
	<div class="header-top">
		<div class="container">
		<div class="col-sm-5 col-md-offset-2 header-login">
					<?php /*<ul >
						<li><a href="login.html">Login</a></li>
						<li><a href="register.html">Register</a></li>
						<li><a href="checkout.html">Checkout</a></li>
					</ul> */?>
				</div>
				
			<div class="col-sm-5 header-social">		
					<ul >
						<li><a href="#"></a></li>
						<?php /*<li><a href="#"><i class="ic1"></i></a></li>
						<li><a href="#"><i class="ic2"></i></a></li>
						<li><a href="#"><i class="ic3"></i></a></li>
						<li><a href="#"><i class="ic4"></i></a></li>*/ ?>
					</ul>
					
			</div>
				<div class="clearfix"> </div>
		</div>
		</div>
		
		<div class="container">
		
			<div class="head-top">
			
		 <div class="col-sm-8 col-md-offset-2 h_menu4">
				<nav class="navbar nav_bottom" role="navigation">
 
 <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header nav_2">
      <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
   </div> 
   <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav nav_1">
            <li><a class="color" href="{{url('/index')}}">Home</a></li>
			<li><a class="color" href="{{url('/about')}}">About</a></li>
			<li><a class="color" href="{{url('/category')}}">Category</a></li>
			<li><a class="color" href="{{url('/products')}}">Products</a></li>
			<li><a class="color" href="{{url('/contact')}}">Contact</a></li>
            
        </ul>
     </div>

</nav>
			</div>

			<div class="col-sm-2 search-right">
				<?php 
				$cartItems = App\Cart::cartCountBySessionId();
				//echo $cartItems;
				?>
					<div class="cart box_1" style="margin-top:5px;border: 1px solid #b2b2b2;padding: 5px;border-radius: 5px;">
						<a href="{{url('/cart')}}" style="text-decoration: none;">
							<h3 style="display:inline-flex;"> 
							<p class="cart-icon-count" style="margin-top: 4px;">{{$cartItems ?? '0'}}</p>
								
								<img src="{{asset('images/front/cart.png')}}" alt=""/>
							</h3>
						</a>
						<?php /*<p>
							<a href="javascript:;" class="simpleCart_empty" data-toggle="modal" data-target="#emptCartModal" >Empty Cart</a>
						</p>*/
						?>

					</div>
					<div class="clearfix"> </div>
					

						<!---pop-up-box---->					  
			<link href="{{asset('css/popuo-box.css')}}" rel="stylesheet" type="text/css" media="all"/>
			<script src="{{asset('js/jquery.magnific-popup.js')}}" type="text/javascript"></script>
			<!---//pop-up-box---->
			<div id="small-dialog" class="mfp-hide">
				<div class="search-top">
					<div class="login-search">
						<input type="submit" value="">
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}">		
					</div>
					<p></p>
				</div>				
			</div>
		 <script>
			$(document).ready(function() {
				$('.popup-with-zoom-anim').magnificPopup({
					type: 'inline',
					fixedContentPos: false,
					fixedBgPos: true,
					overflowY: 'auto',
					closeBtnInside: true,
					preloader: false,
					midClick: true,
					removalDelay: 300,
					mainClass: 'my-mfp-zoom-in'
				});
				$('.simpleCart_empty').click(function(){

				});
																						
			});
		</script>		
						<!----->
			</div>
			<div class="clearfix"></div>
		</div>	
	</div>	
</div>
<!-- Modal -->
	<style>
		.modal-header {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: start;
			align-items: flex-start;
			-ms-flex-pack: justify;
			justify-content: space-between;
			padding: 1rem 1rem;
			border-bottom: 1px solid #dee2e6;
			border-top-left-radius: calc(.3rem - 1px);
			border-top-right-radius: calc(.3rem - 1px);
		}
	
	</style>
<?php /*
<div class="modal fade" id="emptCartModal" tabindex="-1" role="dialog" aria-labelledby="emptCartModal" aria-hidden="true" style="opacity:1;margin: 0 auto;top: 35%;">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<h4 class="modal-title" id="exampleModalLabel">Do you want to remove all the products from the cart?</h4>

		</div>
		<div class="modal-body">
		<div class="form-group">
			<p class="err-msg">This will delete your music. Are you sure you want to continue.</p>

		</div>


		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		<button type="button" class="btn btn-primary" id="deleteBtn">Confirm</button>
		</div>
	</div>
	</div>
</div>
	<!----->

	*/ ?>