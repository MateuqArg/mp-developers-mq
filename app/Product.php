<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'img'];

    public function unique()
    {
        return $this->hasOne('App\Unique');
    }

    public function offer()
    {
        return $this->hasOne('App\Offer');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function scopeFindByCategorySlug($query, $slug)
	{
    	return $query->whereHas('category', function ($query) use 	($categorySlug) {
        	$query->where('slug', $slug);
    	});
	}
}
