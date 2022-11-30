<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Madjou\Product;
use App\Services\SycnMadjou\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\Blog;
use App\Models\BlogLog;
use App\Models\Dashboard;
use Illuminate\Support\Facades\DB as FacadesDB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitor = BlogLog::select(FacadesDB::raw("COUNT(*) as count"), FacadesDB::raw("MONTH(created_at) as month"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(FacadesDB::raw("Month(created_at)"))
                    ->pluck('count', 'month');
 
        $labels = $visitor->keys();
        $data = $visitor->values();

        return view('dashboard', [
            'labels'    => $labels,
            'data'      => $data,
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
