<html>
<head>
  <title>投稿一覧</title>
  @viteReactRefresh
     @vite(['resources/sass/app.scss', 'resources/js/app.js'])
     <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3 text-right">
         
        </div>
  <h1>投稿一覧</h1>


<div class="admin-userall" style="background-image:url(../images/haikei2.jpg)">
  
@foreach($contents as $content) 

<div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                           
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $content->user->name }}</p>  
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                            <form style="display: inline-block;" method="POST"
                               action="{{ route('admin.destroy', $content->content_id) }}"> 
                                @csrf
                                @method('DELETE')
                                <button class="btn">削除する</button>
                            </form>
                            </div>
                        </div>
                        <div class="card-body">
                        <a href="{{ route('content.show', $content->content_id) }}">
                            {!! nl2br(e($content->title)) !!}</a>
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                       
                        <div class="pull-left">
                        {{ $content->created_at->format('Y.m.d') }} 
                        </div>
                        @auth
                        @if (!$content->isLikedBy(Auth::user()))
                         <span class="likes">
                         <i class="fa-solid fa-heart like-toggle" data-review-id="{{ $content->content_id }}"></i>
                         <span class="like-counter">{{count($content->likes)}}</span>
                          </span><!-- /.likes -->
                        @else
                         <span class="likes">
                         <i class="fa-solid fa-heart like-toggle liked" data-review-id="{{ $content->content_id }}"></i>
                         <span class="like-counter">{{count($content->likes)}}</span>
                         </span><!-- /.likes -->
                        @endif
                        @endauth
                        @guest
                         <span class="likes">
                        <i class="fa-solid fa-heart"></i>
                          <span class="like-counter">{{ count($content->likes)}}</span>
                         </span><!-- /.likes -->
                         @endguest

                        
                            <div class="d-flex align-items-center">
                            {{--   <button type="" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>--}}
                              {{--  <p class="mb-0 text-secondary">{{ count($content->favorites) }}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
          
</div>
<button class="rounded-md" onClick="history.back();">戻る</button>

  </body>
</html>