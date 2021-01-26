<?php

namespace App\Models;

class Contact extends Model
{
    //<editor-fold desc="Relationships">
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    //</editor-fold>
}
