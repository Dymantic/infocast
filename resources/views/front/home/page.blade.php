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
    @include('front.home.banner')
    @include('front.home.about')
    @include('front.home.services')
    @include('front.home.join-us')
{{--    @include('front.home.available-positions')--}}
{{--    @include('front.home.tech-logos')--}}
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