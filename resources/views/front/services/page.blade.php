@extends('front.base', ['pageName' => 'dark'])

@section('content')
    <section class="banner services-banner flex justify-center items-center">
        <h1 class="black-type huge-type col-w tc">How we can help.</h1>
    </section>
    <section class="mb5 relative decorated">
        <p class="f4 f3-ns mh4 mv5 tc pv5 measure-wide center-l lh-max">
            Our core services are centered around data-science, with emphasis on software development, and machine learning research, validation and predictive analysis with reliance on custom visualization tools.
        </p>
    </section>
    @include('front.partials.top-wave')
    <section class="pb4 pt4 relative col-pb-bg decorated">
        <div class="pv5 relative">
            <h3 class="normal tc headf mt0 pt5" data-usher>Software Development</h3>
            <p class="f4 f3-ns mh4 mb5 tc measure-wide center-l lh-max">
                We offer software development and architecture building software to your specifications.
            </p>
            <h3 class="normal tc headf ph4 pt5" data-usher>Proprietary analytic services</h3>
            <p class="f4 f3-ns mh4 mb5 tc measure center-l lh-max">
                Our custom built tools perform data-gathering and classification.
            </p>
        </div>
    </section>
    @include('front.partials.bottom-wave')

    <section class="pv5 mb6 relative decorated">
        <p class="f4 f3-ns mh4 tc measure center-l lh-max">
            Our services are expanding. Stay tuned.
        </p>
    </section>




@endsection