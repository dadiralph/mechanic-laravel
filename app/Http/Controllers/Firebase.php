<?php

namespace App\Http\Controllers;


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Contract\Storage as Storage;
use Kreait\Firebase\Contract\Auth as firebaseAuth;
use Kreait\Firebase\Contract\Firestore as Firestore;

class Firebase
{
    public static $firebase;

    public static function initializeFirebase()
    {
        // $serviceAccount = ServiceAccount::fromValue([
        //     "apiKey" => "AIzaSyAUnj0N-M99e-lF8mmruqAwfRvOmLzUvxE",
        //     "authDomain" => "mechanic-assistance-3b77d.firebaseapp.com",
        //     "projectId" => "mechanic-assistance-3b77d",
        //     "storageBucket" => "mechanic-assistance-3b77d.appspot.com",
        //     "messagingSenderId" => "564842703163",
        //     "appId" => "1:564842703163:web:f22a526830a1a0a5f3af1e"
        // ]);
        self::$firebase = (new Factory)
            ->withServiceAccount(__DIR__ . "/firebase.json");
    }

    public static function createAuth(): firebaseAuth {
        return self::$firebase->createAuth();
    }

    public static function createFirestore(): Firestore {
        return self::$firebase->createFirestore();
    }

    public static function createStorage(): Storage {
        return self::$firebase->createStorage();
    }

}