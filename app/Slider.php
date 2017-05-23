<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image'
    ];

    /**
     * Get the article that owns the slider.
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
