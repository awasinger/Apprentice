@component('mail::message')
# Congrats! You Are Now Registered As A Business

Login to Apprentice and visit this link to create a course!

@component('mail::button', ['url' => 'http://apprentice.local/courses/create'])
Create Your First Course
@endcomponent

Thanks,<br>
Your friends at {{ config('app.name') }}
@endcomponent