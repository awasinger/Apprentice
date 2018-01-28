@component('layouts.mail')

    @slot('title')
        <h1>Welcome to Apprentice!</h1>
    @endslot
    
    @slot('body')
        <p>This is just a short confirmation email to make sure that you submitted the right email.</p>
        <p>Thank you,</p>
        <p>Your friends at Apprentice</p>
    @endslot

@endcomponent