<section class="pb6 relative">
    @include('svg-decorations.wave_1', ['classes' => 'dn db-ns decoration d-right d-bottom-0 h3 mb4'])
    <h3 class="normal mt0 tc headf mb6">Available Positions</h3>
    @if($postings->count() > 0)
        <div class="mw8 jobs-grid center mt5">
            @foreach($postings as $posting)
                @include('front.home.job-card')
            @endforeach
        </div>
        <div class="tc mt5">
            <a class="text-link col-s hov-r" href="/careers">See all available positions</a>
        </div>
    @else
        <p class="f5 f4-ns measure-wide center-ns mh4 lh-copy">We don't have any positions available at the moment. If you really feel like you'd be a good fit on the team, feel free to get in touch and say hi. Who knows what the future holds?</p>
        <div class="tc mt5">
            <a class="f3 ttu col-p hov-r ba dib center-ns link col-s pv2 ph4 mh3" href="/contact">Get In Touch</a>
        </div>
    @endif
</section>