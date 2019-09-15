@extends('front.base', ['pageName' => 'dark'])

@section('content')
    <section class="banner services-banner flex justify-center items-center">
        <h1 class="black-type huge-type col-w">Our toolbox.</h1>
    </section>
    <section class="mb5 relative">
        @include('svg-decorations.stripe_deco', ['classes' => 'db db-l decoration d-right d-top-10 h3 col-pr'])
        <p class="f4 f3-ns mh4 mv5 tc pv5 measure-wide center-l lh-max">
            Our core services are centered around data-science, with emphasis on software development, NLP and machine learning research,  validation and predictive  analysis with reliance on custom visualization tools.
        </p>
    </section>
    <section class="pb4 pt4 relative dotted-wave-right-bg">
        <div class="pv5 relative">
            @include('svg-decorations.dots_deco', ['classes' => 'db db-l decoration d-left d-bottom-10 h3 col-w'])
            <h3 class="normal tc headf mt0 pt5" data-usher>Software Development</h3>
            <p class="f4 f3-ns mh4 mb5 tc measure-wide center-l lh-max">
                We offer software development and architecture as a service. We build software to your specification.
            </p>
            <h3 class="normal tc headf ph4 pt5" data-usher>Proprietary analytic services</h3>
            <p class="f4 f3-ns mh4 mb5 tc measure center-l lh-max">
                Our custom built tools perform data-gathering and classification.
            </p>
        </div>

    </section>

    <section class="pv5 mb6 relative">
        @include('svg-decorations.crosses_deco', ['classes' => 'db db-l decoration d-right d-bottom-10 h3 col-pb'])
        <p class="f4 f3-ns mh4 tc measure center-l lh-max">
            Our services are expanding. Stay tuned.
        </p>
    </section>




@endsection