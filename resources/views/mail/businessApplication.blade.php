@component('layouts.mail')

    @slot('title')
        <h1>New Business Application</h1>
    @endslot
    
    @slot('body')
        <p>{{ $about[0]}} has applied for business status</p>
        <p>{{ $about[1] }}</p>
        <p>Thank you,</p>
        <p>Your friends at Apprentice</p>
    @endslot

@endcomponent