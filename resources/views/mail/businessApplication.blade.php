@component('mail::message')
# New Business Application

{{ $user->name }} ({{ $user->email }}) has applied for business status.

---
Company name: {{ $user->name }}<br>
Company Description:<br>
{{ $desc }}
***

@component('mail::button', ['url' => 'http://apprentice.local/business/confirm/'.$token])
Approve Company
@endcomponent

Thanks,<br>
Your friends at {{ config('app.name') }}
@endcomponent