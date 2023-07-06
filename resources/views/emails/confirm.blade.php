<h2>Hey, {{ $id->name }}</h2><br>
<strong>{{ $data->updated_at->format('Y-m-d H:i') }} </strong><br>
<h3>
    @if (Auth::user()->id != $id->id)
        {{ Auth::user()->name }}
    @else
        You
    @endif Open new Ticket #
    {{ $data->id }}
    <br>
</h3>
{{ asset('/tickets' . '/' . $data->id) }}<br><br>

<strong>Important: </strong>{{ $data->ticketsImportant->title }}<br>
<strong>Status: </strong>{{ $data->ticketsStatus->title }}<br><br>
<strong>Ticket title:<br> </strong>{{ $data->title }}<br><br>
<strong>Messege:<br> </strong>{!! nl2br(e($data->request)) !!}<br>


Regards,<br>
Helpdesk
