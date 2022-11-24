<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Mail\MailCustomer;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = Validator::make($request->all(), [
            'email'                 => 'required|email',
            'company'               => 'required',
            'phone'                 => 'required',
            'text'                  => 'required',
            'requirement'           => 'required',
            'from'                  => 'nullable',
        ], [
            'email.required'        => 'Email tidak boleh kosong',
            'email.email'           => 'Email tidak valid',
            'company.required'      => 'Perusahaan tidak boleh kosong',
            'phone.required'        => 'Telpon tidak boleh kosong',
            'text.required'         => 'Isi pesan tidak boleh kosong',
            'requirement.required'  => 'Kebutuhan tidak boleh kosong',
            'from.required'         => 'Tidak boleh kosong',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => $data->getMessageBag()->toArray()
            ]);
        }

        $message = Message::create([
            'email'         => $request->email,
            'company'       => $request->company,
            'phone'         => $request->phone,
            'text'          => $request->text,
            'requirement'   => $request->requirement,
            'from'          => $request->from,
            'ip'            => $request->getClientIp(),
            'country'       => $request->country,
        ]);

        $sendMessage = (new MailCustomer($message))->onQueue('emails');

        Mail::to('admin-madjou@test.com')->queue($sendMessage);

        return [
            'success'   => true,
            'message'   => 'Pesan berhasil dikirim',
        ];
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
