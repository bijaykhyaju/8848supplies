@extends('layouts.user-layout')

@section('mainSection')




<div class="app-main__outer">
    <div class="app-main__inner">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href='{{url("/dashboard")}}'>Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
      </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">
                      <h5>About Page</h5>

                    </div>
                    <div class="table-responsive">
                    @if (!empty($success))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="opacity:1;">
                        <strong>Success! </strong> {{ $success }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="opacity:1;">
                             <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif  
                   

                        <div class="table-container">
                            <div class="alert alert-danger" style="display:none">&nbsp;</div>
                            <label class="err-msg"></label>

                            
                            <form class="edit-about-page" id="edit-about" name="edit-about" enctype="multipart/form-data" method="post"  action="{{url('/admin/about-update')}}">
                                @csrf

                                <div class="position-relative row form-group">
                                    <label for="category_name" class="col-sm-2 col-form-label">Page Name</label>
                                    <div class="col-sm-8">
                                    {!! Form::text("page_name", $page->name ?? old("page_name"), ['class'=> 'form-control', 'id' => "page_name", 'placeholder' => 'Enter the page name', 'disabled'=>'true']) !!}    
                                       
                                    </div>
                                </div>
                                
                                <div class="position-relative row form-group">
                                <label for="cat_description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-8">
                                    {!! Form::textarea("page_description", $page->description ?? old("page_description"), ['class'=> 'form-control', 'id' => "page_description", 'placeholder' => 'Enter description', 'rows' => '20']) !!}    

                                       
                                    </div>
                                </div>

                                <input type="hidden" name="page_name" id="page_name" value="{{$page->name ?? ''}}">
                                <input type="hidden" name="page_id" id="page_id" value="{{$page->id ?? ''}}">
                                <div class="d-block text-center card-footer">
                            <button type="submit" class="btn-wide btn btn-success" id="savePageBtn">Update</button>
                        </div>
                            </form>

                        </div>
                        
                        
                                    
                   

                  </div>

                </div>
            </div>

        </div>

    </div>
    <!-- @include('includes/footer') -->
  </div>

  

@endsection