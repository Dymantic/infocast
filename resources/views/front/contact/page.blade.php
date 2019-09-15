@extends('front.base', ['pageName' => 'contact-page dark'])

@section('title')
    Contact Us
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/infocast_facebook.jpg',
        'ogTitle' => 'Contact us at Infocast',
        'ogDescription' => 'Reach out and get in touch. We are always willing to get in contact with clients, potential hires or whoever.'
    ])
@endsection

@section('content')
    <section class="pt6 mb5">
        <h1 class="tc f2 mt1 ttu">Contact Us</h1>
        <p class="f4 f3-ns col-p tc">Get in touch with us, we'd love to hear from you.</p>
    </section>
    <contact-form class="mb6 pb5" url="/contact" button-text=""></contact-form>
@endsection