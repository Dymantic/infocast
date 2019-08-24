<div class="w-90 w-40-ns center col-grey-bg pa4 mb4" data-usher>
    <p class="ttu col-p bold-type mb0 f5">{{ $posting->title }}</p>
    <p class="col-s f5 bold-type mt1">{{ $posting->type }}</p>
    <p class="col-pl lh-title">{{ $posting->introduction }}</p>
    <div class="tr">
        <a href="/careers/{{ $posting->id }}/{{ $posting->slug }}" class="link ttu col-s hov-r f6 bold-type">Continue to Job</a>
    </div>
</div>