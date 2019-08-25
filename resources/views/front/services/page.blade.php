@extends('front.base', ['pageName' => 'light'])

@section('content')
    <section class="pt6 mb5 services-banner">
        <h1 class="tc f2 mt1 col-p head0 pt5">Our Services</h1>
        <p class="f4 f3-ns mh4 mv5 tc pv5 measure-wide center-l lh-max">
            Our core services are centered around data-science, with emphasis on software development, NLP and machine learning research,  validation and predictive  analysis with reliance on custom visualization tools.
        </p>
    </section>
{{--    @include('front.partials.top-wave')--}}
    <section class="pv6">
        <div class="center col-mb-bg h4 w4 flex items-center justify-center br-100" data-usher>
            <p class="huge-type bold-type col-w">1.</p>
        </div>
        <h3 class="normal tc headf mt0 pt5" data-usher>Software Development</h3>
        <p class="f4 f3-ns mh4 mb5 tc measure-wide center-l lh-max">
            We offer software development and architecture as a service. We build software to your specification and have delivered two successful products to date.
        </p>
        @include('front.home.tech-logos')
    </section>
{{--    @include('front.partials.bottom-wave')--}}

    <section class="pv5">
        <div class="center col-mb-bg h4 w4 flex items-center justify-center br-100" data-usher>
            <p class="huge-type bold-type col-w">2.</p>
        </div>
        <h3 class="normal tc headf ph4 pt5" data-usher>Proprietary analysis services</h3>
        <p class="f4 f3-ns mh4 mb5 tc measure center-l lh-max">
            Our costume built tools perform data-gathering and classification, covering:
        </p>
{{--        <div class="flex flex-wrap justify-around mx8 center">--}}
            @foreach($service_points as $point)
             <div class="mb5 measure-wide center col-pb-bg" data-usher>
                 <p class="bold-type col-p ph4 pv4 col-pb-bg ttu">{{ $point['heading'] }}</p>
                 <p class="ph4 pt0 pb4 ma0 lh-title">{{ $point['content'] }}</p>

             </div>
            @endforeach
{{--        </div>--}}
    </section>
    <p class="f4 f3-ns mh4 mb5 tc measure center-l lh-max">
        Our services are expanding. Stay tuned.
    </p>


@endsection