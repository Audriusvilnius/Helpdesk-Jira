<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOpenMail;
use App\Mail\NewMessageMail;
use App\Mail\StatusImportantMail;
use App\Models\Important;
use App\Models\Share;
use App\Models\Status;
use App\Models\Ticket;
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
        $this->middleware('permission:ticket-edit', ['only' => ['edit', 'update', 'share', 'file']]);
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
        $data = Ticket::latest()->paginate(3);
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
        $files = json_decode($ticket->attach_json, 1);
        // $files = json_decode($ticket->attach_json, 1) ?: [];

        return view('back.tickets.edit', compact('ticket', 'important', 'status', 'users', 'share', 'files'));
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
     * Show the form for share the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function share(Request $request)
    {
        $share_new = new Share;
        $share_new->share_ticket_id = $request->ticket_id;
        $share_new->share_user_id = $request->user_id;
        $count = 0;
        $share_tickets = Share::where('share_ticket_id', 'like', $request->ticket_id)->get();
        foreach ($share_tickets as $share_ticket) {
            if ($share_ticket->share_user_id == $request->user_id) {
                $share_new->update();
                $count++;
                break;
            }
        }
        if ($count == 0) {
            $share_new->save();
        }

        $share = Share::where('share_ticket_id', 'like', $request->ticket_id)->get();
        $ticket = Ticket::find($request->ticket_id);
        $status = Status::all();
        $important = Important::all();
        $users = User::all();

        $files = json_decode($ticket->attach_json, 1);
        return view('back.tickets.edit', compact('ticket', 'important', 'status', 'users', 'share', 'files'));
    }
    /**
     * Show the form for insert file the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function file(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|file|max:10000',
            ]
        );

        if ($validator->fails()) {
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        }

        $ticket = Ticket::find($request->ticket_id);
        if ($request->file('file')) {
            $share_file = $request->file('file');
            $ext = $share_file->getClientOriginalExtension();
            $name = pathinfo($share_file->getClientOriginalName(), PATHINFO_FILENAME);
            // $file = $name . '-' . uniqid() . '.' . $ext;
            $file = $name . '.' . $ext;
            $share_file->move(public_path() . '/ticket', $file);

            $share_file =  $file;
            // $share_file = storage_path() . 'ticket_#_' . $request->ticket_id . '/' . $file;
            $attach_json = json_decode($ticket->attach_json, 1);
            // dd($share_file);

            if ($attach_json) {
                $attach_json[uniqid()] = ['file' => $share_file, 'name' => $file];
            } else {
                $attach_json = [uniqid() => ['file' => $share_file, 'name' => $file]];
            }
        }
        $ticket->attach_json = json_encode($attach_json);
        $ticket->update();
        // DB::table('tickets')->where('id', $request->ticket_id)->update(['attach_json' => $attach_json]);
        $share = Share::where('share_ticket_id', 'like', $request->ticket_id)->get();
        $status = Status::all();
        $important = Important::all();
        $users = User::all();
        $files = json_decode($ticket->attach_json, 1);

        return view('back.tickets.edit', compact('ticket', 'important', 'status', 'users', 'share', 'files'));
    }

    /**
     * @param mixed $file_name 
     * @return mixed 
     * @throws BindingResolutionException 
     */
    public function downloads($file_name)
    {
        $filePath = public_path() . '/ticket/' . $file_name;
        return response()->download($filePath);
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
