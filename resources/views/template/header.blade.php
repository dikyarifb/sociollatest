<!DOCTYPE html>
<html>
<head>
	<title>Socilla Blog</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://getbootstrap.com/docs/4.0/examples/blog/blog.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
	<style type="text/css">
		.wysihtml5-command-active{
			color: #fff !important;
    		background-color: #343a40 !important;
		}
		#toolbar a{
			display: inline-block;
		    padding: .25em .4em;
		    font-size: 75%;
		    font-weight: 700;
		    line-height: 1;
		    text-align: center;
		    white-space: nowrap;
		    vertical-align: baseline;
		    border-radius: .25rem;
		    color: #212529;
		    background-color: #f8f9fa;
		    margin-bottom: 7px;
		}
		.error-message{
			font-size: 12px;
			color: darkred;
			margin-top: 4px;
		}
		.btn-modal{
			background-color: transparent;
			border: 0;
			cursor: pointer;
		}
	</style>
<body>

<div class="container">
	<header class="blog-header py-3">
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4 text-center">
				<a class="blog-header-logo text-dark" href="{{url('/')}}">Sociolla Blog</a>
			</div>
			<div class="col-4 text-right">
				<button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalCreate">
				   Create Post
				</button>
			</div>
		</div>
	</header>
	<div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex">
        	<a class="p-2 text-muted" href="{{url('/')}}">All</a>
        	@foreach($tags as $tag)
        		<a class="p-2 text-muted" href="{{url('?tags='.$tag->slug)}}">{{$tag->name}}</a>
        	@endforeach
        </nav>
    </div>

<!-- Modal create post -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-lg modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="POST" onsubmit="return validateForm()" name="form_post" action="{{url('/store')}}">
      		{{csrf_field()}}
        <div class="form-group">
        	<label for="title">Judul Post
        	<small class="form-text text-muted">*Hindari judul yang terlalu panjang</small></label>
        	<input type="text" class="form-control" name="title">
        	<span class="error-message" id="error-title"></span>
        </div>
        <div class="form-group">
        	<label for="author">Author Post
        	<small class="form-text text-muted">*Tuliskan nama penulis post</small></label>
        	<input type="text" class="form-control" name="author">
        	<span class="error-message" id="error-author"></span>
        </div>
        <div class="form-group">
        	<label for="featured">Featured Post
        	<small class="form-text text-muted">Check this box if you want to make post appear on top</small></label><br>
        	<input type="checkbox" name="featured" value="1">
        </div>
        <div class="form-group">
        	<label for="content">Content Post</label>
        	<div id="toolbar" style="display: none;">
			    <a data-wysihtml5-command="bold" title="CTRL+B">bold</a> |
			    <a data-wysihtml5-command="italic" title="CTRL+I">italic</a> |
			    <a data-wysihtml5-command="createLink">insert link</a> |
			
			    <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">h1</a> |
			    <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">h2</a> |
			    <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red">red</a> |
			    <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green">green</a> |
			    <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue">blue</a> |
			    <a data-wysihtml5-action="change_view">switch to html view</a>
			    
			    <div data-wysihtml5-dialog="createLink" style="display: none;">
			      <label>
			        Link:
			        <input data-wysihtml5-dialog-field="href" value="http://">
			      </label>
			      <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
			    </div>
			    
			    <div data-wysihtml5-dialog="insertImage" style="display: none;">
			      <label>
			        Image:
			        <input data-wysihtml5-dialog-field="src" value="http://">
			      </label>
			      <label>
			        Align:
			        <select data-wysihtml5-dialog-field="className">
			          <option value="">default</option>
			          <option value="wysiwyg-float-left">left</option>
			          <option value="wysiwyg-float-right">right</option>
			        </select>
			      </label>
			      <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
			    </div>
			    
			  </div>
			<textarea id="textarea" name='content' class="form-control" placeholder="Enter text ..."></textarea>
			<span class="error-message" id="error-content"></span>
        </div>
        <div class="form-group">
        	<label>Tags</label><br>
        	@foreach($tags as $tag)
        		<input type="checkbox" value="{{$tag->id}}" name="tags[]"> {{$tag->name}} <br>
        	@endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button></form>
      </div>
    </div>
  </div>
</div>

<script src="/js/advanced.js"></script>
<script src="/js/wysihtml5-0.4.0pre.min.js"></script>

<script>
	@if(session('message'))
	   $(document).ready(function(){
	    swal("{{session('message')}}", {
	      button: false,
	      icon: "{{session('status') ?? ''}}",
	      title: "{{session('title')}}"
	    });
	  });
	@endif

	 var editor = new wysihtml5.Editor("textarea", {
	    toolbar:        "toolbar",
	    stylesheets:    "css/stylesheet.css",
	    parserRules:    wysihtml5ParserRules
	  });

	 function validateForm() {
	 	var title = document.forms['form_post']['title'];
	 	var author = document.forms['form_post']['author'];
	 	var content = document.forms['form_post']['content'];

	 	if(title.value == '')
	 	{
	 		showError('error-title', "*title must contain at least 6 characters", title);
	 		return false;
	 	}else 
	 	if(title.value.length < 6)
	 	{
	 		showError('error-title', "*can't less than 6 characters", title);
	 		return false;
	 	}else
	 	if(author.value == '')
	 	{
	 		showError('error-author', "*author must contain at least 1 characters", author);
	 		return false;
	 	}
	 	if(content.value == '')
	 	{
	 		showError('error-content', "*content must contain at least 1 characters", content);
	 		return false;
	 	}
	 }

	 function showError(id, message, input){
	 	input.style.border = "1px solid darkred";
	 	$('#modalCreate').scrollTop($('#'+id).offset().top);
	 	$('#'+id).html(message);
	 }
</script>