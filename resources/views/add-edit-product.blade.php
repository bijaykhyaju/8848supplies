@extends('layouts.user-layout')

@section('mainSection')

<?php
 
    if($action=="add"){
        $cat_id = $cat_id;
    }
    if($action=="edit"){
        $cat_id = $product->cat_id;
    }
?>


<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href='{{url("/dashboard")}}'>Home</a></li>
          <li class="breadcrumb-item"><a href='{{url("/product-product")}}'>Product Categories</a></li>
          <li class="breadcrumb-item"><a href='{{url("/products/".$cat_id)}}'>Products</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add product</li>
        </ol>
      </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                    {{ str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT)}}
                      <h5>{{$action}} product</h5>

                    </div>
                    <div class="table-responsive">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <div class="table-container">
                            <div class="alert alert-danger" style="display:none">&nbsp;</div>
                            <label class="err-msg"></label>

                            
                            <form class="add-edit-product" id="product-form" name="add-edit-product" enctype="multipart/form-data">
                                @csrf

                                <div class="position-relative row form-group">
                                    <label for="product_name" class="col-sm-2 col-form-label">Product Name</label>
                                    <div class="col-sm-6">
                                        
                                        <input name="product_name" id="product_name" placeholder="Enter the product name" type="text" class="form-control" value="{{$product->name ?? ''}}">
                                    </div>
                                </div>
                                
                                <div class="position-relative row form-group">
                                    <label for="product_category" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-6">
                                        <select name="product_category" id="product_category" class="form-control">
                                        @isset($categories)
                                            @foreach($categories as $catRow)
                                                <option value="{{$catRow->id}}" @isset($cat_id) @if($cat_id == $catRow->id) {{"selected='selected'"}}  @endif @endisset >{{$catRow->name}}</option>
                                            @endforeach
                                        @endisset
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                <label for="product_description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea name="product_description" id="product_description" class="form-control" rows="6">{{$product->description ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="position-relative row form-group img-cnt">
                                    <label for="product_image" class="col-sm-2 col-form-label">Product Image</label>
                                    <div class="col-sm-6 inline-flex" id="image_sec">
                                        <input name="product_image" id="product_image" type="file" class="form-control-file file_upload @if($action=='edit' && $product->image!=''){{'file_transp'}} @endif marg-right">                                        
                                        <span class="hide">
                                            <button type="button" class="mr-2 btn btn-outline-danger btn-sm remove-file">
                                                <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                            </button>
                                        </span>
                                        
                                        @if($action=="edit" && $product->image!="")
                                            <label class="up-file-name">{{$product->image}}
                                                &nbsp;
                                                <button type="button" class="mr-2 btn btn-outline-danger btn-sm remove-upload-file">
                                                    <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                </button>   
                                            
                                            </label>
                                            <input type="hidden" name="edit_image" id="edit_image" value="{{$product->image ?? ''}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="order_limit" class="col-sm-2 col-form-label">Order Limit</label>
                                    <div class="col-sm-6">
                                        
                                        <div class="input-group">
                                            
                                            <input name="order_limit" id="order_limit" placeholder="Order limit while buying" step="1" type="number" class="form-control" value="{{$product->max_order_qnt ?? ''}}">
                                           
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="mark_price" class="col-sm-2 col-form-label">Mark Price</label>
                                    <div class="col-sm-6">
                                        
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                            <input name="mark_price" id="mark_price" placeholder="Amount" step="1" type="number" class="form-control" value="{{$product->mark_price ?? ''}}">
                                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative row form-group">
                                    <label for="product_price" class="col-sm-2 col-form-label">Selling Price</label>
                                    <div class="col-sm-6">
                                        
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                            <input name="product_price" id="product_price" placeholder="Amount" step="1" type="number" class="form-control" value="{{$product->actual_price ?? ''}}">
                                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="product_id" id="product_id" value="{{$product->id ?? '0'}}">
                       
                            </form>

                        </div>
                        
                        <div class="d-block text-center card-footer">
                            <button class="btn-wide btn btn-success" id="saveProductBtn">{{ucwords($action)}} Product</button>
                        </div>
                                    
                   

                  </div>

                </div>
            </div>

        </div>

    </div>
    <?php /*@include('includes/footer') */?>
  </div>

  <script>
  
    $(document).ready(function(){
        
        $(".file_upload").on("change", function() {
            var t = $(this);
            var btn = t.next('span');
            $('#edit_image').val('');
            if ($(this).val() != "") {
                btn.removeClass('hide');
                //for removing uploaded image during edit
                t.removeClass('file_transp');
                t.siblings('label').addClass('hide').removeClass('up-file-name');

            } else {
                disappear(btn);
            }
        });

        $(".remove-upload-file").click(function() {
            var t = $(this);
            t.parent().addClass('hide').removeClass('up-file-name');
            t.parent().siblings('input').removeClass('file_transp');
            $('#edit_image').val('');
        });

        $(".remove-file").click(function() {
            var btn = $(this).parent('span');
            btn.prev('.file_upload').val('');
            disappear(btn);
        });

        function disappear(btn) {
            btn.addClass('hide');
        }


        $('#saveProductBtn').click(function(){
            var savBtn = $(this);
            var name = $('#product_name');
            var category = $('#product_category');
            var errField = $('.err-msg');
            var price = $('#product_price');
            errField.html('');
            name.removeClass('err-input');
            category.removeClass('err-input');
            price.removeClass('err-input');
            
            $('#product_image').removeClass('err-input');
            
            //get image from input field
            var imageVal = $("#product_image");
            var imgLength = imageVal.get(0).files.length;
            var imgFileType = imageVal.val().split('.').pop().toLowerCase();
            var validImageTypes = ["gif", "jpeg", "jpg", "png"];

            if(name.val()==''){
                name.addClass('err-input');
                errField.html('*Please enter product name.');
                $('html, body').animate({
                    scrollTop: $(".card-header").offset().top
                }, 600);
                        
            }else if(category.val()=='' || category.val()=='0' || category.val()==null){
                category.addClass('err-input');
                errField.html('*Please choose category for the product.');
            }
            else if((imgLength > 0) && ($.inArray(imgFileType, validImageTypes) < 0)){
                $('#product_image').addClass('err-input');
                errField.html('*Please choose valid product image.');
            }else if(price.val()==''){
                price.addClass('err-input');
                errField.html('*Please enter price of the product');
            }else{
                var fileData = new FormData($("#product-form")[0]);
                $.ajax({
                    url: '{{url('products/insert')}}',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: fileData,
                    beforeSend: function() {
                        <?php if($action=="add") echo "savBtn.html('Adding....');";
                            elseif($action=="edit") echo "savBtn.html('Editing....');"
                        ?>
                    },
                    error: function(data) {
                        <?php if($action=="add") echo "savBtn.html('Adding....');";
                            elseif($action=="edit") echo "savBtn.html('Editing....');"
                        ?>
                        console.log("This is error section");
                    },
                    success: function(data){
                        if(data=="exist"){
                            name.addClass('err-input');
                            errField.html('*Product already exist. Please enter different product name.');
                            $('html, body').animate({
                                scrollTop: $(".card-header").offset().top
                            }, 600);
                            <?php if($action=="add") echo "savBtn.html('Add product');";
                                elseif($action=="edit") echo "savBtn.html('Edit product');"
                            ?>
                        }else{
                            console.log(data+" Added successfully");
                            location.href = "{{url('/products/'.$cat_id)}}";
                        }
                                    
                    }
                });
             }
            
            
        });

        

    });

  </script>





@endsection