<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification as ModelsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use App\Models\Subscribe;
use App\Notifications\SubscribeNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $notif   = ModelsNotification::where('lang', request()->header('lang') ?? 'id');


       return NotificationResource::collection($notif->paginate(10))->additional([
            'success'   => true,
            'message'   => 'Notifikasi berhasil ditampilkan'
       ]);
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
            'email'     => 'required|email',
            'body'      => 'required',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ],[
            'email.required'    => 'Email tidak boleh kosong',
            'body.required'     => 'Konten tidak boleh kosong'
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        if($image = $request->file('image'))
        {
            $fileNameWithExt   = $image->getClientOriginalName();
            $fileName          = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext               = $image->getClientOriginalExtension();
            $fileNameSave      = Str::uuid();
            $path              = $image->storeAs('public/notifications', $fileNameSave);

        }

        $notif  = Notification::create([
            'email' => $request->email,
            'body'  => $request->body,
            'image' => $fileName
        ]);

        $subscribes = Subscribe::all();

        foreach ($subscribes as $subscribe) {
            Notification::route('mail', $subscribe->email)
                    ->notify(new SubscribeNotification($notif));
        }

        return [
            'success'   => true,
            'message'   => 'Notification berhasil dikirim',
            'data'      => new NotificationResource($notif)
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
        $data = Validator::make($request->all(),[
            'email'     => 'required|email',
            'body'      => 'required',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ],[
            'email.required'    => 'Email tidak boleh kosong',
            'body.required'     => 'Konten tidak boleh kosong'
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $notif = ModelsNotification::findOrFail($id);

        if($request->hasFile('image') && $request->file('image') != null)
        {
            Storage::delete('public/notifications/'.$notif->image);
            
            $fileNameWithExt   = $request->file('image')->getClientOriginalName();
            $fileName          = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext               = $request->file('image')->getClientOriginalExtension();
            $fileNameSave      = Str::uuid();
            $path               = $request->file('image')->storeAs('public/notifications', $fileNameSave);
        }
        
        $notif->update([
            'email'             => $request->email,
            'body'              => $request->body,
            'image'             => $fileNameSave ?? $notif->image,
        ]);

        $subscribes = Subscribe::all();

        foreach ($subscribes as $subscribe) {
            Notification::route('mail', $subscribe->email)
                    ->notify(new SubscribeNotification($notif));
        }

        return [
            'success'   => true,
            'message'   => 'Notification berhasil dikirim',
            'data'      => new NotificationResource($notif)
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
        ModelsNotification::destroy($id);

        return [
            'success'   => true,
            'message'   => 'Notifikasi berhasil dihapus',
        ];
    }
}
