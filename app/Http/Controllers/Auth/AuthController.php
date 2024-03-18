<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use App\Mail\RegisterMail;
use App\Models\refbrgy;
use Str;
use Mail;
use App\Http\Controllers\Firebase;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    protected $auth;
    protected $firestore;
    protected $storage;


    public function __construct()
    {
        // Initialize Firebase instances in the constructor
        Firebase::initializeFirebase();
        $this->auth = Firebase::createAuth();
        $this->firestore = Firebase::createFirestore();
        $this->storage = Firebase::createStorage();
    }


    /* display login page */
    public function ViewLogin()
    {
        return view('auth/login');
    }

    /* display Signup page for Mechanic */
    public function ViewSignupMechanic()
    {
        $barangay = refbrgy::orderBy('brgyDesc', 'asc')->get();
        return view('auth/signupmechanic', compact('barangay'));
    }

    /* display Signup page for Shop Owner */
    public function ViewSignupShop()
    {
        $barangay = refbrgy::orderBy('brgyDesc', 'asc')->get();
        return view('auth/signupshop', compact('barangay'));
    }

    /* display Signup page for Customer/Vehicle Owner */
    public function ViewSignupVehicle()
    {
        $barangay = refbrgy::orderBy('brgyDesc', 'asc')->get();
        return view('auth/signupvehicle', compact('barangay'));
    }

    /* display Email Message for Customer/Vehicle Owner */
    public function ViewSignupVehicleSuccess()
    {
        return view('auth.emailverification');
    }

    /* proccess user login information */
    public function loginAction(Request $request)
    {

        $signInResult = $this->auth->signInWithEmailAndPassword($request['username'], $request['password']);
        $uid = $signInResult->firebaseUserId();
        $user_rec = $this->auth->getUser($uid);
        $verified = $user_rec->emailVerified;

        $user = new User($signInResult->data());
        if(!$user) {
            return redirect()->back()->with('error', 'Please check your email/password');
        } 
        if(!$verified){
            $email = $user->getEmailForVerification();
            try{
                $this->auth->sendEmailVerificationLink($email);
            }catch(Exception $e) {

            }
            return redirect()->back()->with('error', "Please verify your email addresss.");
        }
        Auth::login($user);
        return redirect()->route('index');
    }

    /* creation of user client */
    public function CreateClient(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'street' => 'required|string',
            'landmark' => 'nullable|string',
            'contact_number' => 'required|digits:11',
            'valid_id' => 'required|image|mimes:jpeg,png,jpg|max:20048',
            'profile' => 'required|image|mimes:jpeg,png,jpg|max:20048',
            'email' => 'required|email|unique:users',
            'sex' => 'required|string|in:Male,Female',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'terms_and_conditions' => 'required|accepted',
        ]);

        $validIdUrl = '';
        $inputEmail = $request->input('email');

        // Upload valid ID image if provided
        if ($request->hasFile('valid_id')) {
            $image = $request->file('valid_id');
            $imageExtension =  $image->getClientOriginalExtension();
            $storagePath = 'valid_ids/' . $inputEmail . '.' . $imageExtension;
            $this->storage->getBucket()->upload(file_get_contents($image->getPathname()), ['name' => $storagePath]);
            $validIdUrl = $this->storage->getBucket()->object($storagePath)->signedUrl(now()->addYears(3));
        }
        $profileUrl = '';
        // Upload valid ID image if provided
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $imageExtension =  $image->getClientOriginalExtension();
            $storagePath = 'profiles/' . $inputEmail . '.' . $imageExtension;
            $this->storage->getBucket()->upload(file_get_contents($image->getPathname()), ['name' => $storagePath]);
            $profileUrl = $this->storage->getBucket()->object($storagePath)->signedUrl(now()->addYears(3));
        }

        $user_data = [
            'name' => [
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'suffix' => $request->input('suffix'),
            ],
            'address' => [
                'province' => $request->input('province'),
                'city' => $request->input('city'),
                'barangay' => $request->input('barangay'),
                'street' => $request->input('street'),
                'landmark' => $request->input('landmark'),
            ],
            'contact_number' => $request->input('contact_number'),
            'valid_id' => $validIdUrl,
            'profile' => $profileUrl,
            'email' => $request->input('email'),
            'sex' => $request->input('sex'),
            'username' => $request->input('username'),
            'type' => 'client'
        ];

        $display_name = $user_data['name']['first_name'];
        if (!empty($user_data['name']['middle_name'])) {
            $display_name .= ' ' . strtoupper($user_data['name']['middle_name'][0]) . '.';
        }
        $display_name .= ' ' . $user_data['name']['last_name'];
        if (!empty($user_data['name']['suffix'])) {
            $display_name .= ' ' . $user_data['name']['suffix'];
        }
        

        $createdUser = $this->auth
            ->createUserWithEmailAndPassword($request->input('email'), $request->input('password'));

        $uid = $createdUser->uid;
        $this->auth->updateUser($uid, ['displayName' => $display_name, 'photoUrl' => $profileUrl]);
        $this->auth->sendEmailVerificationLink($request->input('email'));

        $result = $this->firestore->database()->collection('users')->document($uid)->set($user_data);

        return redirect()->route('signup.vehicle-success')->with('email', $request->input('email'));
    }

    public function CreateMechanic(Request $request)
    {
        
        // Validate the incoming request data
        // $request->validate([
        //     'first_name' => 'required|string',
        //     'middle_name' => 'nullable|string',
        //     'last_name' => 'required|string',
        //     'suffix' => 'nullable|string',
        //     'province' => 'required|string',
        //     'city' => 'required|string',
        //     'barangay' => 'required|string',
        //     'street' => 'required|string',
        //     'landmark' => 'nullable|string',
        //     'contact_number' => 'required|digits:11',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string',
        //     'confirm_password' => 'required|same:password',
        //     'terms_and_conditions' => 'required|accepted',
        //     'type_of_workshop' => 'required|string',
        //     'valid_id' => 'required|image|mimes:jpeg,png,jpg|max:20048',
        //     'profile' => 'required|image|mimes:jpeg,png,jpg|max:20048',
        // ]);

        $validIdUrl = '';
        $inputEmail = $request->input('email');

        // Upload valid ID image if provided
        if ($request->hasFile('valid_id')) {
            $image = $request->file('valid_id');
            $imageExtension =  $image->getClientOriginalExtension();
            $storagePath = 'valid_ids/' . $inputEmail . '.' . $imageExtension;
            $this->storage->getBucket()->upload(file_get_contents($image->getPathname()), ['name' => $storagePath]);
            $validIdUrl = $this->storage->getBucket()->object($storagePath)->signedUrl(now()->addYears(3));
        }
        $profileUrl = '';
        // Upload valid ID image if provided
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $imageExtension =  $image->getClientOriginalExtension();
            $storagePath = 'profiles/' . $inputEmail . '.' . $imageExtension;
            $this->storage->getBucket()->upload(file_get_contents($image->getPathname()), ['name' => $storagePath]);
            $profileUrl = $this->storage->getBucket()->object($storagePath)->signedUrl(now()->addYears(3));
        }

        $user_data = [
            'name' => [
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'suffix' => $request->input('suffix'),
            ],
            'address' => [
                'province' => $request->input('province'),
                'city' => $request->input('city'),
                'barangay' => $request->input('barangay'),
                'street' => $request->input('street'),
                'landmark' => $request->input('landmark'),
            ],
            'contact_number' => $request->input('contact_number'),
            'type_of_workshop' => $request->input('type_of_workshop'),
            'email' => $request->input('email'),
            'sex' => $request->input('sex'),
            'username' => $request->input('username'),
            'type' => 'mechanic',
            'valid_id' => $validIdUrl,
            'profile' => $profileUrl,
        ];

        $display_name = $user_data['name']['first_name'];
        if (!empty($user_data['name']['middle_name'])) {
            $display_name .= ' ' . strtoupper($user_data['name']['middle_name'][0]) . '.';
        }
        $display_name .= ' ' . $user_data['name']['last_name'];
        if (!empty($user_data['name']['suffix'])) {
            $display_name .= ' ' . $user_data['name']['suffix'];
        }

        $createdUser = $this->auth
            ->createUserWithEmailAndPassword($request->input('email'), $request->input('password'));

        $uid = $createdUser->uid;

        $this->auth->updateUser($uid, ['displayName' => $display_name]);
        
        $this->auth->sendEmailVerificationLink($request->input('email'));

        $result = $this->firestore->database()->collection('users')->document($uid)->set($user_data);

        return redirect()->route('signup.vehicle-success')->with('email', $request->input('email'));
    }

    public function CreateShopAdmin(Request $request) //TODO optimize for shopowner
    {
        
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'street' => 'required|string',
            'landmark' => 'nullable|string',
            'contact_number' => 'required|digits:11',
            'shop_name' => 'required|string',
            'description' => 'required|string',
            'shop_logo' => 'required|image|mimes:jpeg,png,jpg|max:20048',
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg|max:20048',
        ]);

        // dd("hello");

        $coverPhotoUrl = '';
        $inputEmail = $request->input('email');

        // Upload valid ID image if provided
        if ($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $imageExtension =  $image->getClientOriginalExtension();
            $storagePath = 'cover_photos/' . $inputEmail . '.' . $imageExtension;
            $this->storage->getBucket()->upload(file_get_contents($image->getPathname()), ['name' => $storagePath]);
            $coverPhotoUrl = $this->storage->getBucket()->object($storagePath)->signedUrl(now()->addYears(3));
        }
        $profileUrl = '';
        // Upload valid ID image if provided
        if ($request->hasFile('shop_logo')) {
            $image = $request->file('shop_logo');
            $imageExtension =  $image->getClientOriginalExtension();
            $storagePath = 'shop_logos/' . $inputEmail . '.' . $imageExtension;
            $this->storage->getBucket()->upload(file_get_contents($image->getPathname()), ['name' => $storagePath]);
            $profileUrl = $this->storage->getBucket()->object($storagePath)->signedUrl(now()->addYears(3));
        }

        $user_data = [
            'name' => [
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'suffix' => $request->input('suffix'),
            ],
            'address' => [
                'province' => $request->input('province'),
                'city' => $request->input('city'),
                'barangay' => $request->input('barangay'),
                'street' => $request->input('street'),
                'landmark' => $request->input('landmark'),
            ],
            'contact_number' => $request->input('contact_number'),
            'email' => $request->input('email'),
            'type' => 'shop',
            'cover_photo' => $coverPhotoUrl,
            'profile' => $profileUrl,
            "shop_name" => $request->input('shop_name'),
            "description" => $request->input('description'),
        ];

        $display_name = $user_data['name']['first_name'];
        if (!empty($user_data['name']['middle_name'])) {
            $display_name .= ' ' . strtoupper($user_data['name']['middle_name'][0]) . '.';
        }
        $display_name .= ' ' . $user_data['name']['last_name'];
        if (!empty($user_data['name']['suffix'])) {
            $display_name .= ' ' . $user_data['name']['suffix'];
        }

        $createdUser = $this->auth
            ->createUserWithEmailAndPassword($request->input('email'), $request->input('password'));

        $uid = $createdUser->uid;

        $this->auth->updateUser($uid, ['displayName' => $display_name]);
        
        $this->auth->sendEmailVerificationLink($request->input('email'));

        $result = $this->firestore->database()->collection('users')->document($uid)->set($user_data);

        return redirect()->route('signup.vehicle-success')->with('email', $request->input('email'));
        // Redirect or return a response as needed
        // return redirect()->route('signup.vehicle-success')->with('email', $save->email);
    }

    public function verify($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();
            return redirect('login')->with('success', 'Account Verified Successfully!');
        } else {
            abort(404);
        }
    }

    /* logouts user account */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('index');
    }
}
