<?php

namespace Api\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Work
 * @package Api\Models
 */
class Construction extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'image', 'total'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getTotalAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return $this
     */
    public function kits()
    {
        return $this->belongsToMany(Kit::class)->withPivot('quantity');
    }
}
