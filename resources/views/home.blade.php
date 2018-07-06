@extends('layouts.master')

@section('content')

<div class="content">
    @if(!!$featured_post)

    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic">{{$featured_post->title}}</h1>
          {{ substr(strip_tags($featured_post->content), 0, 500) }}
          <button type="button" data-toggle="modal" data-target="#modalContent" class="btn-modal text-white font-weight-bold" onclick="showModalContent({{$featured_post->id}})">Continue reading...</button>
        </div>
    </div>

    @endif

    @if(!!$posts)
      <div class="row mb-2">
        @foreach($posts as $post)
          <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
              <div class="card-body d-flex flex-column align-items-start">
                <strong class="d-inline-block mb-2 text-primary">{{ !!$post->tags->first() ? $post->tags->first()->name : '' }}</strong>
                <h3 class="mb-0">
                  <a class="text-dark" href="#">{{$post->title}}</a>
                </h3>
                <div class="mb-1 text-muted">{{ date("F d", strtotime($post->created_at)) }}</div>
                <p class="card-text mb-auto">{{ substr(strip_tags($post->content), 0, 91) }}...</p>
                <button type="button" data-toggle="modal" data-target="#modalContent" class="btn-modal text-muted font-weight-bold" onclick="showModalContent({{$post->id}})">Continue reading...</button>
              </div>
            </div>
          </div>

        @endforeach
      </div>
      @endif
      
      @if(count($posts) == 0)
    <div class="row my-4">
      <div class="col-12">
        <center>
          <h2 class="text-muted">No More Post to Show..</h2>
        </center>
      </div>
        
    </div>
    @endif
</div>

<div class="modal fade" id="modalContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-lg modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="modal-body-post">
        <div class="col-md-8 blog-main">
          <div class="blog-post">
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  
  function showModalContent(idPost)
  {

    var url = "/ajax/getcontentpost?id=" + idPost;

    $.get(url, function(data) {

      if(data)
      {
        $('#information-detail').html('');

        var div = '';

        div += '<h2 class="blog-post-title">'+ data.title +'</h2>';
        div += '<p class="blog-post-meta">'+ data.created_at +' by <a href="#">' + data.author +'</a></p>';
        div += data.content;

        $('#modal-body-post .blog-main .blog-post').html(div);

        console.log(data);

      }else{

        console.log('error');

      }
    });
  }

</script>

@endsection
