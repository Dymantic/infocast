@extends('front.base', ['pageName' => 'careers-page light'])

@section('title')
    We're Hiring! Join us at Infocast
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/infocast_facebook.jpg',
        'ogTitle' => 'Careers at Infocast',
        'ogDescription' => ''
    ])
@endsection

@section('content')
    <section class="banner flex justify-center items-center">
        <p class="col-r f-headline-ns f1 tc bold-type tracked-tight">Join the party.</p>
    </section>
    <section class="pv5">
        @if($postings->count() > 0)
            <p class="tc headf lh-max">These positions are available now.</p>
        @else
            <p class="tc f4 f3-ns mw7 lh-max center-ns">
                We currently don't have any positions available. Feel free to get in
                touch or revisit this page again to check if positions become
                available. Thanks.
            </p>
        @endif
    </section>
    <section class="pb6">
        <div class="mw8 flex flex-wrap justify-between center mt5">
            @foreach($postings as $posting)
                @include('front.home.job-card')
            @endforeach
        </div>
    </section>
@endsection