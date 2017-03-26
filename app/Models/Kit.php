<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'description', 'unit', 'price_origin', 'image', 'price', 'state'
    ];

    /**
     * @return $this
     */
    public function constructions()
    {
        return $this->belongsToMany(Construction::class)->withPivot('quantity');
    }
}
