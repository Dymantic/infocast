@extends('front.base', ['pageName' => 'careers-page dark'])

@section('content')
    <section class="banner flex justify-center items-center">
        <p class="col-r f-headline-ns f1 tc bold-type">Join the party.</p>
    </section>
    <section class="pv5">
        <p class="tc f3 f2-ns">These positions are available now.</p>
    </section>
    <section>
        <div class="mw8 flex flex-wrap justify-between center mt5">
            @foreach($postings as $posting)
                @include('front.home.job-card')
            @endforeach
        </div>
    </section>
@endsection