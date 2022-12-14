<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubsribeResource;
use App\Jobs\SendNotifJobs;
use App\Models\Subscribe;
use App\Notifications\SubscribeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
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
            'email'     => 'required|email',
        ], [
            'email.required'    => 'Email tidak boleh kosong',
            'email.email'    => 'Email yang digunakan tidak valid',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }
        $check = Subscribe::whereEmail($request->email)->get();

        if (count($check ?? []) == 0) {
            return [
                'success'   => true,
                'message'   => 'Terima kasih telah subscribe',
            ];
        }

        $subscribe  = Subscribe::create([
            'email'     => $request->email,
            'location'  => $request->getClientIp(),
        ]);

        // queue jobs
        SendNotifJobs::dispatch($subscribe);

        return [
            'success'   => true,
            'message'   => 'Terima kasih telah subscribe',
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
        $data = Subscribe::findOrFail($id);

        return response()->json([
            'success'   => true,
            'message'   => 'Data subscribe berhasil ditampilkan',
            'data'      => new SubsribeResource($data)
        ], 200);
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
        $data = Subscribe::findOrFail($id);

        if ($data->status == 1) {
            $data->update([
                'status'    => 0,
            ]);

            return response()->json([
                'success'   => true,
                'message'   => 'Anda berhasil unsubscribe',
                'data'      => new SubsribeResource($data),
            ], 200);
        }


        return response()->json([
            'success'   => true,
            'message'   => 'Anda berhasil subscribe',
            'data'      => new SubsribeResource($data),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subscribe::destroy($id);

        return [
            'success'   => true,
            'message'   => 'Data subscribe berhasil dihapus'
        ];
    }
}
