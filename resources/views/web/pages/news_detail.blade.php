@extends('web.layout.index')
@section('css')
    .image img{
        width: 100%;
    }
@endsection
@section('content')
    <section class="container-lg">
        {{--  Breadcrumb  --}}
        <nav aria-label="breadcrumb mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="link link-dark text-decoration-none">@lang('lang.home')</a></li>
                <li class="breadcrumb-item"><a href="#" class="link link-dark text-decoration-none">@lang('lang.events')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{!! $news['title'] !!}</li>
            </ol>
        </nav>
        {{--  Event title  --}}
        <div class="row container">
            <h2 class="mt-4">{!! $news['title'] !!}</h2>
            <div class="text-center">
                @if(strstr($news['image'],"https") == "")
                    <img style="width: 75%" class="card-img-top rounded-0" alt='...'
                         src="https://res.cloudinary.com/{!! $cloud_name !!}/image/upload/{!! $news['image'] !!}.jpg">
                @else
                    <img style="width: 75%" class="card-img-top rounded-0" alt='...'
                         src="{!! $news['image'] !!}">
                @endif
            </div>
            <div class="accordion-item">
                <div class="accordion-body mt-4 mb-3 w-100">
                    {!! $news['content'] !!}
                </div>
            </div>

        </div>
        <div class="row container">
            <h5 class="mt-4">@lang('lang.other_news')</h5>
            @foreach($news_all as $value)
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-4 border-warning rounded-0">
                        <a href="/news-detail/{!! $value['id'] !!}">
                            @if(strstr($value['image'],"https") == "")
                                <img class="card-img-top rounded-0" alt='...'
                                     src="https://res.cloudinary.com/{!! $cloud_name !!}/image/upload/{!! $value['image'] !!}.jpg">
                            @else
                                <img class="card-img-top rounded-0" alt='...'
                                     src="{!! $value['image'] !!}">
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

