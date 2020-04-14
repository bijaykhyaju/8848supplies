@extends('front.layouts.front-template')

@section('mainContainer')
<!--banner-->
@include('front.includes.banner')

	<!--content-->
		<div class="content">
			<div class="container">

               <?php /*@include('front.includes.index_categories')*/ ?>
                
				<!--products-->
                @include('front.includes.index_products')
			    <!--//products-->
			</div>
			<!--brand-->
			<?php /* @include('front.includes.brand_ads') */?>
			<!--//brand-->
		</div>
	<!--//content-->

@endsection