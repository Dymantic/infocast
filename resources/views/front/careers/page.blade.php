@extends('front.base', ['pageName' => 'careers-page dark'])

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
        <p class="huge-type black-type col-w tc">Join the party.</p>
    </section>
    <section class="pv5">
        @if($postings->count() > 0)
            <p class="tc headf lh-max ph4">These positions are available now.</p>
        @else
            <p class="tc f4 f3-ns mw7 lh-max center-ns">
                We currently don't have any positions available. Feel free to get in
                touch or revisit this page again to check if positions become
                available. Thanks.
            </p>
        @endif
    </section>
    <section class="pb6">
        <div class="mw8 jobs-grid center">
            @foreach($postings as $posting)
                @include('front.home.job-card')
            @endforeach
        </div>
    </section>
    <section class="pv5 mb6">
        <p class="tc headf lh-max ph4">Can't find any position of your interest?</p>
            <p class="tc f4 f3-ns ph4 mw7 lh-max center-ns">Send us your resume to <a href="mailto:hr@infocast.tech" class="col-s hov-r">hr@infocast.tech</a>  and tell us how you think you can help Infocast to improve our service or as a company. We will contact you if a suitable position becomes available.
            </p>
    </section>
@endsection