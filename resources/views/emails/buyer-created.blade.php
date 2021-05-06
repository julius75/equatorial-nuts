@component('mail::message')
# Equatorial Nut Buyer Credentials
Hello {{$data['name']}},
Use the credentials below to access the ENP Buyer's Application.

Phone Number: {{$data['phone_number']}}
Password: {{$data['password']}}

Regards,<br>
{{ config('app.name') }}
@endcomponent
