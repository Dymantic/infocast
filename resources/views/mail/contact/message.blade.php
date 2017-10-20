@component('mail::message')
# Infocast Site Inquiry

@component('mail::panel')
    **From:** {{ $name }}<br>
    **Phone** {{ $phone }}<br>
    **Email:** {{ $email }}
@endcomponent


{{ $inquiry }}


@component('mail::button', ['url' => $url])
    View on Site
@endcomponent

@endcomponent