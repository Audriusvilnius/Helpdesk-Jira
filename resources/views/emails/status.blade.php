<h2>Hey, {{ $id->name }}</h2><br>
<strong>{{ $data->updated_at->format('Y-m-d H:i') }} </strong><br>
<h3>
    @if (Auth::user()->id != $id->id)
        {{ Auth::user()->name }}
    @else
        You
    @endif update Ticket #
    {{ $data->id }}
    <br>
</h3>
{{ asset('/tickets' . '/' . $data->id) }}<br><br>

<strong>Ticket title:</strong><br>{{ $data->title }}<br><br>
<strong>Important: </strong>{{ $data->ticketsImportant->title }}<br>
<strong>Status: </strong>{{ $data->ticketsStatus->title }}<br><br>

Regards,<br>
Helpdesk







<h2>Hey, {{ $id->name }}</h2><br>
<strong>{{ $data->updated_at->format('Y-m-d H:i') }} </strong>{{ Auth::user()->name }} update Ticket #
{{ $data->id }}: {{ asset('/tickets' . '/' . $data->id) }}<br><br>

<strong>Ticket title: </strong>{{ $data->title }}<br>
<strong>Important: </strong>{{ $data->ticketsImportant->title }}<br>
<strong>Status: </strong>{{ $data->ticketsStatus->title }}<br><br>
{{-- <strong>URL below into your web browser: </strong>{{ asset('/tickets' . '/' . $data->id) }} <br><br><br> --}}

Regards,<br>
Helpdesk
