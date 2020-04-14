@extends('front.layouts.front-template')

@section('mainContainer')

<div class="banner-top">
	<div class="container">
		<h1>About</h1>
		<em></em>
		<h2><a href="{{url('/index')}}">Home</a><label>/</label>About</h2>
	</div>
</div>

<div class="contact">
					
    <div class="contact-form">
        <div class="container">
            <div class="col-md-6 contact-left">
           
                <h3>{{$page->name}}</h3>
                <p>{{$page->description}}</p>
            
    
					
            </div>
				
		    <div class="clearfix"></div>
		</div>
    </div>
		
</div>
 

@endsection