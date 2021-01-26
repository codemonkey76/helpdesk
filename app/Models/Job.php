<?php

namespace App\Models;

class Job extends Model
{
    //<editor-fold desc="Relationships">
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
    //</editor-fold>
}
