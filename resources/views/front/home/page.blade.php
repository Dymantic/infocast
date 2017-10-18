@extends('front.base')

@section('content')
    <section class="banner col-p-bg flex flex-column justify-center items-center">
        <img src="/images/logos/infocast_logo.svg"
             alt="Infocast logo"
             width="500px">
        <p class="col-w f3">The cherry on top of the cake you can eat.</p>
    </section>
    <section class="pv5">
        <p class="f3 measure-wide center tc lh-copy">
            This is a paragraph about what we do. It is only a few lines. Short
            and punchy. Lorem ipsum dolor sit amet, consectetur adipisicing
            elit, sed do eiusmod tempor incididunt ut labore.
        </p>
        <img src="/images/squiggle.png"
             alt="page section divider"
             class="db center w4 mt5"
        >
    </section>
    <section>
        <h3 class="tc ttu f2 normal">Meet the Team</h3>
        <div data-flickity='{"groupCells": "true", "cellAlign": "left"}'
             class="mw8 center mv5 pb5">
            @foreach(range(1,7) as $item)
                @include('front.home.team-member')
            @endforeach
        </div>
    </section>
    <section class="pv5 join-us mt5">
        <h3 class="normal tc ttu f2">Join Us</h3>
        <p class="lh-copy f3 measure-wide center">
            We’re a super awesome company for the following reasons.
            Just a few quick reasons about how awesome we are,
            nothing too tedious or long. This paragraph should not be
            more than three or four lines long.
        </p>
        <img src="/images/squiggle.png"
             alt="page section divider"
             class="db center w4 mt5"
        >
    </section>
    <section class="pv5">
        <h3 class="normal tc ttu f2">Available Positions</h3>
        <div class="mw8 flex flex-wrap justify-between center mt5">
            @foreach($postings as $posting)
                @include('front.home.job-card')
            @endforeach
        </div>
        <div class="tc mt4">
            <a class="f3 ttu col-p ba dib center link col-s pv2 ph4" href="/careers">See all available positions</a>
        </div>
    </section>
@endsection