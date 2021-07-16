@component('mail::message')
    <h3 style="font-size: 20px;"> Bulk Upload Notification </h3>

    {{$products}} Products are uploading.
    Request from Api.


    Thanks,
    {{ config('app.name') }}
@endcomponent
