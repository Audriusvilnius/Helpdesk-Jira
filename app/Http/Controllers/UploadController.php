<?php

namespace App\Http\Controllers;

use App\Models\Important;
use App\Models\Share;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Upload the specified resource in storage.
     */
    public function uploads(Request $request)
    {
        $this->validate($request, [
            'upload' => 'required|file|max:10240',
            // 'upload' => 'required|max:10240|size:10485760',
        ]);

        $upload = new Upload;

        $ticket = Ticket::find($request->ticket_id);
        if ($request->file('upload')) {
            $share_file = $request->file('upload');
            $ext = $share_file->getClientOriginalExtension();
            $name = pathinfo($share_file->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name . '_' . date('Y-m-d_H:i:s', time()) . '.' . $ext;
            $dir = 'ticket_' . $request->ticket_id;
            $share_file->move(public_path() . '/requests' . '/' . $dir, $file);
            $share_file =  $file;
            $upload->upload_dir = $dir;
            $upload->upload_ticket_id = $request->ticket_id;
            $upload->upload_file = $file;
            $upload->upload_user_id = Auth::user()->id;
            $upload->save();
        }

        $share = Share::where('share_ticket_id', 'like', $request->ticket_id)->get();
        $status = Status::all();
        $important = Important::all();
        $users = User::all();
        $uploads = Upload::where('upload_ticket_id', 'like', $request->ticket_id)->get();

        return view('back.tickets.edit', compact('ticket', 'important', 'status', 'users', 'share', 'uploads'));
    }

    /**
     * Download the specified resource.
     */
    public function download($dir, $file)
    {
        $filePath = public_path() . '/requests' . '/' . $dir . '/' . $file;
        return response()->download($filePath);
    }

    /**
     * Delete the specified resource from storage.
     */
    public function remove(Upload $file)
    {

        if (file_exists(public_path() . '/requests' . '/' . $file->upload_dir . '/' . $file->upload_file)) {
            unlink(public_path() . '/requests' . '/' . $file->upload_dir . '/' . $file->upload_file);
            $s = public_path() . '/requests' . '/' . $file->upload_dir . '/' . $file->upload_file;
            $file->save();
        }
        $tickets = Upload::find($file->id)->first();
        $ticket_id = $tickets->upload_ticket_id;
        Upload::find($file->id)->delete();
        $ticket = Ticket::find($ticket_id);
        $status = Status::all();
        $important = Important::all();
        $users = User::all();
        $share = Share::where('share_ticket_id', 'like', $ticket_id)->get();
        $uploads = Upload::where('upload_ticket_id', 'like', $ticket_id)->get();

        return view('back.tickets.edit', compact('ticket', 'important', 'status', 'users', 'share', 'uploads'));
    }
}
