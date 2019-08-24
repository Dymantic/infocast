@extends('front.base', ['pageName' => 'light'])

@section('content')
    <section class="pv6 about-banner">
        <h3 class="normal tc head0 mt0">A brief history of time</h3>
        <p class="f4 f3-ns tc mh4 mb3 measure-wide center-l lh-max">
            Infocast started as a services company offering software development and technical solutions focusing on data gathering, analysis and automation. As we evolved, together with our team, collaborators, and clients,  we  developed reliable and scalable software, and analytic tools with usability and efficiency in mind. Our central focus is to provide ease of use tools and on demand data-gathering processes that lead to dynamic analysis  covering  automation, classification, image/text processing,  link-analysis,  and visualization.
        </p>
    </section>
{{--    <section>--}}
{{--        <h3 class="tc ttu headf normal">Meet the Team</h3>--}}
{{--        <div data-flickity='{"cellAlign": "left", "arrowShape": "M1.11,48.2,80.87.32a2.24,2.24,0,0,1,3.37,2V97.69a2.24,2.24,0,0,1-3.36,2L1.12,52.2A2.34,2.34,0,0,1,1.11,48.2Z", "contain": "true", "draggable": true, "groupCells": "80%"}' class="w-90 w-80-ns mw8 center mv5 pb5 pt4">--}}
{{--            @foreach($team as $member)--}}
{{--                @include('front.home.team-member')--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </section>--}}
    <section>
        <h3 class="tc head0 normal">Meet the team</h3>
        <div class="w-90 w-80-ns mw8 center mv5 pb5 pt4 flex flex-wrap justify-around">
            @foreach($team as $member)
                @include('front.home.team-member')
            @endforeach
        </div>
    </section>

@endsection