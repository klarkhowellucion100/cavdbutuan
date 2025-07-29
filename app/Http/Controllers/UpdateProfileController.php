<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UpdateProfileController extends Controller
{
    public function edit($id)
    {
        $userProfile = User::findOrFail($id);

        return view('userviews.userprofile.edit', [
            'userProfile' => $userProfile,
        ]);
    }

    public function update(Request $request, $id)
    {
        $profile = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'position' => 'required',
        ]);

        $profile->update($data);

        return redirect()->back()->with('success', 'Successfully updated!');
    }
}
