@extends('layouts.user-layout')

@section('mainSection')


<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href='{{url("/dashboard")}}'>Home</a></li>
          <li class="breadcrumb-item"><a href='{{url("/product-category")}}'>Product Categories</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>

        <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                      <div class="card-header" style="display:block;min-height: 62px;">
                          <div class="top-bar">
                              <div class="left-element">
                                <h4>{{$catRow->name}} Products</h4>
                              </div>

                              <div class="right-element">
                                <a href="{{url('/products/add/'.$catRow->id)}}"><button type="button" class="btn btn-info" id="add-product">Add Product</button></a>
                              </div>
                          </div>
                      </div>

                      <div class="card-body">
                    <?php 
                        $count = 1;
                        //$categoryCount = 0;
                    ?>
                      @if($productCount>0)
                            <ul id="sorter" class="polaroid">

                             @foreach($products as $product)
                            
                              <li id="sortdata" >
                                  <div class="polaroidimg">
                                      <a href="{{url('/product/edit/'.$product->id)}}"><img src="{{ asset('/storage/uploads/images/products/'.$product->image)}}" width="200" height="250"  border="0" /></a>
                                  </div>
                                  <div class="polaroidlabel">
                                      <div class="tr">
                                        <div class="td">
                                            <span class="cat_sn">{{$count++}}.</span>&nbsp; {{ucwords($product->name)}}
                                      </div>
                                    </div>
                                  </div>
                                  <div class="polaroidoption">

                                      <a href="JavaScript:void(0);" class="cat_del_link delete-product" data-toggle="modal" data-target="#deleteProductModal" rel="{{$product->id}}"><img src="{{ asset('images/icon_delete.png') }}" width="24" height="24" border="0" /></a>

                                      <div style="float:right;width:82px;padding-bottom:10px;">
                                        <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input publish-product" rel="{{$product->id}}" id="product_{{$product->id}}" {{App\Product::isProductPublish($product->id)}}>
                                          <label class="custom-control-label" for="product_{{$product->id}}">Publish</label>
                                        </div>
                                        
                                      </div>

                                      <div id="img-" style="float:right;width:30px;display:none;">
                                        <img src="{{ asset('images/loading.gif') }}" width="20" height="20" border="0" />
                                      </div>
                                  </div>
                              </li>

                             @endforeach



                             </ul>

                             @else
                             <div>No products found under this categories. Please click "Add Product" button to add new product.</div>
                            

                          @endif




                                <!-- Modal -->
                                <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModal" aria-hidden="true" data-backdrop="false">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete this product?</h5>

                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group">
                                            <p class="err-msg">This will delete this product including all the information and file. Are you sure you want to continue?</p>

                                        </div>


                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="deleteProductBtn">Confirm</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <input name="product_id" id="product_id_delete" value="" hidden>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
  $('#add-product').click(function(){
    location.href = '/music';

  });


  $('.delete-product').click(function(){
    var id = $(this).attr('rel');
    //alert(id);
    $('#product_id_delete').val(id);

  });

  $('.publish-product').click(function(){
    //alert($(this).val());
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var isChecked = '0';
    var instId = $(this).attr('rel');
    if($(this).is(':checked')){
      //console.log("checked");
      isChecked = '1';
    }
    $.ajax({
      url: '{{url("/product/publish")}}',
      type: 'post',
      data: { _token : CSRF_TOKEN, id : instId, is_publish : isChecked },
      error:function(data){
        console.log(data);
      },
      success: function(data){
        console.log("Status Changed");
        

      }


      });
  });


    $('#deleteProductBtn').click(function(){
        var pId = $('#product_id_delete').val();
        //alert(pId);
        var delBtn = $(this);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //alert(CSRF_TOKEN);
        $.ajax({
          url: '/product/delete',
          type: 'post',
          data: { _token : CSRF_TOKEN, id: pId},
          beforeSend: function() {
              // setting a timeout
              //alert('hello');
              delBtn.html('Deleting..');
          },
          error:function(data){
            delBtn.html('Confirm');
            console.log(data);
          },
          success: function(data){
            console.log(data+"Deleted");
            location.reload();

          }


          });
    });


</script>



@endsection
