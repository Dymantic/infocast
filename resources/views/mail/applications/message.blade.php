@component('mail::message')
# Infocast Application Received

Application received for **{{ $posting }}**

@component('mail::panel')
    **From:** {{ $name }}<br>
    **Phone** {{ $phone }}<br>
    **Email:** {{ $email }}<br>
    **Contact Method:** {{ $contact_method }}<br>
@endcomponent


@component('mail::button', ['url' => $url])
    View on Site
@endcomponent

@endcomponent