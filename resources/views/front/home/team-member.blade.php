<div class="w-100 w-50-m w-third-ns flex flex-column justify-between items-center mb4">
    <div class="ph4 tc">
        <img src="{{ $member['profile'] }}"
             alt="A profile image of {{ $member['name'] }}"
             class="w4 h4 br-100"
        >
        <p class="bold-type f5 mb0">{{ $member['name'] }}</p>
        <p class="bold-type ttu mt1 col-s f5">{{ $member['title'] }}</p>
        <p class="col-pl lh-title">{{ $member['quote'] }}</p>
    </div>
</div>