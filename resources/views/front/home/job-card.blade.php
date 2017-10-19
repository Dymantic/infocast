<div class="w-90 w-40-ns center col-grey-bg pa4 mb4">
    <p class="ttu col-p bold-type f5">{{ $posting->title }}</p>
    <p class="col-s f5 bold-type">{{ $posting->type }}</p>
    <p>{{ $posting->introduction }}</p>
    <div class="tr">
        <a href="/careers/{{ $posting->id }}" class="link ttu col-s f6 bold-type">Continue to Job</a>
    </div>
</div>