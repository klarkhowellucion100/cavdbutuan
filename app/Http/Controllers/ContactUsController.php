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
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'contact_number' => 'required',
            'message' => 'required',
        ]);

        $data['code'] = Str::uuid();

        ContactUs::create($data);

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
