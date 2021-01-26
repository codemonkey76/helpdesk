<?php

namespace App\Models;

class Ticket extends Model
{
    //<editor-fold desc="Fields">
    protected $casts = [
        'attachments' => 'array'
    ];
    //</editor-fold>

    //<editor-fold desc="Relationships">
    public function entries()
    {
        return $this->hasMany(TicketEntry::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    //</editor-fold>
}
