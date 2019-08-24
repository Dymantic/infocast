<div class="flex justify-between items-center ph2 ph4-ns fixed w-100 main-nav">
    <div class="col-r pv2 flex">
        <a href="/" class="link col-r logo-icon">
            @include('svgicons.logo_icon')
        </a>
        <span class="logo-text">
            <a class="link" href="/">@include('svgicons.logo_text')</a>
        </span>
    </div>
    <nav class="nav-links">
        <a class="ph2 bold-type hov-s link f4 f6-ns col-grey @activeclass('about')"
           href="/about">About Us</a>
        <a class="ph2 bold-type hov-s link f4 f6-ns col-grey @activeclass('services')"
           href="/services">Services</a>
        <a class="ph2 bold-type hov-s link f4 f6-ns col-grey @activeclass('careers')"
           href="/careers">Careers</a>
        <a class="ph2 bold-type hov-s link f4 f6-ns col-grey @activeclass('contact')"
           href="/contact">Contact</a>
    </nav>
    <div class="nav-trigger dn items-center bold-type">
        <span class="pr2">MENU</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/></svg>
    </div>
</div>