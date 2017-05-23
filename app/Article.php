<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_by', 'updated_by', 'created_at', 'updated_at',
    ];

    /**
     * Get the sliders for the article.
     */
    public function sliders()
    {
        return $this->hasMany('App\Slider');
    }
}
