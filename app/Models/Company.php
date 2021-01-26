<?php

namespace App\Models;

class Company extends Model
{
    //<editor-fold desc="Relationships">
    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, Contact::class);
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    //</editor-fold>
}
