<?php

namespace App\Firebase;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\User;
use App\Http\Controllers\Firebase;

class FirebaseUserProvider implements UserProvider
{
   protected $hasher;
   protected $model;
   protected $auth;
   protected $db;
   public function __construct(HasherContract $hasher, $model)
   {
      $this->model = $model;
      $this->hasher = $hasher;
      //   $this->auth = app('firebase.auth');
      Firebase::initializeFirebase();
      $this->auth = Firebase::createAuth();
      $this->db = Firebase::createFirestore();
   }
   public function retrieveById($identifier)
   {
      $firebaseUser = $this->auth->getUser($identifier);
      $user = $this->auth->getUserByEmail($firebaseUser->email);
      $data = $this->db->database()->collection('users')->document($firebaseUser->uid)->snapshot()->data();
      $profileURL = $data['profile'];

      $notificationsData = $this->db->database()
         ->collection("appointment_notifications")
         ->where('client_id', '=', $firebaseUser->uid)
         ->documents();

      // dd($notificationsData);

      $notificationList = [];
      foreach ($notificationsData as $notification) {
         // Assuming each notification is an associative array
         $notificationList[] = $notification->data();
      }



      $user = new User([
         'localId' => $firebaseUser->uid,
         'email' => $firebaseUser->email,
         'displayName' => $firebaseUser->displayName,
         'profileURL' => $profileURL,
         'notifications' => $notificationList,
      ]);

      // dd($user);

      return $user;
   }

   public function retrieveByToken($identifier, $token)
   {
   }
   public function updateRememberToken(UserContract $user, $token)
   {
   }
   public function retrieveByCredentials(array $credentials)
   {
   }
   public function validateCredentials(UserContract $user, array $credentials)
   {
   }
}
