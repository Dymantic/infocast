@extends('front.base', ['pageName' => 'dark'])

@section('content')
    <section class="about-banner banner flex justify-center items-center">
        <p class="huge-type black-type col-w">This is us.</p>
    </section>
    <section class="pt6 pb5 relative decorated">
        <h3 class="normal tc head0 mt0 pv5 o-0 fadeUpOnLoad">What We Do</h3>
        <p class="f4 f3-ns tc mh4 mb3 measure-wide center-l lh-max">
            At Infocast, we develop scalable software applications that simplify data procurement and
            management by incorporating drag and drop interfaces. Our products provide intuitive data
            analysis tools for labeling automation, data classification, image/text processing, link-analysis, and visualization.
        </p>

        <p class="f4 f3-ns tc mh4 mb3 measure-wide center-l lh-max">Clients use Infocast software for everything from auto-populating databases and building data-driven products to aiding decision-making processes. Through a unique set of artificial intelligence, natural language processing tools, and user experience advancements, Infocast offers robust data extraction, population, and analysis, turning disjointed information into catalogued insights.</p>

        <p class="f4 f3-ns tc mh4 mb3 measure-wide center-l lh-max">Technology developed by Infocast has served thousands of people, including over 200 Fortune 500 firms, 12 country governments, and dozens of nonprofits and small businesses around the globe.</p>
    </section>
    @include('front.partials.top-wave')
    <section class="pb5 relative col-pb-bg decorated">
        <div class="pv5">
            <h3 class="normal tc head0 mt0 pv5" data-usher>Who We Are</h3>
            <p class="f4 f3-ns tc mh4 mb3 measure-wide center-l lh-max">We make knowledge more accessible to everybody by revolutionizing the data classification process and labeling of information to provide simplified analysis. This design of information processing disrupts the current information consumption process and empowers users to discover further value of data. </p>

            <p class="f4 f3-ns tc mh4 mb3 measure-wide center-l lh-max">Our motivation stems from a core belief that it currently takes far too long to locate and consume information on the web, making it burdensome to compile information into usable formats. This scattered data structure is rarely extracted in a format that can be easily sorted and filtered.</p>
        </div>
    </section>
    @include('front.partials.bottom-wave')

    <section class="pb5 relative decorated">
        <h3 class="normal tc head0 mt0 pv5" data-usher>Our Vision</h3>
        <p class="f4 f3-ns tc mh4 mb3 measure-wide center-l lh-max">We envision a world where anyone can easily accelerate data utilization of specialized and organized information. We aim to speed up the process of finding, creating, analyzing, and publishing hard-to-find, structured information by removing all technical barriers in data services.</p>

        <p class="f4 f3-ns tc mh4 mb3 measure-wide center-l lh-max">It is our goal to give the average person the same resources that large businesses have that curate and commercialize highly structured information, so the rest of us can find and use that data quicker.</p>

    </section>
    @include('front.partials.top-wave')
    <section class="relative col-pb-bg decorated">
        <div class="pv5 relative">
            <h3 class="normal tc head0 mt0 pv5" data-usher>Our People</h3>
            <p class="f4 f3-ns tc mh4 mb3 measure-wide center-l lh-max">We are a seasoned, interdisciplinary team of web custodians and data enthusiasts united by our passion for solving problems and streamlining complex processes. Our team works in an environment that emphasizes fun, creativity, teamwork, and productivity over bureaucracy, hierarchy, and attendance. We believe in the power of diversity, which is reflected in our international team, whose members come from different parts of the world. Prioritizing each team member’s voice and feedback in every step of the way ensures meeting our goals. We are a family brought together by our shared dream of making the metadata-sphere more friendly to everyone.</p>
        </div>
    </section>
    @include('front.partials.bottom-wave')
    <div class="h5"></div>


@endsection