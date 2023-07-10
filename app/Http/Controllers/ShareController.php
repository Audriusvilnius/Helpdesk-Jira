<?php

namespace App\Http\Controllers;

use App\Models\Important;
use App\Models\Share;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;

class ShareController extends Controller
{
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

        $uploads = Upload::where('upload_ticket_id', 'like', $request->ticket_id)->get();

        return view('back.tickets.edit', compact('ticket', 'important', 'status', 'users', 'share', 'uploads'))->with('success', 'Ticket updated successfully.');
    }


    public function destroy($id)
    {
        $tickets = Share::find($id)->first();
        $ticket_id = $tickets->share_ticket_id;
        Share::find($id)->delete();
        $ticket = Ticket::find($ticket_id);
        $status = Status::all();
        $important = Important::all();
        $users = User::all();
        $share = Share::where('share_ticket_id', 'like', $ticket_id)->get();
        $uploads = Upload::where('upload_ticket_id', 'like', $ticket_id)->get();

        return view('back.tickets.edit', compact('ticket', 'important', 'status', 'users', 'share', 'uploads'));
    }
}
