<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubsribeResource;
use App\Models\Subscribe;
use Illuminate\Http\Request;
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
        $data = Validator::make($request->all(),[
            'email'     => 'required|email|unique:subscribes',
        ], [
            'email.required'    => 'Email tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $subscribe  = Subscribe::create([
            'email'     => $request->email,
            'location'  => $request->getClientIp(),
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Subscribe telah berhasil',
            'data'      => new SubsribeResource($subscribe)
        ], 200);

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

        if($data->status == 1)
        {
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
        //
    }
}
