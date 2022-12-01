<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageHistoryResource;
use App\Http\Resources\NotificationResource;
use App\Mail\MailCustomer;
use App\Mail\ReplyCustomerMail;
use App\Models\Message;
use App\Models\MessageHistory;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $message = Message::latest()->get();
            
            return DataTables::of($message)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.messages.index')->with('messages');
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
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message    = Message::findOrFail($id);

        return view('pages.message.index',[
            'message'   => $message
        ]);
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
        // $data = Validator::make($request->all(),[
        //     'email'        => 'required',
        //     'company'           => 'required',
        //     'phone'            => 'required',
        //     'text'           => 'required',
        //      'requirement'  => 'required',
        //     'from'          => 'required',
        // ], [
        //     'email.required'    => 'Pesan tidak boleh kosong',
        //     'company.required'       => 'User tidak boleh kosong',
        //     'phone.required'        => 'Email tidak boleh kosong',
        //     'text.required'       => 'Isi pesan tidak boleh kosong',
        //     'requirement.required'       => 'Isi pesan tidak boleh kosong',
        //     'from.required'       => 'Isi pesan tidak boleh kosong',
        // ]);

        // if($data->fails())
        // {
        //     return response()->json([
        //         'status'    => false,
        //         'errors'    => $data->getMessageBag()->toArray()
        //     ]);
        // }

        $message = Message::findOrFail($id);
        // $message->update([
        //     'email'         => $message->email,
        //     'company'       => $message->company,
        //     'phone'         => $message->phone,
        //     'text'          => $message->text,
        //     'requirement'   => $message->requirement,
        //     'from'          => $message->from,
        //     'ip'            => $message->getClientIp(),
        //     'country'       => $message->country,
        // ]);

        if($message)
        {
            $messHistory    = MessageHistory::create([
                'message_id'    => $message->id,
                'user_id'       => Auth::user()->id,
                'status'        => 'read',
                // 'subject'       => $request->subject,
                'comment'       => $request->comment,
            ]);

            Mail::to($message->email)->send(new ReplyCustomerMail($messHistory));

            return [
                'success'   => true,
                'message'   => 'History pesan berhasil disimpan',
                'data'      => new MessageHistoryResource($messHistory)
            ];
        }
        
        return [
            'success'   => true,
            'message'   => 'Pesan berhasil diupdate',
            'data'      => new Message($message)
        ];
       


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::destroy($id);

        return [
            'success'   => true,
            'message'   => 'Pesan berhasil dihapus',
        ];
    }
}
