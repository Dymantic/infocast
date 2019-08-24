@extends('front.base', ['pageName' => 'light'])

@section('content')
    <section class="pt6 mb5 services-banner">
        <h1 class="tc f2 mt1 col-p head0 pt5">Our Services</h1>
        <p class="f4 f3-ns mh4 mv5 tc pv5 measure-wide center-l lh-max">
            Our core services are centered around data-science, with emphasis on software development, NLP and machine learning research,  validation and predictive  analysis with reliance on custom visualization tools.
        </p>
    </section>
    @include('front.partials.top-wave')
    <section class="pb6 col-pb-bg">
        <h3 class="normal tc headf mt0 pt5">Software Development</h3>
        <p class="f4 f3-ns mh4 mb5 tc measure-wide center-l lh-max">
            We offer software development and architecture as a service. We build software to your specification and have delivered two successful products to date.
        </p>
        @include('front.home.tech-logos')
    </section>
    @include('front.partials.bottom-wave')

    <section class="pv5">
        <h3 class="normal tc headf">Proprietary analysis services</h3>
        <p class="f4 f3-ns mh4 mb5 tc measure-wide center-l lh-max">
            With our custom built tools for data-gathering, classification and analysis, users are able to analyze information for any market sector, helping you with the following.
        </p>
{{--        <div class="flex flex-wrap justify-around mx8 center">--}}
            @foreach($service_points as $point)
             <div class="mb5 measure-wide center col-grey-bg" data-usher>
                 <p class="bold-type col-p ph4 pv3 col-pb-bg">{{ $point['heading'] }}</p>
                 <p class="ph4 pt0 pb4 ma0 lh-title">{{ $point['content'] }}</p>

             </div>
            @endforeach
{{--        </div>--}}
    </section>

    <section class="pb6 pt6 ph4">
{{--        <p class="f4 f3-ns mh4 mb5 tc measure-wide center-l lh-max">--}}
{{--Our custom tools and in-house research allow us to provide the following services.--}}
{{--        </p>--}}
{{--        <div class="measure-wide center">--}}
{{--            <div class="service-detail mb5" data-usher>--}}
{{--                <h4 class="mb2 bold-type ttu">Text Analytics</h4>--}}
{{--                <p class="lh-title">Ability to break down text into subcomponents that include proper name extraction, summarization, language identification, link analysis and categorization to help you quickly absorb only the data which is relevant to your needs</p>--}}
{{--            </div>--}}
{{--            <div class="service-detail mb5" data-usher>--}}
{{--                <h4 class="mb2 bold-type ttu">AI for Human Language</h4>--}}
{{--                <p class="lh-title">By providing services using deep learning methodologies we are able to segment information by topic and organize it for in a way which makes sense to you.</p>--}}
{{--            </div>--}}
{{--            <div class="service-detail mb5" data-usher>--}}
{{--                <h4 class="mb2 bold-type ttu">Entity extraction and linking</h4>--}}
{{--                <p class="lh-title">Ability to identify proper names that include company names, persons, stock tickers, numerical value ranges and link analysis capable of identifying and aggregating link reoccurrence to understand why a link is popular and help you find your way to the most important data.</p>--}}
{{--            </div>--}}
{{--            <div class="service-detail mb5" data-usher>--}}
{{--                <h4 class="mb2 bold-type ttu">Sentiment Analysis</h4>--}}
{{--                <p class="lh-title">Determining by subject matter the mood of the content to help you better classify and understand your analysis</p>--}}
{{--            </div>--}}
{{--            <div class="service-detail mb5" data-usher>--}}
{{--                <h4 class="mb2 bold-type ttu">Categorization</h4>--}}
{{--                <p class="lh-title">A key component of classifying information by subject: sports, business, finance, etc or topic: green energy, financial crisis, etc.- to help you quickly identify the information you need to know to make your decisions</p>--}}
{{--            </div>--}}
{{--            <div class="service-detail mb5" data-usher>--}}
{{--                <h4 class="mb2 bold-type ttu">Topic Extraction</h4>--}}
{{--                <p class="lh-title">Another key component of classifying information is topic - entertainment, politics, industry, etc - to help you quickly extract information necessary to make informed decisions</p>--}}
{{--            </div>--}}
{{--            <div class="service-detail mb5" data-usher>--}}
{{--                <h4 class="mb2 bold-type ttu">Text Summarization</h4>--}}
{{--                <p class="lh-title">The ability to quickly summarize data and provide you with the key components you need to scan through only the information which is relevant to your needs</p>--}}
{{--            </div>--}}
        </div>
    </section>

@endsection