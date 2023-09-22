<h2>Hey, {{ $id->name }}</h2><br>
<strong>{{ $ticket->updated_at->format('Y-m-d H:i') }} </strong><br>
<h3>
    @if (Auth::user()->id != $id->id)
        {{ Auth::user()->name }}
    @else
        You
    @endif
    Add file <a href="">{{ $data->upload_file }}</a> to
    <a href="
    {{ asset('/tickets' . '/' . $ticket->id) }}<br><br>
    ">Ticket # {{ $ticket->id }}</a>
    <br>
</h3>
<a href="{{ storage_path() . '/uploads' . '/' . $data->upload_dir . '/' . $data->upload_file }}">{{ $data->upload_file }}
    "></a><br>
{{-- @dd($data) --}}

<strong>Important: </strong>{{ $ticket->ticketsImportant->title }}<br>
<strong>Status: </strong>{{ $ticket->ticketsStatus->title }}<br><br>
<strong>Ticket title:</strong><br>
{{ $ticket->title }}<br><br>


Regards,<br>
Helpdesk
