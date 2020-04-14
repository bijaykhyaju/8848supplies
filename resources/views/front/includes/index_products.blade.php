<div class="content-mid">
    <h3>Trending Items</h3>
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
                    <?php
                    /*<div class="zoom-icon ">
                        <a class="picture" href="{{ asset('/storage/uploads/images/products/'.$products->image)}}" rel="{{$products->name}}" class="b-link-stripe b-animate-go  thickbox"><i class="glyphicon glyphicon-search icon "></i></a>
                            <a href="single.html"><i class="glyphicon glyphicon-menu-right icon"></i></a>
                        </div>
                         */?>
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
                        <?php /*<div class="block">
                            <div class="starbox small ghosting"> </div>
                        </div>*/?>
                        
                        <div class="clearfix"></div>
                    </div>
                            
                </div>
            </div>
        </div>

        @endforeach
        

           
    </div>
</div>
