@extends('layouts.frontend_layout')

@section('page_title')
{{ $gallery->title }}
@endsection

@section('stylesheet')
<style>
    .gallery-single{
        padding: 2rem 0rem;
    }
    .auth_date{
        display:flex;
        padding: 2rem 0rem;
    }
    #date{
        margin-left: 40px;
    }

</style>
@endsection


@section('content')
    <div class="gallery-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="post_details">
                        <div class="post_content">
                            <div class="row">
                                <div class="col-md-3">
                                    {{-- // --}}
                                </div>
                                <div class="col-md-6 text-justify">
                                    <img src="{{ asset($gallery->thumb_img) }}" width="100%" height="300px" alt="">
                                    <h1>{{ $gallery->title }}</h1>
                                    <div class="auth_date">
                                        <p>Posted by: <i>{{ $gallery->author }}</i></p>
                                        <p id="date">{{ date('F d, Y', strtotime($gallery->created_at)) }}</p>
                                    </div>
                                    <p>{!! $gallery->body !!}</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection

