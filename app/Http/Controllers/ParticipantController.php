<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addList()
    {

        $participant = Participant::All();
        return view('admin.festival',compact('participant'));
        // return view('admin.participant');
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
        
        $data = new Participant();
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->reason = $request->reason;

        // Generated Code
        $gen_code = Participant::generated_code($request->username,$request->email,$request->phone);
        $data->generate_code = $gen_code;

        // Save
        $data->save();
        
        return redirect()->back();
    }


    /**
     * Display the field username
     * @param string $username
     */

     public function search_username()
     {
         return view('search_user');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show_stat($username)
    {
        $userDec = Participant::decryptIt($username);
        $participant = Participant::where('username','=',$userDec)->get()->first();
        $allPart = Participant::All();
        foreach($allPart as $data){
            if($participant->id == $data->id){
                return view('participant_stat',compact('participant'));
                break;
            }
        }return redirect(route('cariaku'))->with('message','username not found');
    }

    public function show_stat_cari(Request $request)
    {
        $username = Participant::encryptIt($request->username);
        return redirect(route('show_stat',compact('username')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
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
