<div class="flex justify-between items-center ph2 ph4-ns fixed w-100 main-nav">
    <div class="col-r pv2 flex">
        <a href="/" class="link col-r logo-icon">
            @include('svgicons.logo_icon')
        </a>
        <span class="logo-text">
            @include('svgicons.logo_text')
        </span>
    </div>
    <nav>
        <a class="ph2 link col-grey @activeclass('careers')"
           href="/careers">Careers</a>
        <a class="ph2 link col-grey @activeclass('contact')"
           href="/contact">Contact</a>
    </nav>
</div>