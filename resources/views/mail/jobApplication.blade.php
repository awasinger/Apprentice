@component('layouts.mail')

    @slot('title')
        <h1>Job Application For {{ $course }}</h1>
    @endslot
    
    @slot('body')
        <p>{{ $name }} ({{ $email }}) has gotten a score of {{ $score }}% on {{ $course }}</p>
        <p>Here is a short message from {{ $name }} about why they should be on your team.</p>
        <hr>
        <p>{{ $app }}</p>
        <hr>
        <p>Thank you,</p>
        <p>Your friends at Apprentice</p>
    @endslot

@endcomponent