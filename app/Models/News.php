<?php

namespace App\Models;

use App\Helper\CustomHelper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static $news;

    use Sluggable;
    protected static $project;

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function addNews($request)
    {

        self::$news = new News();
        self::$news->category_id    = $request->category_id;
        self::$news->user_id        = $request->user_id;
        self::$news->title          = $request->title;
        self::$news->description    = $request->description;
        self::$news->image          = CustomHelper::imageUpload($request->file('image'),'back-end/img/news_image/');
        self::$news->date           = $request->date;
        self::$news->tag            = $request->tag;
        self::$news->status         = $request->status;
        self::$news->save();

    }
    public static function updateNews($request, $id)
    {
        self::$news = News::find($id);
        self::$news->category_id    = $request->category_id;
        self::$news->user_id        = $request->user_id;
        self::$news->title          = $request->title;
        self::$news->description    = $request->description;
        self::$news->image          = CustomHelper::imageUpload($request->file('image'),'back-end/img/news_image/', self::$news->image);
        self::$news->date           = $request->date;
        self::$news->tag            = $request->tag;
        self::$news->slug           = $request->slug;
        self::$news->status         = $request->status;
        self::$news->save();
    }
    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class,'category_id');
    }
    public function userTypeBlog()
    {
        return $this->belongsTo(AdminUser::class,'user_id');
    }
    public function blogCategory()
    {
        return $this->belongsTo(NewsCategory::class,'category_id');
    }
}
