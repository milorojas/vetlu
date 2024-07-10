<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country',
        'phone',
        'email',
        'image',
        'status',
    ];

    /**
     * Make it available in the json response
     */
    protected $appends = ['photo_url'];

    /**
     * Get the default photo URL if no photo has been uploaded.
     *
     * @return string
     */
    protected function getPhotoUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/'.$this->image);
        }

        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=6366f1&background=e0e7ff';
    }
}
