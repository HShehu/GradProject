<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
// use App;
// use DB;

class Blog extends Model
{
    use HasTranslations;

    protected $fillable =['image','image2'];
    public $translatable = ['title','content','image_notes','image2_notes','notes'];
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
