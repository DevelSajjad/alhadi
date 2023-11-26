@extends('layouts.frontend_layout')

@section('page_title','Gallery')

@section('stylesheet')
<style>
    .gallery-area{
        margin: 4rem 0rem;
    }
    .gallery-card{
        background: #ffff;
        overflow:hidden;
        box-shadow: .5rem .5rem 1rem #ddd;
    }
    .mt-4{
        margin-top: 4rem;
    }
    .mb-4{
        margin-bottom:2rem;
    }
    .card-body,.auth-date{
        padding: .5rem 2rem;
    }
    .card-title{
        padding-bottom: 1rem;
    }
    .auth-date{
        font-size: 12px;
        color: rgba(0, 0, 0, 0.364)
    }
    .auth-date span{
        float: right;
    }
    .img-wrapper{
        overflow:hidden;
    }
    .img-wrapper img{
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: .4s all ease-in-out;
    }
    .img-wrapper img:hover{
        transform:scale(1.1);
    }
</style>
@endsection

@section('content')
    <div class="gallery-area">
        <div class="container">
            <h1 class="text-center">Gallery</h1>
            <div class="row mt-4">
                @foreach ($galleries as $item)
                <a href="{{ route('gallery.show',$item->id) }}" class="mb-4">
                    <div class="col-md-4" style="margin-bottom:3.2rem">
                        <div class="card gallery-card ">
                            <div class="img-wrapper">
                                <img class="card-img-top" width="100%" src="{{ asset($item->thumb_img) }}" alt="Card image">
                            </div>
                            <div class="auth-date">
                                <i>{{ $item->author }}</i><span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{ (strlen($item->title) > 30) ? substr($item->title, 0, 30)."..." : $item->title }}</h4>
                                <!--<p class="card-text">{!! (strlen($item->body) > 100) ? substr($item->body, 0, 100)."..." : $item->body !!}</p>-->
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection

