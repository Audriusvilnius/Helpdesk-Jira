<?php

namespace App\Http\Controllers;

use App\Models\Important;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:ticket-list|ticket-create|ticket-edit|ticket-delete|ticket-message', ['only' => ['index', 'show']]);
        $this->middleware('permission:ticket-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ticket-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ticket-delete', ['only' => ['destroy']]);
        $this->middleware('permission:ticket-message', ['only' => ['message']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Ticket::latest()->paginate(10);

        return view('back.tickets.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $important = Important::pluck('title', 'title')->all();

        return view('back.tickets.create', compact('important'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'message_json' => 'required',
            'important_id' => 'required',
        ]);
        $important = Important::pluck('title', 'id')->all();
        $input = $request->except(['_token']);
        $input['user_id'] = Auth::user()->id;
        $input['user_name'] = Auth::user()->name;

        $input['status_id'] = 1;
        $input['important_id'] = array_search($request->important_id, $important);

        $input['message_json'] = [Auth::user()->id => ['user_name' => Auth::user()->name, 'message' => $request->message_json, 'date' => date('Y-m-d H:i', time()), 'insert_at' => time()]];
        $input['message_json'] = json_encode($input['message_json']);

        Ticket::create($input);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $message = json_decode($ticket->message_json, 1);

        if ($message != null) {
            usort($message, function ($b, $a) {
                return $a['date'] <=> $b['date'];
            });
        }

        return view('back.tickets.show', compact('ticket', 'message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $important = Important::pluck('title', 'title')->all();
        $ticketsImportant = $ticket->ticketsImportant->title;
        $ticketsImportant = [$ticketsImportant => $ticketsImportant];

        return view('back.tickets.edit', compact('ticket', 'important', 'ticketsImportant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'message_json' => 'required',
        ]);

        $ticket = Ticket::find($id);
        $important = Important::pluck('title', 'id')->all();
        $input['important_id'] = array_search($request->important_id, $important);

        if ($request->important_id) {
            $ticket->important_id = $input['important_id'];
        }
        $ticket->title = $request->title;
        $ticket->message_json = $request->message_json;
        $ticket->update();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }
    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function message(Request $request)
    {
        $this->validate($request, [
            'message_json' => 'required',
        ]);

        $ticket = Ticket::find($request->id);
        $ticket->updated_at = date('Y-m-d G:i:s');

        $ticket->touch();
        $messaj_json = json_decode($ticket->message_json, 1);

        if ($messaj_json) {
            $messaj_json[uniqid()] = ['user_name' => Auth::user()->name, 'message' => $request->message_json, 'date' => date('Y-m-d H:i', time()), 'insert_at' => time()];
        } else {
            $messaj_json = [uniqid() => ['user_name' => Auth::user()->name, 'review' => $request->message_json, 'date' => date('Y-m-d H:i', time()), 'insert_at' => time()]];
        }

        $messaj_json = json_encode($messaj_json);
        DB::table('tickets')->where('id', $request->id)->update(['message_json' => $messaj_json]);

        $message = json_decode($messaj_json, 1);
        if ($message != null) {
            usort($message, function ($b, $a) {
                return $a['insert_at'] <=> $b['insert_at'];
            });
        }

        return view('back.tickets.show', compact('ticket', 'message'))->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ticket::find($id)->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }
}
