<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::User();
        return view('cabinet', ['user' => $user]);
    }

    /**
     * Upload profile picture
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uploadPhoto(Request $request, $id)
    {
        $this->validate($request, [
            'photo' => 'mimes:jpeg,png,jpg,gif,svg|max:8048',
        ]);

        $file = $request->file('photo');
        $destinationPath = 'uploads';
        $originalFile = $file->getClientOriginalName();
        $file->move($destinationPath, $originalFile);
        $data['photo'] = $originalFile;
        User::find($id)->update($data);

        return redirect('home');
    }

}
