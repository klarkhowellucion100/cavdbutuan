<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageUsersController extends Controller
{
    public function index(){
        $users = User::orderBy('name','asc')->paginate(10);

        return view('users.index',[
            'users' => $users
        ]);
    }

    public function edit($id){
        $user = User::findOrFail($id);

        return view('users.edit',[
            'user' => $user
        ]);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'reg_status' => 'required',
            'role' => 'required'
        ]);

        $user->reg_status = $request->input('reg_status');
        $user->role = $request->input('role');
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }

        public function bulkdelete(Request $request)
    {
        $ids = $request->input('selected_ids');

        if ($ids) {
            // $records = DB::table('users')->whereIn('id', $ids)->get();

            // foreach ($records as $record) {
            //     if ($record->image) {
            //         $filePath = storage_path('app/public/' . $record->image);
            //         if (file_exists($filePath)) {
            //             unlink($filePath); // Direct file deletion
            //         }
            //     }
            // }

            DB::table('users')->whereIn('id', $ids)->delete();
        }

        return redirect()->back()->with('success', 'Selected users deleted successfully.');
    }
}
