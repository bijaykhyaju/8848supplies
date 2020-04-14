@extends('front.layouts.front-template')

@section('mainContainer')

<div class="banner-top">
	<div class="container">
		<h1>Order Summary</h1>
		<em></em>
		<h2><a href="{{url('/index')}}">Home</a><label>/</label><a href="{{url('/cart')}}">Cart</a><label>/</label><a href="{{url('/correspondence-detail')}}">Correspondence</a><label>/</label>Order Summary</h2>
	</div>
</div>

<div class="check-out mar-bottom">
    @if($cartCount)
    <div class="container" id="main-container">
        
        <div class="bs-example4" data-example-id="simple-responsive-table">
        <div class="table-responsive">
            <table class="table-heading simpleCart_shelfItem">
                
                <tbody>
                    <tr>
                        <th class="table-grid">Item</th>
                        <th>Prices</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>

                    @foreach($cartRows as $item)
                        <?php
                            $product = App\Product::getProductById($item->product_id);
                            $endstr = "";
                            $desc = substr($product->description, 0, 150);
                            if(strlen($product->description)>150) $endstr = "...";
                        ?>

                    
                    <tr class="cart-header1">
                        <td class="ring-in">
                            <a href="single.html" class="at-in">
                                <img src="{{ asset('/storage/uploads/images/products/'.$product->image)}}" class="img-responsive" alt="">
                            </a>
                            <div class="sed">
                                <h5>
                                    <a href="{{url('/product/'.$product->alias)}}">{{$product->name}}</a>
                                </h5>
                                <p>{{$desc.$endstr}}</p>
                            </div>
                            <div class="clearfix"> </div>
                            
                        </td>
                        <td>&#36;<span id="sp-amt">{{$item->selling_price}}<span></td>
                        <td>
                            <div class="quantity-select">                           
                                <div class="entry value-minus decrease-item" rel="{{$item->id}}" sprice="{{$item->selling_price}}">&nbsp;</div>
                                <div class="entry value">
                                    <span class="itm-qnty">{{$item->cart_quantity}}</span>
                                </div>
                                <div class="entry value-plus increase-item active" rel="{{$item->id}}" sprice="{{$item->selling_price}}">&nbsp;</div>
                            </div>
                        </td>
                        <td class="item_price">&#36;
                            <span id="item-total-amt">{{$item->total_price}}<span>
                        </td>
                        <td class="add-check">
                            <div class="close1 pos-ini" rel="{{$item->id}}"> </div>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
        <div class="produced">
            <a href="{{url('/detail-confirmation')}}" class="hvr-skew-backward">Next</a>
        </div>
    </div>
    @else
    <div class="four">
        <h3>Cart Empty</h3>
        <p>Sorry! the products added to the cart has either been removed or no longer exist.</p>
        <a href="/index" class="hvr-skew-backward">Back To Home</a>
    </div>

    @endif
</div>
<script>
    $(document).ready(function(c) {
        $('.increase-item').on('click', function(){
            var t = $(this);
            var cartId = t.attr('rel');
            var sellPrice = parseFloat(t.attr('sprice')).toFixed(2);
            var divUpd = t.parent().find('.value');
            var newVal = parseInt(divUpd.text(), 10)+1;
            divUpd.text(newVal);
            addLessCartItem(t,cartId,newVal,sellPrice);
            

        });

        $('.decrease-item').on('click', function(){
            var t = $(this);
            var cartId = t.attr('rel');
            var sellPrice = parseFloat(t.attr('sprice')).toFixed(2);
            var divUpd = t.parent().find('.value');
            var newVal = parseInt(divUpd.text(), 10)-1;
            if(newVal>=1){
                divUpd.text(newVal);
                addLessCartItem(t,cartId,newVal,sellPrice);
            }
        });

        function addLessCartItem($this,id, qnty, sPrice){
            var totalAmount = parseFloat(qnty*sPrice).toFixed(2);
            var r = $this.parent().parent('td').next('.item_price').children('#item-total-amt').text(totalAmount);
            var token = '{{csrf_token()}}';
            $.ajax({
                url: '{{url('/cart-update')}}',
                type: 'post',
                data: {"_token": token, "cart_id": id, "quantity": qnty },
                error: function(data) {
                    console.log(data+" This is error section");
                },
                success: function(data){
                    console.log(data+" Updated successfully");
                }
            });
        }

        $('.close1').on('click', function(c){
            var t = $(this);
            var cId = t.attr('rel');
            console.log(cId);
            var token = '{{csrf_token()}}';
            var cartBlock = t.parent('.add-check').parent('.cart-header1');
            $.ajax({
                url: '{{url('/cart-delete')}}',
                type: 'post',
                data: {"_token": token, "cart_id": cId},
                error: function(data) {
                    console.log(data+" This is error section");
                },
                success: function(data){
                    console.log(data+" Deleted successfully");
                    //data = "empty";
                    if(data=="empty"){
                        $('.cart-icon-count').text('0');
                        $('#main-container').html('<div class="four"><h3>Cart Empty</h3><p>Sorry! the products added to the cart has been removed and no longer exist.</p><a href="/index" class="hvr-skew-backward">Back To Home</a></div>');
                    }
                    cartBlock.fadeOut(600, function(c){
                        cartBlock.remove();
                    });
                }
            });
            
        });	  
    });
</script>

@endsection