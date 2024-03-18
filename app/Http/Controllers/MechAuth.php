<?php

namespace App\Http\Controllers;


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class MechAuth
{
    public $user;

    public function __construct($user) {
        $this->user = $user;
    }

}