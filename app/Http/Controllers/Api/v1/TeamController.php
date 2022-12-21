<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $data   = Team::where('lang', request()->header('lang') ?? 'id')->get();
        return response()->json([
            'success'   => true,
            'message'   => 'Data detail layanan berhasil ditampilkan',
            'data'      =>  TeamResource::collection($data),
        ]);
    }
}
