@extends('front.base', ['pageName' => 'light'])

@section('content')
    <div class="pv5">
        <p class="tc bold-type f5 b mb3">Job Title:</p>
        <p class="tc f2 mt1 ttu">{{ $posting->title }}</p>
    </div>
    <application-form :field-requirements='@json($posting->applicationFields())' url="/postings/{{ $posting->id }}/applications" button-text="" :posting-id="{{ $posting->id }}"></application-form>
@endsection