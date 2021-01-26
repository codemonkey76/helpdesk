<?php

namespace App\Models;

class Domain extends Model
{
    //<editor-fold desc="Relationships">
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    //</editor-fold>
}
