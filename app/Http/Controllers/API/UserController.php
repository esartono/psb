<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Excel;

use App\Exports\UserExport;

use App\User;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('name', 'asc')
                ->where('level', 2)
                ->get();

        return compact('user');
    }

    public function admin()
    {

        return User::orderBy('name', 'asc')
            ->where('level', '!=', 2)
            ->get()->toArray();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id', auth('api')->user()->id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function dataUser()
    {
        $users = User::selectRaw('id as id, name as label')
                ->get();

        return $users;
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $newPass = rand(10000, 99999);
        $user->update([
            'password' => Hash::make($newPass),
        ]);

        $mail = Mail::send('emails.resetPassword', compact('user', 'newPass'), function ($m) use ($user)
            {
                $m->to($user->email, $user->name)->from('psb@nurulfikri.sch.id', 'Panitia PPDB SIT Nurul Fikri')->subject('Reset Password');
            }
        );
    }

    public function gantiPassword($pass)
    {
        $user = User::where('id', auth('api')->user()->id);
        $user->update([
            'password' => Hash::make($pass),
        ]);
    }

    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }

}
