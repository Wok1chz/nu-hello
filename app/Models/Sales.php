<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    public function scopeActive(Builder $query): void
    {
        $now = Carbon::now();
        $query->where('start_date', '<=', $now)->where(function ($query) use ($now) {
            $query->where('end_date', null)
                ->orWhere('end_date', '>=', $now);
        });
    }
}
