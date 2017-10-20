@extends('front.base', ['pageName' => 'light'])

@section('content')
    <section class="pt6 mb5">
        <h1 class="tc f2 mt1 ttu">Contact Us</h1>
        <p class="f4 f3-ns col-p tc">Get in touch with us, we'd love to hear from you.</p>
    </section>
    <contact-form url="/contact" button-text=""></contact-form>
@endsection