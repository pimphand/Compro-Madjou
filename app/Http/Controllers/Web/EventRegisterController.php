<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventRegisterResource;
use App\Models\Event;
use App\Models\EventRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EventRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $eventRegister = EventRegister::with('getEvent')->latest()->get();

            return DataTables::of($eventRegister)
                ->addColumn('event', function ($event) {
                    return $event->getEvent->title;
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.events.register')->with('registers', 'getEvent');
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
            // 'event_id'  => 'required',
            'name'      => 'required|',
            'email'     => 'required|',
            'phone'     => 'required|',
            'agency'    => 'required',
        ], [
            'event_id.required' => 'Event tidak boleh kosong!',
            'name.required'     => 'Nama tidak boleh kosong!',
            'email.required'    => 'E-mail tidak boleh kosong!',
            'phone.required'    => 'Nomor telpon tidak boleh kosong!',
            'agency.required'   => 'Instansi tidak boleh kosong!',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $event = EventRegister::create([
            'event_id'  => 1,
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'agency'    => $request->agency,
        ]);

        return [
            'success'   => true,
            'message'   => 'Pendaftaran event berhasil!',
            'data'      => new EventRegisterResource($event),
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
        $data = Validator::make($request->all(), [
            'event_id'  => 'required',
            'name'      => 'required|',
            'email'     => 'required|',
            'phone'     => 'required|',
            'agency'    => 'required',
        ], [
            'event_id.required' => 'Event tidak boleh kosong!',
            'name.required'     => 'Nama tidak boleh kosong!',
            'email.required'    => 'E-mail tidak boleh kosong!',
            'phone.required'    => 'Nomor telpon tidak boleh kosong!',
            'agency.required'   => 'Instansi tidak boleh kosong!',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $event = EventRegister::findOrFail($id);
        $event->update([
            'event_id'  => $request->event_id,
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'agency'    => $request->agency,
        ]);

        return [
            'success'   => true,
            'message'   => 'Pendaftaran event berhasil!',
            'data'      => new EventRegisterResource($event),
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
        $event = EventRegister::destroy($id);

        return [
            'success'   => true,
            'message'   => 'Data peserta event berhasil dihapus!',
        ];
    }
}
