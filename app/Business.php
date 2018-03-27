<?php

namespace App;

class Business extends User
{
    public function coursesMade() {
        return $this->hasMany(Course::class);
    }
}
