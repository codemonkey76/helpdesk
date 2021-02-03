<?php

namespace App\Models;

use App\BugsIndexConfigurator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use ScoutElastic\Searchable;

class Bug extends Model
{
    use HasFactory;
    use Searchable;

    protected $indexConfigurator = BugsIndexConfigurator::class;
    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text'
            ],
            'content' => [
                'type' => 'text'
            ]
        ]
    ];

    protected $appends = ['creator'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatorAttribute()
    {
        return "{$this->user->first_name} {$this->user->last_name}";
    }
}
