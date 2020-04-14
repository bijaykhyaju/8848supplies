@extends('front.layouts.front-template')

@section('head-content')
<style>
    .st-center{
        display:none!important;
    }
</style>

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e904524af8de900125a0fc5&product=sticky-share-buttons&cms=website' async='async'></script>

@endsection

@section('body-content')
    
    <div class="sharethis-inline-share-buttons" style></div>
  <?php /*<!-- <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script> --> */ ?>
@endsection

@section('mainContainer')
<div class="banner-top">
	<div class="container">
		<h1>Product Detail</h1>
		<em></em>
		<h2><a href="{{url('/index')}}">Home</a><label>/</label>Product Detail</h2>
	</div>
</div>
<div class="single">

<div class="container">
<div class="col-md-9">
	<div class="col-md-5 grid">		
    
		<div class="flexslider">
        <!-- Your share button code -->
        <div class="fb-share-button" 
            data-href="{{url('/product/'.$product->alias)}}" 
            data-layout="button_count">
        </div>
			  
        <div class="flex-viewport" style="overflow: hidden; position: relative;">
            <ul class="slides" style="width: 1000%; transition-duration: 0.6s; transform: translate3d(-608px, 0px, 0px);">
                <li data-thumb="{{asset('/storage/uploads/images/products/'.$product->image)}}" class="clone" aria-hidden="true" style="width: 304px; float: left; display: block;">
			        <div class="thumb-image"> 
                       <img src="{{asset('/storage/uploads/images/products/'.$product->image)}}" data-imagezoom="true" class="img-responsive" draggable="false"> 
                    </div>
			    </li>
			    <li data-thumb="{{asset('/storage/uploads/images/products/'.$product->image)}}" style="width: 304px; float: left; display: block;" class="">
			        <div class="thumb-image"> <img src="{{asset('/storage/uploads/images/products/'.$product->image)}}" data-imagezoom="true" class="img-responsive" draggable="false"> </div>
			    </li>
			    <li data-thumb="{{asset('/storage/uploads/images/products/'.$product->image)}}" class="flex-active-slide" style="width: 304px; float: left; display: block;">
			         <div class="thumb-image"> <img src="{{asset('/storage/uploads/images/products/'.$product->image)}}" data-imagezoom="true" class="img-responsive" draggable="false"> </div>
			    </li>
			    <li data-thumb="{{asset('/storage/uploads/images/products/'.$product->image)}}" class="" style="width: 304px; float: left; display: block;">
			       <div class="thumb-image"> <img src="{{asset('/storage/uploads/images/products/'.$product->image)}}" data-imagezoom="true" class="img-responsive" draggable="false"> </div>
			    </li> 
			  <li data-thumb="{{asset('/storage/uploads/images/products/'.$product->image)}}" style="width: 304px; float: left; display: block;" class="clone" aria-hidden="true">
			        <div class="thumb-image"> <img src="{{asset('/storage/uploads/images/products/'.$product->image)}}" data-imagezoom="true" class="img-responsive" draggable="false"> </div>
                </li>
            </ul>
        </div>
        <ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="#">Next</a></li></ul></div>
	</div>	
    <div class="col-md-7 single-top-in">
        <div class="span_2_of_a1 simpleCart_shelfItem">
            <h3>{{ucwords($product->name)}}</h3>
            <p class="in-para"></p>
            <div class="price_single">
                @if($product->mark_price>0)
                <span class="reducedfrom" style="text-decoration:line-through;color:#da0b14;font-size: 20px;">${{$product->mark_price}}</span>
                <div class="clearfix"> </div>
                @endif
                <span class="reducedfrom item_price">${{$product->actual_price}}</span>
            
                <div class="clearfix"></div>
            </div>
            <h4 class="quick">Description:</h4>
            <p class="quick_desc">{{$product->description}}</p>
                    
                    
            <div class="quantity"> 
                <div class="quantity-select">                           
                    <div class="entry value-minus val-dec">&nbsp;</div>
                    <div class="entry value"><span>{{$cartProduct->cart_quantity ?? '1'}}</span></div>
                    <div class="entry value-plus val-plus active">&nbsp;</div>
                </div>
            </div>
            <form name="add-cart-form" id="add-cart-form" enctype="multipart/form-data" style="display:none;">
                @csrf
                <input type="hidden" name="quantity" id="product_quantity" value="{{$cartProduct->cart_quantity ?? '1'}}">
                <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
            </form>
            <a href="javascript:void(0)" class="add-to hvr-skew-backward">Add to cart</a>
            <div class="clearfix"> </div>
        </div>
        
    </div>
    <div class="clearfix"> </div>
       
</div>
<!----->

    <div class="col-md-3 product-bottom product-at">
        <!--categories-->
        <div class=" rsidebar span_1_of_left">
            <h4 class="cate">Categories</h4>
            <ul class="menu-drop">
                @foreach($catRows as $catRow)
                <li class="item1">
                    <a href="{{url('/category/'.$catRow->alias)}}">{{$catRow->name}}</a>    
                </li>
                @endforeach
                
            </ul>
        </div>
    </div>
    <div class="clearfix"> </div>
</div>
	
	
</div>

<!--quantity-->
<script>

    $('.val-plus').on('click', function(){
    	var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
    	divUpd.text(newVal);
        $('#product_quantity').val(newVal);
    });

    $('.val-dec').on('click', function(){
    	var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
    	if(newVal>=1){
            divUpd.text(newVal);
            $('#product_quantity').val(newVal);
        }
    });

   
    $('.add-to').click(function(){
        var addBtn = $(this);
        $.ajax({
            url: '{{url('product/add-to-cart')}}',
            type: 'post',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
            data: new FormData($('#add-cart-form')[0]),
            beforeSend: function() {
                //addBtn.html("Adding...");
            },
            error: function(data) {
                //addBtn.html("Add to cart");
                
                console.log(data+"This is error section");
            },
            success: function(data){
                
                console.log(data+" Added successfully");
                location.href = "{{url('/cart')}}";
            
                            
            }
        });
    });


	</script>
	<!--quantity-->
@endsection

@section('footer')
<script src="{{asset('js/imagezoom.js')}}"></script>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script defer src="{{asset('js/jquery.flexslider.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen" />

<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
});
</script>

<script src="{{asset('js/simpleCart.min.js')}}"> </script>

@endsection