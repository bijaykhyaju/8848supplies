@extends('layouts.user-layout')

@section('mainSection')




<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href='{{url("/dashboard")}}'>Home</a></li>
          <li class="breadcrumb-item"><a href='{{url("/categories")}}'>Categories</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Category</li>
        </ol>
      </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                      <h5>{{$action}} Category</h5>

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

                            
                            <form class="add-edit-lesson" id="lesson-form" name="add-edit-lesson" enctype="multipart/form-data">
                                @csrf

                                <div class="position-relative row form-group">
                                    <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-6">
                                        
                                        <input name="category_name" id="category_name" placeholder="Enter the category name" type="text" class="form-control" value="{{$category->name ?? ''}}">
                                    </div>
                                </div>
                                
                                <div class="position-relative row form-group">
                                <label for="cat_description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea name="cat_description" id="cat_description" class="form-control" rows="6">{{$category->description ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="position-relative row form-group img-cnt">
                                    <label for="category_image" class="col-sm-2 col-form-label">Category Image</label>
                                    <div class="col-sm-6 inline-flex" id="image_sec">
                                        <input name="category_image" id="category_image" type="file" class="form-control-file file_upload @if($action=='edit' && $category->image!=''){{'file_transp'}} @endif marg-right">                                        
                                        <span class="hide">
                                            <button type="button" class="mr-2 btn btn-outline-danger btn-sm remove-file">
                                                <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                            </button>
                                        </span>
                                        
                                        @if($action=="edit" && $category->image!="")
                                            <label class="up-file-name">{{$category->image}}
                                                &nbsp;
                                                <button type="button" class="mr-2 btn btn-outline-danger btn-sm remove-upload-file">
                                                    <i class="pe-7s-trash btn-icon-wrapper"> </i>
                                                </button>   
                                            
                                            </label>
                                            <input type="hidden" name="edit_image" id="edit_image" value="{{$category->image ?? ''}}">
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="cat_id" id="cat_id" value="{{$category->id ?? '0'}}">
                       
                            </form>

                        </div>
                        
                        <div class="d-block text-center card-footer">
                            <button class="btn-wide btn btn-success" id="saveTestBtn">{{ucwords($action)}} Category</button>
                        </div>
                                    
                   

                  </div>

                </div>
            </div>

        </div>

    </div>
    <!-- @include('includes/footer') -->
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


        $('#saveTestBtn').click(function(){
            var savBtn = $(this);
            var name = $('#category_name');
            var errField = $('.err-msg');
            errField.html('');
            name.removeClass('err-input');
            $('#category_image').removeClass('err-input');
            

            //get image from input field
            var imageVal = $("#category_image");
            var imgLength = imageVal.get(0).files.length;
            var imgFileType = imageVal.val().split('.').pop().toLowerCase();
            var validImageTypes = ["gif", "jpeg", "jpg", "png"];

            if(name.val()==''){
                name.addClass('err-input');
                errField.html('*Please enter category name.');
                $('html, body').animate({
                    scrollTop: $(".card-header").offset().top
                }, 600);
                        
            }
            else if((imgLength > 0) && ($.inArray(imgFileType, validImageTypes) < 0)){
                $('#category_image').addClass('err-input');
                errField.html('*Please choose valid category image.');
            }else{
                var fileData = new FormData($("#lesson-form")[0]);
                $.ajax({
                    url: '{{url('categories/insert')}}',
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
                        savBtn.html('Add Category');
                        console.log("This is error section");
                    },
                    success: function(data){
                        if(data=="exist"){
                            name.addClass('err-input');
                            errField.html('*Category already exist. Please enter different category name.');
                            $('html, body').animate({
                                scrollTop: $(".card-header").offset().top
                            }, 600);
                            <?php if($action=="add") echo "savBtn.html('Add Category');";
                                elseif($action=="edit") echo "savBtn.html('Edit Category');"
                            ?>
                        }else{
                            console.log(data+" Added successfully");
                            location.href = '{{url('/categories')}}';    
                        }
                                    
                    }
                });
             }
            
            
        });

        

    });

  </script>





@endsection