<x-mail::message>
# {{ __('Your account has been created') }}

{{ __('Hello') }} {{ $user->name }},

{{ __('Your account has been created successfully.') }}

{{ __('Your account details are as follows:') }}

**{{ __('Name') }}:** {{ $user->name }}<br>
**{{ __('Email') }}:** {{ $user->email }}<br>
**{{ __('Password') }}**: <br>

<x-mail::panel>
{{ $password }}
</x-mail::panel>

<x-mail::button :url="route('login')" :color="config('mail.colors.primary')">
{{ __('Login') }}
</x-mail::button>

{{ __('If you have any questions, please feel free to contact us.') }}

{{ __('Thanks') }}

{{ config('app.name') }}
</x-mail::message>
