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
    public function getTransDescriptionAttribute() {
        $description = json_decode($this->description, true); // return the JSON as ass array
        $lang = App::getLocale(); // return app local language
        if(!is_null($description)){ // if description not null retrun the description by a webist language
            return $description[$lang];
        }
        // else return the origin description
        return $this->description;
    }

    public function getEnDescriptionAttribute() {
        $description = json_decode($this->description, true);
        if(!is_null($description)){
            return $description['en'];
        }
        return $this->description;
    }

    public function getArDescriptionAttribute() {
        $description = json_decode($this->description, true);
        if(!is_null($description)){
            return $description['ar'];
        }
        return $this->description;
    }
};