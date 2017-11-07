@extends('front.base', ['pageName' => 'dark home-page'])

@section('title')
    Infocast
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/infocast_facebook.jpg',
        'ogTitle' => 'Infocast',
        'ogDescription' => ''
    ])
@endsection

@section('content')
    <section class="banner col-p-bg flex flex-column justify-center items-center">
        <img src="/images/logos/infocast_logo.svg"
             alt="Infocast logo"
             class="mw-90 db"
             width="500px">
        {{--<p class="col-w f4 f3-ns tc mw-90">The cherry on top of the cake you can eat.</p>--}}
    </section>
    <section class="pv6">
        <p class="f4 f3-ns mh4 mv0 measure-wide center-l tc lh-max">
            Information is everywhere, deriving value from it can be challenging — at Infocast, we offer value driven data analysis and processing, offering insight and guiding decision making.
        </p>
        {{--@include('front.partials.moving-squiggle', ['classNames' => 'center mt6'])--}}
        <img src="/images/squiggle.png"
             alt="page section divider"
             class="db center w3 mt6"
        >
    </section>
    <section>
        <h3 class="tc ttu headf normal">Meet the Team</h3>
        <div data-flickity='{"cellAlign": "left", "arrowShape": "M1.11,48.2,80.87.32a2.24,2.24,0,0,1,3.37,2V97.69a2.24,2.24,0,0,1-3.36,2L1.12,52.2A2.34,2.34,0,0,1,1.11,48.2Z", "contain": "true", "draggable": true}'
             class="w-90 w-80-ns mw8 center mv5 pb5 pt4">
            @foreach(range(1,7) as $item)
                @include('front.home.team-member')
            @endforeach
        </div>
    </section>
    <section class="pv5 join-us mt5">
        <h3 class="normal tc ttu headf">Join Us</h3>
        <p class="lh-max f4 f3-ns mv5 measure-wide mh4 center-l tc tl-ns">
            We’re a super awesome company for the following reasons.
            Just a few quick reasons about how awesome we are,
            nothing too tedious or long. This paragraph should not be
            more than three or four lines long.
        </p>
        {{--@include('front.partials.moving-squiggle')--}}
        <img src="/images/squiggle.png"
             alt="page section divider"
             class="db center w3 mt5"
        >
    </section>
    <section class="pv6">
        <h3 class="normal mt0 tc ttu headf">Available Positions</h3>
        <div class="mw8 flex flex-wrap justify-between center mt5">
            @foreach($postings as $posting)
                @include('front.home.job-card')
            @endforeach
        </div>
        <div class="tc mt5">
            <a class="f3 ttu col-p hov-r ba dib center-ns link col-s pv2 ph4 mh3" href="/careers">See all available positions</a>
        </div>
    </section>
@endsection