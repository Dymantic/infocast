@extends('front.base', ['pageName' => 'light'])

@section('title')
    {{ $posting->title }} at Infocast
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogImage' => '/images/infocast_facebook.jpg',
        'ogTitle' => $posting->title,
        'ogDescription' => $posting->introduction
    ])
@endsection

@section('content')
    <section class="pv5">
        <p class="tc bold-type f5 b mb3">Job Title:</p>
        <p class="tc f2 mt1 ttu">{{ $posting->title }}</p>
    </section>
    <section class="mw7 mh3 center-ns pb5">
        <div>
            @if($posting->type)
                <p class="f5"><span class="bold-type">Type:</span> {{ $posting->type }}</p>
            @endif
            @if($posting->category)
                <p class="f5"><span class="bold-type">Category:</span> {{ $posting->category }}</p>
            @endif
            @if($posting->location)
                <p class="f5"><span class="bold-type">Location:</span> {{ $posting->location }}</p>
            @endif
            @if($posting->compensation)
                <p class="f5"><span class="bold-type">Compensation:</span> {{ $posting->compensation }}</p>
            @endif
            @if($posting->posted)
                <p class="f5"><span class="bold-type">Posted:</span> {{ $posting->posted->toFormattedDateString() }}</p>
            @endif
        </div>
        @if($posting->job_description)
        <div class="mt4">
            <p class="bold-type">Job Description</p>
            <div class="lh-copy">@markdown($posting->job_description)</div>
        </div>
        @endif
        @if($posting->responsibilities)
        <div class="mt4">
            <p class="bold-type">Responsibilities</p>
            <div class="lh-copy">@markdown($posting->responsibilities)</div>
        </div>
        @endif
        @if($posting->requirements)
        <div class="mt4">
            <p class="bold-type">Requirements</p>
            <div class="lh-copy">@markdown($posting->requirements)</div>
        </div>
        @endif
        <div class="flex flex-column items-center mv5">
            <a class="f3 ttu col-p ba dib center link col-s pv2 ph4" href="/postings/{{ $posting->id }}/application">Apply for this job</a>
            <a class="link col-p mt4" href="#">&larr; Back to job listings</a>
        </div>
    </section>
@endsection