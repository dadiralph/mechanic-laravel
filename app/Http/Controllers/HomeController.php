<?php

namespace App\Http\Controllers;

use App\Models\appointmentnotification;
use App\Models\vehicleservice;
use Illuminate\Http\Request;
use App\User;
use App\Models\appointment;
use App\Models\mechanicservice;
use App\Models\appointmentvehicle;
use Carbon\Carbon;
use Pusher\Pusher;
use App\Http\Controllers\Firebase;
use Auth;
use App\Models\refbrgy;



class HomeController extends Controller
{
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

    // display home page at start
    public function ViewHomePage()
    {
        $mechanics = [];
        $user = Auth::user();
        if ($user == null) {
            return view('users.index', compact('mechanics'));
        }

        // dd("hi");
        $uid = $user->localId;

        $data = $this->firestore->database()->collection("users")->document($uid)->snapshot()->data();
        $type = $data["type"];

        $query = $this->firestore->database()->collection("users")->where("type", "=", "mechanic")->where("type_of_workshop", "=", "1")->documents();
        foreach ($query as $freelancer) {
            // $freelancers[] = $freelancer->data
            $data = $freelancer->data();
            $data["id"] = $freelancer->id();
            array_push($mechanics, $data);
        }
        // dd("hi");
        


        // dd($mechanics);
        if ($type == "client") {
            return view('users.index', compact('mechanics'));
        } else if ($type == "shop") {
            return redirect()->route('shop');
        } else {
            return redirect()->route('mechanic');
        }
    }

    public function searchAction(Request $request)
    {
        $search = $request->input("search");
        // dd($search);
        $mechanics = [];
        $user = Auth::user();
        if ($user == null) {
            return view('users.index', compact('mechanics'));
        }
        $uid = $user->localId;

        $data = $this->firestore->database()->collection("users")->document($uid)->snapshot()->data();
        $type = $data["type"];

        $query = $this->firestore->database()->collection("users")->where("type", "=", "mechanic")->where("type_of_workshop", "=", "1")->documents();
        foreach ($query as $freelancer) {
            // $freelancers[] = $freelancer->data
            $data = $freelancer->data();
            $data["id"] = $freelancer->id();
            // Check if any field in $data contains $search
            $found = false;
            foreach ($data as $field) {
                if (is_array($field)) {
                    // If the field is an array, search within its elements
                    foreach ($field as $element) {
                        if (stripos($element, $search) !== false) {
                            $found = true;
                            break 2; // Break out of both inner and outer loops
                        }
                    }
                } else {
                    // If the field is not an array, directly search within it
                    if (stripos($field, $search) !== false) {
                        $found = true;
                        break;
                    }
                }
            }

            $index = 0;
            

            $servicesColRef = $freelancer->reference()->collection("services");
            $documents = $servicesColRef->documents();
            $servicesList = [];
            foreach ($documents as $document) {
                $servicedata = $document->data();
                $servicesList[] = $servicedata['service'];
            }

            foreach ($servicesList as $service) {
                if (stripos($service, $search) !== false) {
                    $found = true;
                    break;
                }
            }

            $data["services"] = $servicesList;

            // If $search is found in any field, add it to the $mechanics array
            if ($found) {
                array_push($mechanics, $data);
            }
        }

        // dd($mechanics);
        return view('users.search', compact('mechanics', 'search'));
    }

    // display hire form page
    public function ViewHireForm(string $id)
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect('login');
        }
        $mechSnapshot = $this->firestore->database()->collection("users")->document($id)->snapshot();
        $mechanic = $this->firestore->database()->collection("users")->document($id)->snapshot()->data();
        $mechanic["id"] = $mechSnapshot->id();
        $currentDateTime = Carbon::now();

        $servicesColRef = $mechSnapshot->reference()->collection("services");
        $documents = $servicesColRef->documents();

        $servicesList = [];

        foreach ($documents as $document) {
            $data = $document->data();
            $servicesList[] = $data['service'];
        }

        return view('users.hire', compact('mechanic', 'currentDateTime', 'servicesList'));
    }

    function generateRandomID($length = 12)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomID = '';

        for ($i = 0; $i < $length; $i++) {
            $randomID .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomID;
    }

    public function MakeAppointment(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'date_start' => 'required|date',
            'make' => 'required',
            'model' => 'required',
            'services.*' => 'required',
            'problem_image' => 'nullable|image|mimes:jpeg,png,jpg|max:20048',
        ]);

        $appointmentData = [
            "appointment_type" => $request->input('appointment_type'),
            "mechanic_id" => $id,
            "client_id" => Auth::user()->localId,
            "date_start" => $request->input('date_start'),
            "status" => 'Pending',
            "start_time" => $request->input('start_time'),
            "end_time" => $request->input('end_time'),
        ];

        $appointmentReference = $this->firestore->database()->collection("appointments")->document($this->generateRandomID());
        $appointmentReference->set($appointmentData);


        // Save additional information to the appointmentvehicles table
        $make = $request->input('make');
        $model = $request->input('model');
        $notes = $request->input('note');
        $services = $request->input('services');
        $problem_image = $request->file('problem_image');
        $problem_image_url = '';

        if ($request->hasFile('problem_image')) {
            $imageExtension = $problem_image->getClientOriginalExtension();
            $storagePath = 'problem_images/' . $appointmentReference->id() . '.' . $imageExtension;
            $this->storage->getBucket()->upload(file_get_contents($problem_image->getPathname()), ['name' => $storagePath]);
            $problem_image_url = $this->storage->getBucket()->object($storagePath)->signedUrl(now()->addYears(3));
        }

        $appointmentVehicle = [
            "appointment_id" => $appointmentReference->id(),
            "make" => $make,
            "model" => $model,
            "notes" => $notes,
            "problem_image" => $problem_image_url,
        ];
        $appointmentVehicleReference = $this->firestore->database()->collection("appointment_vehicles")->document($this->generateRandomID());
        $appointmentVehicleReference->set($appointmentVehicle);

        // Save selected services for the current appointment vehicle
        $selectedServices = is_array($services) ? $services : [$services];
        foreach ($selectedServices as $serviceId) {
            $vehicleService = [
                "appointment_vehicle_id" => $appointmentVehicleReference->id(),
                "service_id" => $serviceId,
                "mechanic_id" => $id,
            ];
            $this->firestore->database()->collection("appointment_services")->document($this->generateRandomID())->set($vehicleService);
        }

        $appointmentNotification = [
            "client_id" => Auth::user()->localId,
            "mechanic_id" => $id,
            "message" => "You have a new pending appointment",
            "timestamp" => now()
        ];

        $this->firestore->database()->collection("appointment_notifications")->document($this->generateRandomID())->set($appointmentNotification);

        // $options = array(
        //     'cluster' => 'ap2',
        //     'useTLS' => true,
        // );

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );

        // $data = ['client_id' => $id];
        // $pusher->trigger('my-channel', 'my-event', $data);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Appointment have been sent successfully!');
    }

    // display Appointments of client
    public function ViewClientAppointment()
    {
        // // Get authenticated mechanic ID
        $clientId = Auth::user()->localId;

        // $appointments = appointment::where('client_id', $clientId)->get();

        // $pendingappointments = appointment::where('client_id', $clientId)
        //     ->where('status', 'Pending')
        //     ->get();

        // $completedappointments = appointment::where('client_id', $clientId)
        //     ->where('status', 'Completed')
        //     ->get();

        $query = $this->firestore->database()->collection("appointments")
            ->where("client_id", "=", $clientId)
            ->documents();

        $appointments = [];
        $pendingappointments = [];
        $completedappointments = [];
        $allappointments = [];

        foreach ($query as $appointment) {
            // $freelancers[] = $freelancer->data
            $data = $appointment->data();
            $data["id"] = $appointment->id();
            // $client = $this->firestore->database()->collection("users")->document($data["client_id"])->snapshot()->data();
            // $data["client"] = $client;
            switch ($data["status"]) {
                case "Pending":
                    array_push($pendingappointments, $data);
                    break;
                case "In Progress":
                    array_push($appointments, $data);
                    break;
                case "Pending completed":
                case "Completed":
                    array_push($completedappointments, $data);
                    break;
            }
            array_push($allappointments, $data);
        }

        return view('users.appointmentstatus', compact('appointments', 'pendingappointments', 'completedappointments', 'allappointments'));
    }

    // display workshops
    public function ViewWorkshop()
    {

        return view('users.workshop');
    }
    public function ViewFreelancers()
    {
        $freelancers = [];
        $query = $this->firestore->database()->collection("users")->where("type", "=", "mechanic")->where("type_of_workshop", "=", "1")->documents();
        foreach ($query as $freelancer) {
            // $freelancers[] = $freelancer->data
            $data = $freelancer->data();
            $data["id"] = $freelancer->id();

            $servicesColRef = $freelancer->reference()->collection("services");
            $documents = $servicesColRef->documents();
            $index = 0;
            $servicesList = [];
            foreach ($documents as $document) {
                if ($index < 3) {
                    $servicedata = $document->data();
                    $servicesList[] = $servicedata['service'];
                    $index = $index + 1;
                }
            }
            $data["services"] = $servicesList;

            array_push($freelancers, $data);
        }
        // dd($freelancers);
        return view('users.freelancers', compact('freelancers'));
    }

    public function ViewAppointmentModal($id)
    {
        // Fetch lot data by ID
        $appointment = appointment::find($id);

        // Check if the lot was not found
        if (!$appointment) {
            return response()->json(['error' => 'appointment not found'], 404);
        }

        $appointmentTime = trim("{$appointment->start_time} - {$appointment->end_time}");

        // Fetch appointment vehicle for the given lot ID
        $appointmentvehicle = appointmentvehicle::where('appointment_id', $appointment->id)->first();

        $vehicleservice = vehicleservice::where('appointment_vehicle_id', $appointmentvehicle->id)->first();

        $mechanicservice = mechanicservice::where('id', $vehicleservice->service_id)->get();
        // Return lot data as JSON response
        return response()->json([
            'appointment_type' => $appointment->appointment_type,
            'date_start' => $appointment->date_start,
            'model' => $appointmentvehicle->model,
            'make' => $appointmentvehicle->make,
            'notes' => $appointmentvehicle->notes,
            'problem_images' => $appointmentvehicle->problem_images,
            'time' => $appointmentTime,
            'mechanic_services' => $mechanicservice,
            // Add other columns as needed
        ]);
    }

    // display get started
    public function ViewGetstarted()
    {

        return view('users.getstarted');
    }

    public function Viewchat()
    {
        $query = $this->firestore->database()->collection("convos")->where("client", "=", Auth::user()->localId);
        $convos = [];
        foreach ($query->documents() as $convoSnaps) {
            $convoData = $convoSnaps->data();
            $receiverId = $convoData["receiver"];
            $receiverRef = $this->firestore->database()->collection("users")->document($receiverId);
            $convoData["receiver_data"] = $receiverRef->snapshot()->data();
            $convos[] = $convoData;
        }
        return view('users.messages', compact('convos'));
    }

    public function ViewchatbyID($id)
    {
        if (Auth::user() == null) {
            return view('auth/login');
        }

        $contactRef = $this->firestore->database()->collection("users")->document($id);
        $contact = $contactRef->snapshot()->data();
        $contact["id"] = $id;


        $convosquery = $this->firestore->database()->collection("convos")->where("client", "=", Auth::user()->localId);
        $convos = [];
        foreach ($convosquery->documents() as $convoSnaps) {
            $convoData = $convoSnaps->data();
            $receiverId = $convoData["receiver"];
            $receiverRef = $this->firestore->database()->collection("users")->document($receiverId);
            $convoData["receiver_data"] = $receiverRef->snapshot()->data();
            $convos[] = $convoData;
        }
        return view('users.message', compact('contact', 'convos'));
    }

    public function GetChat($id)
    {
        $query = $this->firestore->database()->collection("convos")->where("receiver", "=", $id)->limit(1);
        $convoRef = null;
        foreach ($query->documents() as $convo) {
            $convoRef = $convo->reference();
        }
        $messagesQuery = $convoRef->collection("messages")->documents();
        $messages = [];

        foreach ($messagesQuery as $messageSnap) {
            $messageData = $messageSnap->data(); // Retrieve the data of the message
            $messages[] = $messageData; // Add the message data to the messages array
        }

        usort($messages, function ($a, $b) {
            return strtotime($a['timestamp']) - strtotime($b['timestamp']);
        });


        // return response()->json(['message' => 'message received', 'data' => json_encode($messagesQuery)]);
        return response()->json(['message' => 'messages received', 'data' => $messages]);
    }

    public function SendChatMessage(Request $request)
    {
        // Process your chat message data
        $messageData = $request->all();
        $currentTimestamp = now();
        $messageData["timestamp"] = $currentTimestamp;

        $query = $this->firestore->database()->collection("convos")->where("receiver", "=", $messageData["receiver"])->limit(1);
        $convoRef = null;
        foreach ($query->documents() as $convo) {
            $convoRef = $convo->reference();
        }

        $convoID = null;
        if ($convoRef == null) {
            $convoID = $this->generateRandomID();
        } else {
            $convoID = $convoRef->id();
        }

        $convoData = [
            'latest_timestamp' => $currentTimestamp,
            'client' => Auth::user()->localId,
            'receiver' => $messageData["receiver"],
            'last_message' => $messageData["message"],
        ];
        $this->firestore->database()->collection("convos")->document($convoID)->set($convoData);
        $this->firestore->database()->collection("convos")->document($convoID)->collection("messages")->newDocument()->set($messageData);
        // Return a response (e.g., JSON response)
        return response()->json(['message' => 'Message sent successfully', 'data' => $messageData]);
    }


    public function cancelAppointment(Request $request)
    {
        $appointmentId = $request->input('appointmentId');

        // Find the appointment by ID
        $appointment = appointment::find($appointmentId);

        // Check if the appointment exists and its status is "Pending"
        if ($appointment && $appointment->status === 'Pending') {
            // Update the status to "Cancelled"
            $appointment->status = 'Cancelled';
            $appointment->save();

            return redirect()->back()->with('success', 'Appointment cancelled successfully!');
        } else {
            // Display an error message using toastr or any other preferred method
            return redirect()->back()->with('error', 'This appointment cannot be cancelled.');
        }
    }

    public function confirmcompleteAppointment(Request $request)
    {
        $appointmentId = $request->input('appointmentId');
        $appointmentRef = $this->firestore->database()->collection('appointments')->document($appointmentId);
        $appointmentData = $appointmentRef->snapshot()->data();
        // dd($appointmentData);

        $mechanicId = $appointmentData["mechanic_id"];
        $mechanicRef = $this->firestore->database()->collection('users')->document($mechanicId);
        $mechanicData = $mechanicRef->snapshot()->data();

        $rating = $request->input("starRating");

        if (array_key_exists("reviews", $mechanicData)) {
            // dd("ji");
            $mechanicReviews = $mechanicData["reviews"];
            $mechanicRating = $mechanicData["ratings"];

            $mechanicRating = ($mechanicReviews * $mechanicRating);
            $mechanicRating = $mechanicRating + $rating;
            // dd($mechanicRating);
            // dd($mechanicRating / ($mechanicReviews + 1));
            $mechanicRating = $mechanicRating / ($mechanicReviews + 1);

            $mechanicData["reviews"] = $mechanicReviews + 1;
            $mechanicData["ratings"] = $mechanicRating;
        } else {
            $mechanicData["reviews"] = 1;
            $mechanicData["ratings"] = $rating;
        }


        // dd($mechanicData);

        // Find the appointment by ID and update its status
        if ($appointmentData) {
            $data = [
                ['path' => 'status', 'value' => 'Completed'],
            ];
            $appointmentRef->update($data);
            // // Find the appointment by ID and update its is_read
            // $appointmentnotification = appointmentnotification::where('appointment_id', $appointmentId)->first();
            // if ($appointmentnotification) {
            //     $appointmentnotification->is_read = '1';
            //     $appointmentnotification->save();
            // }
        }

        if ($mechanicData) {
            $data = [
                ['path' => 'reviews', 'value' => $mechanicData['reviews']],
                ['path' => 'ratings', 'value' => $mechanicData['ratings']],
            ];
            $mechanicRef->update($data);
        }

        return redirect()->back()->with('success', 'Appointment approved successfully!');
    }


    public function GetShopsJson()
    {
        $query = $this->firestore->database()->collection("users")->where("type", "=", "shop");
        $shops = [];
        foreach ($query->documents() as $shopSnaps) {
            $convoData = $shopSnaps->data();
            $convoData['id'] = $shopSnaps->id();
            $shops[] = $convoData;
        }
        return response()->json(['shops' => $shops]);
    }

    public function ViewClientSettings()
    {
        $barangay = refbrgy::orderBy('brgyDesc', 'asc')->get();
        $ref = $this->firestore->database()->collection('users')->document(Auth::user()->localId);
        $user = $ref->snapshot()->data();
        return view('users.settings', compact('user', 'barangay'));
    }

    public function ChangeName(Request $request)
    {
        $update = [
            [
                'path' => 'name',
                'value' => [
                    'first_name' => $request->input('first_name'),
                    'middle_name' => $request->input('middle_name'),
                    'last_name' => $request->input('last_name'),
                    'suffix' => $request->input('suffix'),
                ]
            ],
        ];
        $id = Auth::user()->localId;
        $userRef = $this->firestore->database()->collection('users')->document($id);
        $userRef->update($update);

        $user_data = $userRef->snapshot()->data();
        $display_name = $user_data['name']['first_name'];
        if (!empty($user_data['name']['middle_name'])) {
            $display_name .= ' ' . strtoupper($user_data['name']['middle_name'][0]) . '.';
        }
        $display_name .= ' ' . $user_data['name']['last_name'];
        if (!empty($user_data['name']['suffix'])) {
            $display_name .= ' ' . $user_data['name']['suffix'];
        }
        $this->auth->updateUser($id, ['displayName' => $display_name]);
        return redirect()->route('settings.client');
    }

    public function ChangeLocation(Request $request)
    {
        $update = [
            [
                'path' => 'address',
                'value' => [
                    'province' => $request->input('province'),
                    'city' => $request->input('city'),
                    'barangay' => $request->input('barangay'),
                    'street' => $request->input('street'),
                    'landmark' => $request->input('landmark'),
                ]
            ],
            [
                'path' => 'contact_number',
                'value' => $request->input('contact_number'),
            ],

        ];
        $id = Auth::user()->localId;
        $userRef = $this->firestore->database()->collection('users')->document($id);
        $userRef->update($update);
        return redirect()->route('settings.client');
    }

    public function ChangeProfile(Request $request)
    {
        $inputEmail = Auth::user()->email;
        $profileUrl = '';
        // Upload valid ID image if provided
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $imageExtension = $image->getClientOriginalExtension();
            $storagePath = 'profiles/' . $inputEmail . '.' . $imageExtension;
            $this->storage->getBucket()->upload(file_get_contents($image->getPathname()), ['name' => $storagePath]);
            $profileUrl = $this->storage->getBucket()->object($storagePath)->signedUrl(now()->addYears(3));
        }

        $update = [
            [
                'path' => 'profile',
                'value' => $profileUrl,
            ],
        ];

        $this->firestore->database()->collection('users')->document(Auth::user()->localId)->update($update);
        return redirect()->route('settings.client')->with('success', 'Your profile has been updated');
    }
}
