@component('mail::message')
# Equatorial Nut Buyer Credentials
Hello {{$data['name']}},
Use the credentials below to access the ENP Buyer's Application.

Email: {{$data['email']}}
Password: {{$data['password']}}

Regards,<br>
{{ config('app.name') }}
@endcomponent
