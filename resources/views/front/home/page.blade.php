@extends('front.base', ['pageName' => 'dark home-page'])

@section('title')
    Infocast
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/infocast_facebook.jpg',
        'ogTitle' => 'Infocast',
        'ogDescription' => 'At Infocast, we offer value driven data analysis and processing, giving insight and guiding decision making.'
    ])
@endsection

@section('content')
    <section class="banner col-p-bg flex flex-column justify-center items-center">
        <img src="/images/logos/infocast_logo.svg"
             alt="Infocast logo"
             class="mw-90 db"
             width="500px">
        <p class="col-w f4 f3-ns tc mw-90">Data driven insight.</p>
    </section>
    <section class="pv6">
        <p class="f4 f3-ns mh4 mv0 measure-wide center-l tc lh-max">
            Information is everywhere, deriving value from it can be challenging — at Infocast, we offer value driven data analysis and processing, giving insight and guiding decision making.
        </p>
        {{--@include('front.partials.moving-squiggle', ['classNames' => 'center mt6'])--}}
        <img src="/images/squiggle_single.png"
             alt="page section divider"
             class="db center w3 mt6"
        >
    </section>
    <section>
        <h3 class="tc ttu headf normal">Meet the Team</h3>
        <div data-flickity='{"cellAlign": "left", "arrowShape": "M1.11,48.2,80.87.32a2.24,2.24,0,0,1,3.37,2V97.69a2.24,2.24,0,0,1-3.36,2L1.12,52.2A2.34,2.34,0,0,1,1.11,48.2Z", "contain": "true", "draggable": true}'
             class="w-90 w-80-ns mw8 center mv5 pb5 pt4">
            @foreach($team as $member)
                @include('front.home.team-member')
            @endforeach
        </div>
    </section>
    <section class="pv5 join-us mt5">
        <h3 class="normal tc ttu headf">Join Us</h3>
        <p class="lh-max f4 f3-ns mv5 measure-wide mh4 center-l tc tl-ns">
            We are a young, dynamic multi-cultural team looking for collaborative teammates! We offer competitive salaries in a non-traditional company setup, with an open-door policy & flexible working hours. If you have your initials embroidered on the sleeve of your fitted dress shirt, best move along (#sorry #notsorry)!
        </p>
        {{--@include('front.partials.moving-squiggle')--}}
        <img src="/images/squiggle_single.png"
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

@section('json-schema')
    <script type='application/ld+json'>
{
  "@context": "http://www.schema.org",
  "@type": "LocalBusiness",
  "name": "Infocast",
  "url": "https://infocast.tech",
  "logo": "https://infocast.tech/images/logos/logo.png",
  "description": "Infocast provides value driven data analysis and processing",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "105 台北市松山區南京東路四段183號五樓",
    "addressLocality": "Taipei City",
    "addressRegion": "Taipei",
    "postalCode": "105",
    "addressCountry": "Taiwan"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "25.0518344",
    "longitude": "121.5543061"
  },
  "openingHours": "Mo, Tu, We, Th, Fr 09:00-18:00",
  "telephone": "+886 287-707-912",
  "image": "https://infocast.tech/images/infocast_facebook.jpg"
  }
 </script>
@endsection