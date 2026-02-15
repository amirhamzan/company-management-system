<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'website',
        'logo',
    ];

    protected $appends = ['logo_url'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo ? Storage::disk('public')->url($this->logo) : null;
    }
}
