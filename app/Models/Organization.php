<?php

namespace App\Models;

class Organization extends Model
{
    //<editor-fold desc="Relationships">
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
    //</editor-fold>
}
