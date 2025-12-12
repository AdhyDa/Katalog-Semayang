@php
    use Illuminate\Support\HtmlString;
@endphp

<x-mail::message>

<style>
    .button-custom {
        background-color: rgba(126, 154, 62, 1) !important;
        color: white !important;
        border-radius: 5px;
        padding: 12px 24px;
        text-decoration: none !important;
        display: inline-block;
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        font-size: 16px;
    }
</style>

@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

@foreach ($introLines as $line)
{{ $line }}

@endforeach

@isset($actionText)
@php
    $color = 'custom';
@endphp

<x-mail::button :url="$actionUrl" color="custom">
{{ $actionText }}
</x-mail::button>
@endisset

@foreach ($outroLines as $line)
{{ $line }}

@endforeach

@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards,')<br>
{{ config('app.name') }}
@endif

@isset($actionText)
<x-slot:subcopy>
@lang(
    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset

</x-mail::message>
