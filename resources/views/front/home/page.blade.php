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
        <img src="/images/logos/logo_slogan.svg"
             alt="Infocast logo"
             class="mw-90 db"
             width="500px">
        {{--<p class="col-w f4 f3-ns tc mw-90">Data driven insight.</p>--}}
    </section>
    <section class="pv6">
        <p class="f4 f3-ns mh4 mv0 measure-wide center-l tc lh-max">
            Information is everywhere, but deriving value from it can be challenging. At Infocast, through our unique tools and services, we offer value driven data analysis and processing, providing insight and guidance to take your decision making to the next level.
        </p>
        <div class="tc mv4"><a href="/about">About Us</a></div>
        {{--@include('front.partials.moving-squiggle', ['classNames' => 'center mt6'])--}}
        <img src="/images/squiggle_single.png"
             alt="page section divider"
             class="db center w3 mt6"
        >
    </section>
    <section class="pb6">
        <h3 class="normal tc ttu headf">What we Offer</h3>
        <p class="f4 f3-ns mh4 mv0 measure-wide center-l tc lh-max">
            We are a modern software boutique, and have a wide range of specialized software skills and knowledge. Our services can be split into software development and architecture as a service, and information analysis using our custom built tools.
        </p>
        <div class="tc mv4"><a href="/services">Our Services</a></div>
    </section>
    <section class="pv5 join-us mt5">
        <h3 class="normal tc ttu headf">Join Us</h3>
        <p class="lh-max f4 f3-ns mv5 measure-wide mh4 center-l tc">
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
        @if($postings->count() > 0)
        <div class="mw8 flex flex-wrap justify-between center mt5">
            @foreach($postings as $posting)
                @include('front.home.job-card')
            @endforeach
        </div>
        <div class="tc mt5">
            <a class="f3 ttu col-p hov-r ba dib center-ns link col-s pv2 ph4 mh3" href="/careers">See all available positions</a>
        </div>
        @else
            <p class="f5 f4-ns measure-wide center-ns mh4 lh-copy">We don't have any positions available at the moment. If you really feel like you'd be a good fit on the team, feel free to get in touch and say hi. Who knows what the future holds?</p>
            <div class="tc mt5">
                <a class="f3 ttu col-p hov-r ba dib center-ns link col-s pv2 ph4 mh3" href="/contact">Get In Touch</a>
            </div>
        @endif
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
    "streetAddress": "台北市中山區長安東路二段110號2樓",
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
  "telephone": "+886 225-063-857",
  "image": "https://infocast.tech/images/infocast_facebook.jpg"
  }
 </script>
@endsection