<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'contact_number' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => ['required']
        ],[
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.', // ✅ Custom message
        ]);

        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'message' => $request->message,
            'code' => Str::uuid(),
        ]);

        return redirect()->back()->with('success', 'Message sent successfully! We will get back to you.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }
}
