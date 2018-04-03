@component('mail::message')
# New Business Application

{{ $user->name }} ({{ $user->email }}) has applied for business status.

---
Company name: {{ $name }}<br>
Company Description:<br>
{{ $desc }}
***

Thanks,<br>
Your friends at {{ config('app.name') }}
@endcomponent