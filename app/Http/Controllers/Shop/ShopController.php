<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\appointmentnotification;
use Illuminate\Support\Facades\DB;
use App\Models\mechanicservice;
use App\Http\Controllers\Firebase;
use Auth;


class ShopController extends Controller
{
    /**
     * Display the Mechanic landing page.
     */
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

    public function ViewMechanicDashboard()
    {
        // Get authenticated mechanic ID
        $mechanicId = auth()->id();

        // Fetch appointment notifications for the authenticated mechanic where is_read is 0
        $appointmentnotificationsrealtime = DB::table('users')
            ->select('users.id', DB::raw('COUNT(appointmentnotifications.is_read) AS unread'))
            ->leftJoin('appointmentnotifications', function ($join) use ($mechanicId) {
                $join->on('users.id', '=', 'appointmentnotifications.mechanic_id')
                    ->where('appointmentnotifications.is_read', 0)
                    ->where('appointmentnotifications.mechanic_id', '=', $mechanicId);
            })
            ->where('users.id', $mechanicId)
            ->groupBy('users.id')
            ->get();

        $appointmentnotifications = appointmentnotification::where('mechanic_id', $mechanicId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('shop.index', compact('appointmentnotifications', 'appointmentnotificationsrealtime'));
    }

    public function ViewLocationSettings() {
        return view('shop.location');
    }

    // public function ViewMessages()
    // {
    //     // Get authenticated mechanic ID
    //     $mechanicId = auth()->id();

    //     // Fetch appointment notifications for the authenticated mechanic where is_read is 0
    //     $appointmentnotificationsrealtime = DB::table('users')
    //         ->select('users.id', DB::raw('COUNT(appointmentnotifications.is_read) AS unread'))
    //         ->leftJoin('appointmentnotifications', function ($join) use ($mechanicId) {
    //             $join->on('users.id', '=', 'appointmentnotifications.mechanic_id')
    //                 ->where('appointmentnotifications.is_read', 0)
    //                 ->where('appointmentnotifications.mechanic_id', '=', $mechanicId);
    //         })
    //         ->where('users.id', $mechanicId)
    //         ->groupBy('users.id')
    //         ->get();

    //     $appointmentnotifications = appointmentnotification::where('mechanic_id', $mechanicId)
    //         ->orderBy('created_at', 'desc')
    //         ->take(5)
    //         ->get();

    //     return view('mechanic.messages', compact('appointmentnotifications', 'appointmentnotificationsrealtime'));
    // }
    public function GetChat($id)
    {
        $query = $this->firestore->database()->collection("convos")->where("client", "=", $id)->limit(1);
        $convoRef = null;
        foreach ($query->documents() as $convo) {
            $convoRef = $convo->reference();
        }
        $messagesQuery = $convoRef->collection("messages")->documents();
        $messages = [];
        // return response()->json(['message' => 'messages received', 'data' => $id]);


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

    public function ViewMessages()
    {
        $query = $this->firestore->database()->collection("convos")->where("receiver", "=", Auth::user()->localId);
        $convos = [];
        foreach($query->documents() as $convoSnaps){
            $convoData = $convoSnaps->data();
            // dd($convoData);
            $receiverId =  $convoData["client"];
            $receiverRef = $this->firestore->database()->collection("users")->document($receiverId);
            $convoData["sender_data"] = $receiverRef->snapshot()->data();
            $convos[] = $convoData;
        }
        // dd($convos);
        return view('shop.messages', compact('convos'));
    }
    public function ViewMessageById($id)
    {
        $query = $this->firestore->database()->collection("convos")->where("receiver", "=", Auth::user()->localId);
        $convos = [];
        $receiverId = null;
        foreach($query->documents() as $convoSnaps){
            $convoData = $convoSnaps->data();
            // dd($convoData);
            $receiverId =  $convoData["client"];
            $receiverRef = $this->firestore->database()->collection("users")->document($receiverId);
            $convoData["sender_data"] = $receiverRef->snapshot()->data();
            // $convoData["client_id"] = $receiverRef->id();
            $convos[] = $convoData;
        }

        $contactRef = $this->firestore->database()->collection("users")->document($receiverId);
        $contact = $contactRef->snapshot()->data();
        $contact["id"] = $contactRef->id();
        // dd($convos);
        return view('shop.message', compact('convos', 'contact'));
    }

    public function SendChatMessage(Request $request)
    {
        // Process your chat message data
        $messageData = $request->all();
        $currentTimestamp = now();
        $messageData["timestamp"] = $currentTimestamp;

        $query = $this->firestore->database()->collection("convos")->where("client", "=", $messageData["receiver"])->limit(1);
        $convoRef = null;
        foreach ($query->documents() as $convo) {
            $convoRef = $convo->reference();
        }
        // return response()->json(['message' => 'Message sent successfully', 'data' => $convoRef, ]);


        $convoID = null;
        if ($convoRef == null) {
            $convoID = $this->generateRandomID();
        } else {
            $convoID = $convoRef->id();
        }
        // return response()->json(['message' => 'Message sent successfully', 'data' => $messageData]);


        $convoData = [
            'latest_timestamp' => $currentTimestamp,
            'client' => $messageData["receiver"],
            'receiver' => Auth::user()->localId,
            'last_message' => $messageData["message"],
        ];
        $this->firestore->database()->collection("convos")->document($convoID)->set($convoData);
        $this->firestore->database()->collection("convos")->document($convoID)->collection("messages")->newDocument()->set($messageData);
        // Return a response (e.g., JSON response)
        return response()->json(['message' => 'Message sent successfully', 'data' => $messageData]);
    }

    public function fetchNotifications()
    {
        // Fetch the latest unread notifications
        $notifications = appointmentnotification::where('is_read', 0)->orderBy('created_at', 'desc')->get();

        return response()->json($notifications);
    }

    /**
     * Display the Mechanic Appointments page.
     */
    public function ViewAppointment()
    {
        // // Get authenticated mechanic ID
        // $mechanicId = auth()->id();

        // // Fetch appointment notifications for the authenticated mechanic where is_read is 0
        // $appointmentnotificationsrealtime = DB::table('users')
        //     ->select('users.id', DB::raw('COUNT(appointmentnotifications.is_read) AS unread'))
        //     ->leftJoin('appointmentnotifications', function ($join) use ($mechanicId) {
        //         $join->on('users.id', '=', 'appointmentnotifications.mechanic_id')
        //             ->where('appointmentnotifications.is_read', 0)
        //             ->where('appointmentnotifications.mechanic_id', '=', $mechanicId);
        //     })
        //     ->where('users.id', $mechanicId)
        //     ->groupBy('users.id')
        //     ->get();

        // $appointmentnotifications = appointmentnotification::where('mechanic_id', $mechanicId)
        //     ->orderBy('created_at', 'desc')
        //     ->take(5)
        //     ->get();

        // $appointments = appointment::with('client')
        //     ->where('mechanic_id', $mechanicId)
        //     ->where('status', 'In Progress')
        //     ->get();
        $mechanicId = Auth::user()->localId;

        $appointmentnotificationsrealtime = null;
        $appointmentnotifications = null;

        $query = $this->firestore->database()->collection("appointments")
            ->where("mechanic_id", "=", $mechanicId)
            ->where("status", "=", 'In Progress')
            ->documents();

        $appointments = [];
        foreach ($query as $appointment) {
            // $freelancers[] = $freelancer->data
            $data = $appointment->data();
            $data["id"] = $appointment->id();
            $client = $this->firestore->database()->collection("users")->document($data["client_id"])->snapshot()->data();
            $data["client"] = $client;
            array_push($appointments, $data);
        }

        return view('shop.appointment.appointment', compact('appointmentnotifications', 'appointmentnotificationsrealtime', 'appointments'));
    }

    /**
     * Display the Mechanic Pending Appointments page.
     */
    public function ViewPendingAppointment()
    {
        // Get authenticated mechanic ID
        $mechanicId = Auth::user()->localId;

        // Fetch appointment notifications for the authenticated mechanic where is_read is 0
        // $appointmentnotificationsrealtime = DB::table('users')
        //     ->select('users.id', DB::raw('COUNT(appointmentnotifications.is_read) AS unread'))
        //     ->leftJoin('appointmentnotifications', function ($join) use ($mechanicId) {
        //         $join->on('users.id', '=', 'appointmentnotifications.mechanic_id')
        //             ->where('appointmentnotifications.is_read', 0)
        //             ->where('appointmentnotifications.mechanic_id', '=', $mechanicId);
        //     })
        //     ->where('users.id', $mechanicId)
        //     ->groupBy('users.id')
        //     ->get();

        // $appointmentnotifications = appointmentnotification::where('mechanic_id', $mechanicId)
        // ->orderBy('created_at', 'desc')
        // ->take(5)
        // ->get();

        $appointmentnotificationsrealtime = null;
        $appointmentnotifications = null;

        // $pendingappointments = appointment::with('client')
        //     ->where('mechanic_id', $mechanicId)
        //     ->where('status', 'Pending')
        //     ->get();

        $query = $this->firestore->database()->collection("appointments")
            ->where("mechanic_id", "=", $mechanicId)
            ->where("status", "=", 'Pending')
            ->documents();

        $pendingappointments = [];
        foreach ($query as $appointment) {
            // $freelancers[] = $freelancer->data
            $data = $appointment->data();
            $data["id"] = $appointment->id();
            $client = $this->firestore->database()->collection("users")->document($data["client_id"])->snapshot()->data();
            $data["client"] = $client;
            array_push($pendingappointments, $data);
        }
        // dump($pendingappointments);

        return view('shop.appointment.pending', compact('appointmentnotifications', 'appointmentnotificationsrealtime', 'pendingappointments'));
    }

    /**
     * Display the Mechanic Appointments history page.
     */
    public function ViewHistoryAppointment()
    {
        // // Get authenticated mechanic ID
        // $mechanicId = auth()->id();

        // // Fetch appointment notifications for the authenticated mechanic where is_read is 0
        // $appointmentnotificationsrealtime = DB::table('users')
        //     ->select('users.id', DB::raw('COUNT(appointmentnotifications.is_read) AS unread'))
        //     ->leftJoin('appointmentnotifications', function ($join) use ($mechanicId) {
        //         $join->on('users.id', '=', 'appointmentnotifications.mechanic_id')
        //             ->where('appointmentnotifications.is_read', 0)
        //             ->where('appointmentnotifications.mechanic_id', '=', $mechanicId);
        //     })
        //     ->where('users.id', $mechanicId)
        //     ->groupBy('users.id')
        //     ->get();

        // $appointmentnotifications = appointmentnotification::where('mechanic_id', $mechanicId)
        //     ->orderBy('created_at', 'desc')
        //     ->take(5)
        //     ->get();

        // $appointments = appointment::with('client')
        //     ->where('mechanic_id', $mechanicId)
        //     ->whereNotIn('status', ['In Progress', 'Pending'])
        //     ->get();

        // Get authenticated mechanic ID
        $mechanicId = Auth::user()->localId;

        // Fetch appointment notifications for the authenticated mechanic where is_read is 0
        // $appointmentnotificationsrealtime = DB::table('users')
        //     ->select('users.id', DB::raw('COUNT(appointmentnotifications.is_read) AS unread'))
        //     ->leftJoin('appointmentnotifications', function ($join) use ($mechanicId) {
        //         $join->on('users.id', '=', 'appointmentnotifications.mechanic_id')
        //             ->where('appointmentnotifications.is_read', 0)
        //             ->where('appointmentnotifications.mechanic_id', '=', $mechanicId);
        //     })
        //     ->where('users.id', $mechanicId)
        //     ->groupBy('users.id')
        //     ->get();

        // $appointmentnotifications = appointmentnotification::where('mechanic_id', $mechanicId)
        // ->orderBy('created_at', 'desc')
        // ->take(5)
        // ->get();

        $appointmentnotificationsrealtime = null;
        $appointmentnotifications = null;

        // $pendingappointments = appointment::with('client')
        //     ->where('mechanic_id', $mechanicId)
        //     ->where('status', 'Pending')
        //     ->get();

        $query = $this->firestore->database()->collection("appointments")
            ->where("mechanic_id", "=", $mechanicId)
            ->documents();

        $appointments = [];
        foreach ($query as $appointment) {
            // $freelancers[] = $freelancer->data
            $data = $appointment->data();
            $data["id"] = $appointment->id();
            if(!($data["status"] == "Pending" || $data["status"] == "In Progress")){
                $client = $this->firestore->database()->collection("users")->document($data["client_id"])->snapshot()->data();
                $data["client"] = $client;
                array_push($appointments, $data);
            }
        }
        // dump($pendingappointments);

        return view('shop.appointment.appointmenthistory', compact('appointmentnotifications', 'appointmentnotificationsrealtime', 'appointments'));
    }

    public function ViewAppointmentModal($id)
    {

        $appointmentSnap = $this->firestore->database()->collection("appointments")->document($id)->snapshot();
        $appointmentData = $appointmentSnap->data();
        // Fetch lot data by ID

        // Check if the lot was not found
        if (!$appointmentData) {
            return response()->json(['error' => 'appointment not found'], 404);
        }

        // Initialize customer-related variables to empty strings
        $clientFirstName = '';
        $clientMiddleName = '';
        $clientLastName = '';
        $clientSuffix = '';
        $clientProvince = '';
        $clientCity = '';
        $clientBarangay = '';
        $clientStreet = '';
        $clientLandmark = '';

        // Check if the lot has a customer associated with it
        if ($appointmentData["client_id"]) {
            // Fetch customer data by ID
            $client = $this->firestore->database()->collection('users')->document($appointmentData['client_id'])->snapshot()->data();

            // Check if the customer was found
            if ($client) {
                // Set customer-related variables
                $clientFirstName = $client['name']['first_name'];
                $clientMiddleName = $client['name']['middle_name'];
                $clientLastName = $client['name']['last_name'];
                $clientSuffix = $client['name']['suffix'];
                $clientProvince = $client['address']['province'];
                $clientCity = $client['address']['city'];
                $clientBarangay = $client['address']['barangay'];
                $clientStreet = $client['address']['street'];
                $clientLandmark = $client['address']['landmark'];
            }
        }

        // Concatenate client full name
        $clientFullName = trim("{$clientFirstName} {$clientMiddleName} {$clientLastName} {$clientSuffix}");
        // Concatenate client Address
        $clientAddress = trim("{$clientProvince}, {$clientCity}, {$clientBarangay}, {$clientStreet} ({$clientLandmark})");

        $appointmentTime = trim("{$appointmentData['start_time']} - {$appointmentData['end_time']}");

        // Fetch appointment vehicle for the given lot ID
        $appointmentVehicleQuery = $this->firestore
            ->database()->collection("appointment_vehicles")->where('appointment_id', '=', $appointmentSnap->id())->limit(1);
        $appointmentVehicleRefs = $appointmentVehicleQuery->documents();

        $vehicleData = [];
        $vehicleId = '';
        foreach ($appointmentVehicleRefs as $avref) {
            $vehicleData = $avref->data();
            $vehicleId = $avref->id();
        }

        $servicesQuery = $this->firestore
            ->database()->collection("appointment_services")->where('appointment_vehicle_id', '=', $vehicleId);


        $services = '';
        foreach ($servicesQuery->documents() as $serviceRef) {
            $serviceData = $serviceRef->data();
            $service = $serviceData['service_id'];
            $services = $services . $service . ', ';
        }


        // Return lot data as JSON response
        return response()->json([
            'appointment_type' => $appointmentData['appointment_type'],
            'date_start' => $appointmentData['date_start'],
            'model' => $vehicleData['model'],
            'make' => $vehicleData['make'],
            'notes' => $vehicleData['notes'],
            'problem_image' => $vehicleData['problem_image'],
            'client_address' => $clientAddress,
            'client_name' => $clientFullName,
            'time' => $appointmentTime,
            'services' => $services,
            // Add other columns as needed
        ]);
    }

    public function approveAppointment(Request $request)
    {
        $appointmentId = $request->input('appointmentId');
        $appointmentRef = $this->firestore->database()->collection('appointments')->document($appointmentId);
        $appointmentData = $appointmentRef->snapshot()->data();
        // Find the appointment by ID and update its status
        if ($appointmentData) {
            $data = [
                ['path' => 'status', 'value' => 'In Progress'],
            ];
            $appointmentRef->update($data);
            // // Find the appointment by ID and update its is_read
            // $appointmentnotification = appointmentnotification::where('appointment_id', $appointmentId)->first();
            // if ($appointmentnotification) {
            //     $appointmentnotification->is_read = '1';
            //     $appointmentnotification->save();
            // }
            $appointmentNotification = [
                "client_id" => $appointmentData["client_id"],
                "mechanic_id" => Auth::user()->localId,
                "message" => "Your appointment has been accepted by " . Auth::user()->displayName,
                "timestamp" => now()
            ];
            $this->firestore->database()->collection("appointment_notifications")->document($this->generateRandomID())->set($appointmentNotification);
        }
        $mechanicId = Auth::user()->localId;
        $mechanicRef = $this->firestore->database()->collection('users')->document($mechanicId);
        $mechanicData = $mechanicRef->snapshot()->data();

        if (!array_key_exists("accomodated", $mechanicData)) {
            $mechanicData['accomodated'] = 0;
        }

        if ($mechanicData) {
            $data = [
                ['path' => 'accomodated', 'value' => $mechanicData['accomodated'] + 1],
            ];
            $mechanicRef->update($data);
        }

        return redirect()->back()->with('success', 'Appointment approved successfully!');
    }

    public function rejectAppointment(Request $request)
    {
        $appointmentId = $request->input('appointmentId');
        $appointmentRef = $this->firestore->database()->collection('appointments')->document($appointmentId);
        $appointmentData = $appointmentRef->snapshot()->data();

        // Find the appointment by ID and update its status
        if ($appointmentData) {
            $data = [
                ['path' => 'status', 'value' => 'Rejected'],
                ['path' => 'reason', 'value' => $request->input('reason')],
            ];
            $appointmentRef->update($data);
            // Find the appointment by ID and update its is_read
            // $appointmentnotification = appointmentnotification::where('appointment_id', $appointmentId)->first();
            // if ($appointmentnotification) {
            //     $appointmentnotification->is_read = '1';
            //     $appointmentnotification->save();
            // }
        }
        $mechanicId = Auth::user()->localId;
        $mechanicRef = $this->firestore->database()->collection('users')->document($mechanicId);
        $mechanicData = $mechanicRef->snapshot()->data();

        if (!array_key_exists("!array_key_exists(", $mechanicData)) {
            $mechanicData['accomodated'] = 0;
        }

        if ($mechanicData) {
            $data = [
                ['path' => 'accomodated', 'value' => $mechanicData['accomodated'] + 1],
            ];
            $mechanicRef->update($data);
        }

        return redirect()->back()->with('success', 'Appointment rejected successfully!');
    }

    /**
     * Display the Mechanic Appointments page.
     */
    public function ViewEditAppointment(string $id)
    {
        // $editappointment = appointment::with(['client', 'mechanic', 'appointmentvehicle.vehicleservice'])->findOrFail($id);

        // $appointmentvehicle = appointmentvehicle::where('appointment_id', $editappointment->id)
        //     ->get();

        // // Get authenticated mechanic ID
        // $mechanicId = auth()->id();

        // // Fetch appointment notifications for the authenticated mechanic where is_read is 0
        // $appointmentnotificationsrealtime = DB::table('users')
        //     ->select('users.id', DB::raw('COUNT(appointmentnotifications.is_read) AS unread'))
        //     ->leftJoin('appointmentnotifications', function ($join) use ($mechanicId) {
        //         $join->on('users.id', '=', 'appointmentnotifications.mechanic_id')
        //             ->where('appointmentnotifications.is_read', 0)
        //             ->where('appointmentnotifications.mechanic_id', '=', $mechanicId);
        //     })
        //     ->where('users.id', $mechanicId)
        //     ->groupBy('users.id')
        //     ->get();

        // $appointmentnotifications = appointmentnotification::where('mechanic_id', $mechanicId)
        //     ->orderBy('created_at', 'desc')
        //     ->take(5)
        //     ->get();

        // $appointments = appointment::with('client')
        //     ->where('mechanic_id', $mechanicId)
        //     ->where('status', 'In Progress')
        //     ->get();

        // // Retrieve all services related to the mechanic
        // $mechanicServices = mechanicservice::where('mechanic_id', $mechanicId)->orderBy('created_at', 'asc')->get();

        $appointmentnotifications = null;
        $appointmentnotificationsrealtime = null;
        $appointments = null;
        $mechanicServices = null;
        $editappointment = null;
        $appointmentvehicle = null;

        return view('shop.appointment.editappointment', compact('appointmentnotifications', 'appointmentnotificationsrealtime', 'appointments', 'mechanicServices', 'editappointment', 'appointmentvehicle'));
    }

    public function readandredirectappointment(Request $request)
    {
        $appointmentId = $request->input('appointment_id');

        // Find the appointment by ID and update its is_read
        $appointmentnotification = appointmentnotification::where('appointment_id', $appointmentId)->first();
        if ($appointmentnotification) {
            $appointmentnotification->is_read = '1';
            $appointmentnotification->save();
        }

        return redirect()->route('appointment.pending');
    }


    public function addService(Request $request)
    {
        try {
            $mechanicId = auth()->id();
            $service = new MechanicService;
            $service->service_name = $mechanicId;
            $service->service_name = $request->input('laborName');
            $service->labor_fee = $request->input('laborFee');
            $service->save();

            return response()->json([
                'success' => true,
                'id' => $service->id,
                'service_name' => $service->service_name,
                'labor_fee' => $service->labor_fee,
                'message' => 'Service added successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding service: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    public function SaveLocation(Request $request)
    {
        $locationData = $request->all();
        // return response()->json(['message' => 'Location saved', 'data' => $locationData ]);
        $shopRef = $this->firestore->database()->collection('users')->document(Auth::user()->localId);
        $shopData = $shopRef->snapshot()->data();
        // Find the appointment by ID and update its status
        if ($shopData) {
            $data = [
                ['path' => 'latitude', 'value' => $locationData['latitude']],
                ['path' => 'longitude', 'value' => $locationData['longitude']],
            ];
            $shopRef->update($data);
        }
        // return redirect()->back()->with('success', 'Location saved successfully');
        return response()->json(['message' => 'Location saved', 'data' => $locationData ]);
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
}
