@extends('layouts.app')

@section('content')
  <section id="post" class="padding-top padding-set">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-7">
        <div class="post_item padding-bottom non-border-bottom">
           <h2>{{$post->title}} </h2>
           <ul class="comments">
             <li><a href="#.">{{$post->created_at_format}}</a></li>
           </ul>
          <p>{{$post->description}}</p>
          <p><em>@{{numberOfComent}}</em></p>
          

          
          <h2>Comment</h2>
          @if(auth()->check())
          <form class="form-horizontal" id="reply-form" method="post" style="margin-left: 20px;" @submit.prevent="createComment">
            
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <textarea placeholder="Message" name="comment" class="form-control" v-model="commentBox"></textarea>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Comment</button>
                </div>
              </div>
            </div>
          </form>
          @else

          @endif

          <div class="media-list">
              <div class="media blog-reply" v-for="comment in comments">
            <!-- <div class="media-left">
              <a href="#.">
                <img alt="Bianca Reid" src="#">
              </a>
            </div> -->
              <div class="media-body">
                  <h4>@{{comment.user.name}}</h4>
                  <span>@{{comment.created_at}}</span>
                  <p class="no-margin">@{{comment.comment}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script-content')
<script type="text/javascript">

     new Vue({
      el: "#post",
      data : {
        comments : {},
        user :  {!! auth()->check() == true ? auth()->user()->toJson() : 'null' !!},
        commentBox: '',
        post : {!!$post->toJson()!!},
        numberOfComent: '0 comments'
      },

      mounted(){
        this.getComments();
        this.listen();
      },
      methods: {
        getComments(){
            axios.get(`/post/${this.post.id}/comments`)
                  .then(response => {
                    this.comments = response.data;
                    console.log(this.comments);
                    this.numberOfComent = this.comments.length === 1 ? '1 Comment' : this.comments.length+' Comments';
                  }).catch(error => {
                      console.log(error);
                  });
        },

        createComment(){
          if(this.commentBox.length >= 2){
            axios.post(`/comment/${this.post.id}/create`,{comment : this.commentBox})
                .then(response => {
            this.comments.unshift(response.data);
            this.numberOfComent = this.comments.length === 1 ? '1 Comment' : this.comments.length+' Comments';
            this.commentBox = '';
          }).catch(error => {
            console.log(error);
          })
          }
        },
        listen(){
            Echo.channel('post.'+this.post.id)
                .listen('WebsocketEvent',(comment) => {
                  this.comments.unshift(comment);
                  this.numberOfComent = this.comments.length === 1 ? '1 Comment' : this.comments.length+' Comments';
                });
        }
      }
      
    })
</script>
@endsection