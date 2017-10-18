@extends('front.base')

@section('content')
    <section class="pv5">
        <p class="tc bold-type f5 b mb3">Job Title:</p>
        <p class="tc f2 mt1 ttu">{{ $posting->title }}</p>
    </section>
    <section class="mw7 center pb5">
        <div>
            <p class="f5"><span class="bold-type">Type:</span> {{ $posting->type }}</p>
            <p class="f5"><span class="bold-type">Category:</span> {{ $posting->category }}</p>
            <p class="f5"><span class="bold-type">Location:</span> {{ $posting->location }}</p>
            <p class="f5"><span class="bold-type">Compensation:</span> {{ $posting->compensation }}</p>
            <p class="f5"><span class="bold-type">Posted:</span> {{ $posting->posted->toFormattedDateString() }}</p>
        </div>
        <div class="mt4">
            <p class="bold-type">Job Description</p>
            <p class="lh-copy">{{ $posting->job_description }}</p>
        </div>
        <div class="mt4">
            <p class="bold-type">Responsibilities</p>
            <p class="lh-copy">{{ $posting->responsibilities }}</p>
        </div>
        <div class="mt4">
            <p class="bold-type">Requirements</p>
            {{--<ul class="list pl0 lh-copy">--}}
                {{--<li>At least 2 years’ experience as a Quality Assurance Engineer.</li>--}}
                {{--<li>Experience testing web application and API.</li>--}}
                {{--<li>Experience with QA testing and automation tools.</li>--}}
                {{--<li>Experience with web development environment and bug tracking tools.</li>--}}
                {{--<li>Experience with CI system.</li>--}}
                {{--<li>Attention to detail.</li>--}}
                {{--<li>Excellent problem-solving skills.</li>--}}
                {{--<li>Ability to communicate technical issues to non-technical individuals.</li>--}}
                {{--<li>Fluent English and Chinese communication skills.</li>--}}
                {{--<li>Salary is negotiable upon experience.</li>--}}
            {{--</ul>--}}
            {{ $posting->requirements }}
        </div>
        <div class="flex flex-column items-center mv5">
            <a class="f3 ttu col-p ba dib center link col-s pv2 ph4" href="/postings/{{ $posting->id }}/application">Apply for this job</a>
            <a class="link col-p mt4" href="#">&larr; Back to job listings</a>
        </div>
    </section>
@endsection