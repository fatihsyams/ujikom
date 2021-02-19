<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function post_profile(Request $request)
    {

        // $user = $request->validate([
        //     'image' => [''],
        //     'cv' => [''],
        //     'bio' => ['string', 'min:6'],
        //     'tahun_alumni' => ['required', 'min:6'],
        // ]);

        // auth()->user()->update($request->all());
    }
}
