<?php

namespace App\Models;

use App\MessagesIndexConfigurator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use ScoutElastic\Searchable;

class Message extends Model
{
    use HasFactory;
    use Searchable;

    protected $indexConfigurator = MessagesIndexConfigurator::class;
    protected $searchRules = [

    ];
    protected $guarded = [];

    protected $mapping = [
        'properties' => [
            'body' => [
                "type" => "text"
            ],
        ]
    ];
    protected $appends = ['fromUser', 'toUser', 'bodyExcerpt'];
    public function toSearchableArray()
    {
        return [
            'body' => $this->body
        ];
    }
    public function getFromUserAttribute()
    {
        return $this->from->first_name .' '. $this->from->last_name;
    }
    public function getToUserAttribute()
    {
        return $this->to->first_name . ' ' . $this->to->last_name;
    }
    public function getBodyExcerptAttribute()
    {
        $stripped = strip_tags(str_replace("<", " <", $this->body), ['strong', 'i']);
        $append = "...";
        if (Str::length($stripped)<100)
            $append = "";

        return Str::substr($stripped, 0, 100) . $append;
    }
    public function from()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
    public function to()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
