<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\ContactUsReply;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'nullable',
                'contact_number' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => ['required'],
            ],
            [
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.', // ✅ Custom message
            ],
        );

        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'message' => $request->message,
            'email_status' => 0,
            'code' => Str::uuid(),
        ]);

        return redirect()->back()->with('success', 'Message sent successfully! We will get back to you.');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $messagesListQuery = DB::table('contact_us as a');

        if ($search) {
            $messagesListQuery->where(function ($query) use ($search) {
                $query->where('a.name', 'like', '%' . $search . '%')->orWhere('a.email', 'like', '%' . $search . '%')->orWhere('a.message', 'like', '%' . $search . '%');
            });
        }

        $messages = $messagesListQuery
            ->select('a.*')
            ->orderBy('a.created_at', 'desc')
            ->paginate(10, ['*'], 'messages_page');

        return view('userviews.contactus.index', [
            'messages' => $messages,
        ]);
    }

    public function reply($id){
        $contactReplyEdit = ContactUs::findOrFail($id);
        $contactRepliesCurrent = ContactUsReply::where('message_id',$id)->get();

          return view('userviews.contactus.reply', [
            'contactReplyEdit' => $contactReplyEdit,
            'contactRepliesCurrent' => $contactRepliesCurrent
        ]);
    }
}
