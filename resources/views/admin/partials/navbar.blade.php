<nav class="flex justify-between items-center h3 col-p-bg">
    <div class="flex justify-start items-center">
        <a href="/admin" class="col-r ml3 mr5">
            @include('svgicons.logo_icon')
        </a>
        <a class="link col-w mh3" href="/admin/postings">Job Postings</a>
        <a class="link col-w mh3" href="/admin/applications">Applications</a>
    </div>
    <div class="flex justify-end items-center h-100">
        <dropdown name="{{ auth()->user()->email }}">
            <div slot="dropdown">
                <reset-password url="/admin/me/password" button-text="Reset"></reset-password>
                {{--<a class="link mv2 ph4 pv2 nowrap col-p hv-bg-grey" href="">Reset Password</a>--}}
                <form action="{{ route('logout') }}" method="POST" class="mv2 ph4 hv-bg-grey pv2">
                    {!! csrf_field() !!}
                    <button class="link col-p bn col-bg-trans pa0 sans" type="submit">Logout</button>
                </form>
            </div>
        </dropdown>
    </div>
</nav>