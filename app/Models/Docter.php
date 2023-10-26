<?php

namespace App\Models;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docter extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $with = ['user'];

    public function scopeFilter ($query, $doc_name)
    {
        if ($doc_name ?? false) {
            $query->whereHas('user', fn($query) =>
                $query
                    ->where('name', 'like', '%'. $doc_name .'%')
            );
        }
        return $query;
    }

        /**
     * Get the user that owns the Docter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the schedules for the Docter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

}
