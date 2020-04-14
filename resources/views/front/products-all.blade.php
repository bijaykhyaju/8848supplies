@extends('front.layouts.front-template')

@section('mainContainer')

<div class="banner-top">
	<div class="container">
		<h1>All Products</h1>
		<em></em>
		<h2><a href="{{url('/index')}}">Home</a><label>/</label>All Products</h2>
	</div>
</div>

<div class="check-out mar-bottom">

    <div class="container">
        <div class="content-mid">
           <?php /* <h3>Product Type</h3> */ ?>
            <label class="line"></label>

            <div class="mid-popular">

            @foreach($productRows as $products)
        <?php
            $categoryRow = App\Category::getCategoryById($products->cat_id);
            $category = $categoryRow->name;

        ?>

        <div class="col-md-3 item-grid simpleCart_shelfItem" style="margin-bottom:30px;">
            <div class=" mid-pop">
                <div class="pro-img">
                    <a href="{{url('/product/'.$products->alias)}}">
                        <img src="{{ asset('/storage/uploads/images/products/'.$products->image)}}" class="img-responsive" alt="{{$products->name}}">
                    </a>
                   
                    </div>
                   

                    <div class="mid-1">
                        <div class="women">
                            <div class="women-top">
                                <span>{{$category}}</span>
                                <h6><a href="{{url('/product/'.$products->alias)}}">{{$products->name}}</a></h6>
                            </div>
                        <div class="img item_add" rel="{{$products->id}}"></div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="mid-2">
                        <p>
                            @if($products->mark_price>0)
                            <label>${{$products->mark_price}}</label>
                            @endif
                            <em class="item_price">${{$products->actual_price}}</em>
                        </p>
                       
                        
                        <div class="clearfix"></div>
                    </div>
                            
                </div>
            </div>
        </div>

        @endforeach
                

                
            </div>
        </div>

        
    </div>
    
</div>
 

@endsection