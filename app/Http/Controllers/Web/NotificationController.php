<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Jobs\SendNotifJobs;
use App\Models\Notification as ModelsNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
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
            $notif = ModelsNotification::latest()->get(); 
            return DataTables::of($notif)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.notifications.index')->with('notifications');
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

        SendNotifJobs::dispatch($notif);

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
        $notif = ModelsNotification::findOrFail($id);
        $notif->delete();
        Storage::delete('public/notifications/'.$notif->image);

        return [
            'success'   => true,
            'message'   => 'Notifikasi berhasil dihapus',
        ];

    }
}
