<h2>Hey, {{ $text->name }}</h2><br>
<strong>{{ $data->updated_at->format('Y-m-d H:i') }} </strong>{{ Auth::user()->name }} update Ticket #
{{ $data->id }}: {{ asset('/tickets' . '/' . $data->id) }}<br><br>

<strong>Important: </strong>{{ $data->ticketsImportant->title }}<br>
<strong>Status: </strong>{{ $data->ticketsStatus->title }}<br><br>
<strong>Ticket title:<br> </strong>{{ $data->title }}<br>
<strong>Message: </strong><br>
{!! nl2br(e($data->message_json)) !!}<br><br>
{{-- @dd($text); --}}
{{-- <strong>URL below into your web browser: </strong>{{ asset('/tickets' . '/' . $data->id) }} <br><br><br> --}}

Regards,<br>
Helpdesk
