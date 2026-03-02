@component('mail::message')
# New Contact Form Submission

**Name:** {{ $submission->name }}
**Email:** {{ $submission->email }}
**Subject:** {{ $submission->subject ?? 'N/A' }}

**Message:**
{{ $submission->message }}

---
*Submitted at {{ $submission->created_at->format('F j, Y g:i A') }}*

@component('mail::button', ['url' => config('app.url') . '/admin/contact-submissions'])
View in Admin Panel
@endcomponent

@endcomponent
