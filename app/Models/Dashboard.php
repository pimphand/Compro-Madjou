<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Dashboard
{
    public static function pageLog($filter = [])
    {
        $startDate = $filter['startDate'] ?? now()->startOfMonth();
        $endDate = $filter['endDate'] ?? now();

        $date = DB::table('page_logs')
            ->select(
                DB::raw('date(created_at) as date'),
                // DB::raw('distinct(page) as page'),
                DB::raw('count(distinct id) as total'),
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $mostVisits = DB::table('page_logs')
            ->select(
                DB::raw('page as page'),
                DB::raw('count(distinct id) as total'),
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('page')
            ->orderBy('page')
            ->get();

        $visitors = DB::table('page_logs')->whereBetween('created_at', [$startDate, $endDate])->count();
        return [
            "date" => $date,
            "mostVisits" => $mostVisits,
            "visitor" => $visitors
        ];
    }

    public function blogLog($filter = [])
    {
        $startDate = $filter['startDate'] ?? now()->startOfMonth();
        $endDate = $filter['endDate'] ?? now();

        $date = DB::table('blog_logs')
            ->select(
                DB::raw('date(created_at) as date'),
                // DB::raw('distinct(page) as page'),
                DB::raw('count(distinct id) as total'),
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $mostVisits = DB::table('blogs')
            ->select(
                DB::raw('couriers.name  as page'),
                DB::raw('count(distinct id) as total'),
            )
            ->join('blog_logs', function ($join) {
                $join->on('blog_logs.blog_id', '=', 'blogs.id');
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('name')
            ->orderBy('name')
            ->get();

        return [
            "date" => $date,
            "mostVisits" => $mostVisits,
            "visitor" => $visitors ?? null
        ];
    }
}
