@component('mail::message')
# Change Password Confirmation - {{ $user_name_for_mail }}
 
Your password has been changed!  

@component('mail::button', ['url' => 'momin'])
    TEST BUTTON
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent