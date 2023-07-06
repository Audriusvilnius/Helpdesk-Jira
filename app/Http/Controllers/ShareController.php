<?php

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required',
            'share_user_id' => 'required|email',
            'share_ticket_id' => 'required',
        ]);


        Share::create($request->all());

        return redirect()->back()
            ->with(['success' => 'New user jonet to']);
    }
}
