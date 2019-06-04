@extends('front.base', ['pageName' => 'light'])

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
    <contact-form url="/contact" button-text=""></contact-form>
    <section class="flex-ns justify-between mv5 pt3 bt b--black-30 mw7 mh4 center-ns">
        <div class="w-50-ns br-ns b--black-30 pt4">
            <p class="ttu col-p bold-type mb1">Location</p>
            <p class="col-midgr f5 bold-type mt0">台北市中山區長安東路二段110號2樓</p>
            <p class="col-midgr f5 bold-type mt0">2F, No 110, Sec.2 Chang An E. Road, <br/> Zhongshan Dist, Taipei</p>
        </div>
        <div class="w-50-ns pl4-ns pt4">
            <p class="ttu col-p bold-type mb1">Tel</p>
            <p class="col-midgr f5 bold-type mt0">886 2 2506 3857</p>
        </div>
    </section>
@endsection