<?php

namespace App\Http\Controllers;

use App\Usaha;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('u'); //hapus key session u
        $usaha = Usaha::DaftarUsaha(); //panggil dari Model Usaha.php

        return view('profiles.index', compact('usaha'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($user){
            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();
            return redirect()->route('home')->with('notif', 'Data Anda telah berhasil diubah');

        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changepass(Request $request, $id)
    {
        $this->validate($request, [
            'old_pass' => 'required | min:8',
            'new_pass' => 'required | min:8',
            'conf_pass' => 'required | min:8',
        ]);

        $user = User::find(Auth::user()->id);
        $hashedPassword =  $user->password;

        //cek apakah password lama sudah sesuai
        if (\Hash::check($request->old_pass , $hashedPassword )) {

            //cek apakah password baru dan konfirmasinya sudah sama
            if ($request->new_pass === $request->conf_pass) {

                //password baru tidak boleh sama dengan password lama
                if (!\Hash::check($request->new_pass , $hashedPassword)) {

                    $user->password = bcrypt($request->new_pass);
                    $user->save();

                    return redirect()->route('home')->with('notif', 'Password telah berhasil diubah');
                }

                else{
                    return redirect()->route('profiles.index')->with('notif_error', 'Password baru tidak boleh sama dengan password lama!');
                }
            }

            else{
                return redirect()->route('profiles.index')->with('notif_error', 'Konfirmasi password baru tidak tepat! silahkan masukkan kembali. ');
            }

        }

        else{
            return redirect()->route('profiles.index')->with('notif_error', 'Password lama tidak tepat! silahkan coba lagi. ');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
