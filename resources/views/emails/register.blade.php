@component('mail::message')
    
<p>Hello {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ $user->suffix }}</p>
<p>Please click the button below to verify your email address.</p>

@component('mail::button', ['url' => url('verify/' .$user->remember_token)])
Verify Email Address
@endcomponent

<p>In case you have issues please contact us in our contact us page.</p>

Thanks <br />
{{ config('app.name')}}

@endcomponent