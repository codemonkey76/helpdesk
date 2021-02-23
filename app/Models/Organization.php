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
    public function headOffice()
    {
        return $this->hasOne(Company::class);
    }
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }
    //</editor-fold>

    //<editor-fold desc="Attributes">
    public function getHeadOfficeNameAttribute()
    {
        return $this->headOffice->name;
    }
    //</editor-fold>
}
