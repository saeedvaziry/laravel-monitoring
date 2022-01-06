@component('mail::message')
# {{ $subject }}

**CPU:** {{ $record->cpu }}

**Memory:** {{ $record->memory }}

**Disk:** {{ $record->disk }}

Regards,<br>
{{ config('app.name') }}
@endcomponent
