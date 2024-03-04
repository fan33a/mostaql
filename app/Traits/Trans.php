<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait Trans {
    // Recommended use function name like this
    public function getTransNameAttribute() {
        $name = json_decode($this->name, true); // return the JSON as ass array
        $lang = App::getLocale(); // return app local language
        if(!is_null($name)){ // if name not null retrun the name by a webist language
            return $name[$lang];
        }
        // else return the origin name
        return $this->name;
    }

    public function getEnNameAttribute() {
        $name = json_decode($this->name, true);
        if(!is_null($name)){
            return $name['en'];
        }
        return $this->name;
    }

    public function getArNameAttribute() {
        $name = json_decode($this->name, true);
        if(!is_null($name)){
            return $name['ar'];
        }
        return $this->name;
    }
};