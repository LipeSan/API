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
     * @param $value
     * @return string
     */
    public function getcreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * @param $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\Api\Models\User::class);
    }
}
