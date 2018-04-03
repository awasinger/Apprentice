@component('mail::message')
# Job Application for {{ $course }}

{{ $user->name }} ({{ $user->email }}) has gotten a score of {{ $score }}% on {{ $course }}

Here is a short message from {{ $user->name }} about why they should be on your team.

---
{{ $apply }}
***

Thanks,<br>
Your Friends At {{ config('app.name') }}
@endcomponent