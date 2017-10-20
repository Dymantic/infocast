@extends('front.base', ['pageName' => 'light'])

@section('content')
    <section class="pt6 mb5">
        <h1 class="tc f2 mt1 ttu col-r">Thank You {{ $name ?? '' }}</h1>
        <p class="f4 f3-ns col-p tc">We'll be in touch.</p>
    </section>
@endsection