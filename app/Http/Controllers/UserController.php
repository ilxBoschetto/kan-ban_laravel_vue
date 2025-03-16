<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \App\Models\TaskType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function getLoggedUser(){
        return Auth::user();
    }

    public function updateLoggedUser()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->name = \request()->name;
        $user->email = \request()->email;
        $user->username = \request()->username;

        if (!empty(\request()->password)) {
            $user->password = Hash::make(\request()->password);
        }

        if (request()->hasFile('image')) {
            $image = request()->file('image');
        
            if ($user->image) {
                unlink(public_path($user->image));
            }
        
            $imageName = time() . '.' . $image->getClientOriginalExtension();
        
            $image->move(public_path('uploads'), $imageName);
            
            $user->image = '/uploads/' . $imageName;
            $user->save();
        }        

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
}
