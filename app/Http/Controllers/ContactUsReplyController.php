<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Models\ContactUsReply;
use App\Mail\ContactUsReplyMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactUsReplyController extends Controller
{
    public function sendreply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $contact = ContactUs::findOrFail($id);

        // Send email
        Mail::to($contact->email)->send(new ContactUsReplyMail($request->reply));

        // Save reply to database
        ContactUsReply::create([
            'message_id' => $contact->id,
            'reply' => $request->reply,
            'user_id' => Auth::id(),
        ]);

        $contact->email_status = 1;
        $contact->save();

        return redirect()->back()->with('success', 'Reply sent and saved successfully.');
    }
}
