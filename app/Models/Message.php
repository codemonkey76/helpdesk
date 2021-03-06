<?php

namespace App\Models;

use App\MessagesIndexConfigurator;
use App\Scopes\NotArchivedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use Laravel\Scout\Searchable;


class Message extends Model
{
    use HasFactory;
    use Searchable;

//    protected $indexConfigurator = MessagesIndexConfigurator::class;
//    protected $searchRules = [
//
//    ];
    protected $guarded = [];

//    protected $mapping = [
//        'properties' => [
//            'body' => [
//                "type" => "text"
//            ],
//        ]
//    ];

    protected static function booted()
    {
        static::addGlobalScope(new NotArchivedScope);
    }

    protected $appends = ['fromUser', 'toUser', 'bodyExcerpt'];
//    public function toSearchableArray()
//    {
//        return [
//            'body' => $this->body
//        ];
//    }
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
    public function archive() {
        $this->update(['archived' => true]);
    }
    public function unarchive() {
        $this->update(['archived' => false]);
    }
}
