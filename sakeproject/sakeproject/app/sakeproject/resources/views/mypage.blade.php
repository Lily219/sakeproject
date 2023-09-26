<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{asset('/css/mypage.css')}}" rel="stylesheet">
        <script src="{{ asset('/js/mypage.js') }}"></script>
      
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <script src="{{ asset('/js/like.js') }}"></script>
    </head>
    <body class="antialiased">
    @extends('layouts.app')
    @section('content')
    <div class="container" style="background-image:url(../images/haikei2.jpg)">
    <div class="container-2 row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ ('My page') }}</div>

            <div class="card-body">
              <div class='name-tag'>
                {{ \Auth::user()->name }}
                </div>

                <div class="tab-panel">
  <!--タブ-->
  <ul class="tab-group">
    <li class="tab tab-A is-active">P O S T</li>
    <li class="tab tab-B">L I K E</li> 
 </ul>
  
  <!--タブを切り替えて表示するコンテンツ-->
  
    <div class="panel tab-A is-show">
    <div class='content-tag'>
                @if (isset($contents))
                @foreach ($contents as $content)
                <div class="body-panel col-md-8 mb-3">
                    <div class="card">
                        @if ($content->user_id = Auth::id())
                        <div class="card-haeder p-3 w-100 d-flex">
                           
                        <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $content->user->name }}</p>  
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                         {{--  @if ($user->id == $content->user_id)--}}
                            <div class="mb-4 text-right" style="margin-top:10px">
                                <a href="{{ route('content.edit', $content->content_id) }}" class="btn">_edit</a>
                            <form style="display: inline-block;" method="POST" action="{{ route('content.destroy', $content->content_id) }}"> 
                                @csrf
                                @method('DELETE')
                                <button class="btn">_delete</button>
                            </form>
                            </div>
                          {{--  @endif--}}
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
                          </div>
                          @endif
                       </div>
                    </div>
                    @endforeach 
                @endif
            </div>
            
            </div>
            
               
    <!-- タブB -->
    <div class="panel tab-B">
    
    <div class='content-tag'>
    @if (isset($likes))
            @foreach ($likes as $like)
                <div class="body-panel col-md-8 mb-3">
                    <div class="card">
                    @if ($like->content_id = $content->content_id)
                        <div class="card-haeder p-3 w-100 d-flex">
                        <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $content->user->name }}</p>  
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                           @if (Auth::id() == $content->user_id)
                            <div class="mb-4 text-right" style="margin-top:10px">
                                <a href="{{ route('content.edit', $content->content_id) }}" class="btn">_edit</a>
                            <form style="display: inline-block;" method="POST" action="{{ route('content.destroy', $content->content_id) }}"> 
                                @csrf
                                @method('DELETE')
                                <button class="btn">_delete</button>
                            </form>
                            </div>
                            @endif 
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
                          </div>
                        @endif
                       </div>
                    </div>
                    @endforeach 
                @endif
            </div>
           

    </div>
    
  </div>  
         <!-- タブ表示end -->
            </div> 
             
            </div>
            

                
                </div>
            </div>
        </div>



@endsection
</body>
</html>