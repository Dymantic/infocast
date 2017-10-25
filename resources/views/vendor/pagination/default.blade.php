@if ($paginator->hasPages())
    <div class="card mv3">
        <p class="col-s ttu f7">Pages</p>
        <div class="flex justify-between">
            <div>
                @if (! $paginator->onFirstPage())
                    <span class="ph3"><a class="link col-p" href="{{ $paginator->previousPageUrl() }}" rel="prev">@include('svgicons.arrow_left')</a></span>
                @endif
            </div>
            <div class="flex-auto">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class=""><span>{{ $element }}</span></span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="col-s ph3"><span>{{ $page }}</span></span>
                            @else
                                <span class="ph3"><a class="link" href="{{ $url }}">{{ $page }}</a></span>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
            <div>
                @if ($paginator->hasMorePages())
                    <span class="ph3"><a class="link col-p" href="{{ $paginator->nextPageUrl() }}" rel="next">@include('svgicons.arrow_right')</a></span>
                @endif
            </div>
        </div>
    </div>
@endif
