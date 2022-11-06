<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    /*
        create log for blog
    */
    public static function createLog($post)
    {
        $log = BlogLog::whereIp(request()->getClientIp())
                ->where('created_at', ">" , now()->subMinutes(2))
                ->count();

        if(strpos(request()->getRequestUri(), "api") == true)
        {
            if($log <= 0)
            {
                BlogLog::create([
                    "blog_id"   => $post->id,
                    "ip"        => request()->getClientIp(),
                    "country"   => null,
                    "province"  => null,
                    "city"      => null,
                    "district"  => null,
                    "village"   => null,
                    "agent"     => request()->header("User-Agent"),
                    "os"        => null,
                ]);
            }
        }
    }

    protected $fillable = [
        'blog_category_id', 'title', 'slug', 'body',
        'image', 'tags', 'lang', 'author'
    ];

    public function getCategories(){
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }

    public function getTags()
    {
        return $this->belongsTo(Tag::class, 'tags_id', 'id');
    }
}
