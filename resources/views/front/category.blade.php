@extends('front.layouts.front-template')

@section('mainContainer')

<div class="banner-top">
	<div class="container">
		<h1>Category</h1>
		<em></em>
		<h2><a href="{{url('/index')}}">Home</a><label>/</label>Category</h2>
	</div>
</div>

<div class="check-out mar-bottom">

    <div class="container">
        <div class="content-mid">
           <?php /* <h3>Product Type</h3> */ ?>
            <label class="line"></label>

            <div class="mid-popular">

                @foreach($catRows as $catRow)
                

                <div class="col-md-3 item-grid simpleCart_shelfItem" style="margin-bottom:30px;">
                    <div class=" mid-pop" style="min-height:410px;">
                        <div class="pro-img" style="min-height: 323px;">
                            <a href="{{url('/category/'.$catRow->alias)}}">
                                <img src="{{ asset('/storage/uploads/images/categories/'.$catRow->image)}}" class="img-responsive" alt="{{$catRow->name}}">
                            </a>
                           
                            </div>
                        
                            <div class="mid-1">
                                <div class="women">
                                    <div class="women-top">
                                        
                                        <h6><a href="{{url('/category/'.$catRow->alias)}}">{{$catRow->name}}</a></h6>
                                    </div>
                                
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