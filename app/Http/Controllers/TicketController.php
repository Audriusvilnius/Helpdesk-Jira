<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOpenMail;
use App\Mail\NewMessageMail;
use App\Mail\StatusImportantMail;
use App\Models\Important;
use App\Models\Share;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


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
        $this->middleware('permission:ticket-edit', ['only' => ['edit', 'update', 'share']]);
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
        if (Auth::user()->role == 'admin') {
            $data = Share::latest()->paginate(10);
        } else {
            $data = Share::where('share_user_id', '=', Auth::user()->id)
                ->latest()
                ->paginate(10);
        }

        return view('back.tickets.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $important = Important::orderBy('id', 'desc')->get();
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
        $ticket = new Ticket;
        $ticket->id = $request->id;
        $ticket->title = $request->title;
        $ticket->request = $request->message_json;
        $ticket->status_id = 1;
        $ticket->user_id = Auth::user()->id;
        $ticket->important_id = $request->important_id;
        $ticket->message_json = [Auth::user()->id => ['user_name' => Auth::user()->name, 'message' => $request->message_json, 'date' => date('Y-m-d H:i', time()), 'insert_at' => time()]];
        $ticket->message_json = json_encode($ticket->message_json);
        $ticket->save();

        $share = new Share;
        $share->share_ticket_id = $ticket->id;
        $share->share_user_id = Auth::user()->id;
        $share->save();

        $to = User::find($ticket->user_id);
        // Mail::to($to)->send(new ConfirmOpenMail($ticket, $to));
        $admin = User::where('role', 'like', 'admin')->get();
        foreach ($admin as $to) {
            $to = User::find($to->id);
            // Mail::to($to)->send(new ConfirmOpenMail($ticket, $to));
        }

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
        $status = Status::all();
        $important = Important::all();
        $ticket = Ticket::find($id);
        $message = json_decode($ticket->message_json, 1);

        if ($message != null) {
            usort($message, function ($b, $a) {
                return $a['date'] <=> $b['date'];
            });
        }

        return view('back.tickets.show', compact('ticket', 'message', 'status',));
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
        $status = Status::all();
        $important = Important::all();
        $users = User::all();
        $share = Share::where('share_ticket_id', 'like', $id)->get();
        $uploads = Upload::where('upload_ticket_id', 'like', $id)->get();
        return view('back.tickets.edit', compact('ticket', 'important', 'status', 'users', 'share', 'uploads'));
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
        if ($request->important_id) {
            $ticket->important_id = $request->important_id;
        }
        if ($request->status_id) {
            $ticket->status_id = $request->status_id;
        }

        $ticket->title = $request->title;
        $ticket->message_json = $request->message_json;
        $ticket->update();

        $to = User::find($ticket->user_id);
        // Mail::to($to)->send(new StatusImportantMail($ticket, $to));
        $admin = User::where('role', 'like', 'admin')->get();
        foreach ($admin as $to) {
            $to = User::find($to->id);
            // Mail::to($to)->send(new StatusImportantMail($ticket, $to));
        }
        $ticket = Ticket::find($id);
        $status = Status::all();
        $important = Important::all();
        $users = User::all();
        $share = Share::where('share_ticket_id', 'like', $id)->get();
        $uploads = Upload::where('upload_ticket_id', 'like', $id)->get();

        return view('back.tickets.edit', compact('ticket', 'important', 'status', 'users', 'share', 'uploads'))->with('success', 'Ticket updated successfully.');
    }
    // /**
    //  * Message Update the specified resource in storage.
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
            $messaj_json = [uniqid() => ['user_name' => Auth::user()->name, 'message' => $request->message_json, 'date' => date('Y-m-d H:i', time()), 'insert_at' => time()]];
        }

        $messaj_json = json_encode($messaj_json);
        DB::table('tickets')->where('id', $request->id)->update(['message_json' => $messaj_json]);
        DB::table('tickets')->where('id', $request->id)->update(['status_id' => $ticket->status_id]);

        $message = json_decode($messaj_json, 1);
        if ($message != null) {
            usort($message, function ($b, $a) {
                return $a['insert_at'] <=> $b['insert_at'];
            });
        }
        $ticket->message_json = $request->message_json;

        $to = User::find($ticket->user_id);
        // Mail::to($to)->send(new NewMessageMail($ticket, $to));
        $admin = User::where('role', 'like', 'admin')->get();
        foreach ($admin as $to) {
            $to = User::find($to->id);
            // Mail::to($to)->send(new NewMessageMail($ticket, $to));
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
