<?php

use App\Http\Controllers\Shop\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Mechanic\MechanicController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Home controller route */
Route::controller(HomeController::class)->group(function () {
    Route::get('', 'ViewHomePage')->name('index');
    Route::get('Hire-Mechanic/{id}', 'ViewHireForm')->name('hire');
    Route::post('Hire-Mechanic/{id}', 'MakeAppointment')->name('hire.mechanic');
    Route::get('my-appointments', 'ViewClientAppointment')->name('appointment.client');
    Route::get('settings', 'ViewClientSettings')->name('settings.client');
    Route::get('workshop-look-up', 'ViewWorkshop')->name('workshop');
    Route::get('freelancers', 'ViewFreelancers')->name('freelancers');
    Route::get('view-appointment/{id}', 'ViewAppointmentModal');
    Route::get('emergency-service', 'ViewGetstarted')->name('getstarted');
    Route::get('chats', 'Viewchat')->name('chats');
    Route::get('chats/{id}', 'ViewchatbyID')->name('chats_id');
    Route::get('chats/get/{id}', 'GetChat')->name('chat_get');
    Route::post('chats/send', 'SendChatMessage')->name('chats_send');
    Route::post('/cancel-appointment', 'cancelAppointment')->name('appointment.cancel');
    Route::post('/confirm-complete-appointment', 'confirmcompleteAppointment')->name('appointment.confirmcomplete');
    Route::get('shops', 'GetShopsJson')->name('shops');
    Route::post('settings/name', 'ChangeName')->name('client.name.change');
    Route::post('settings/location', 'ChangeLocation')->name('client.location.change');
    Route::post('settings/profile', 'ChangeProfile')->name('client.profile.change');
    Route::post('search', 'searchAction')->name('search.post');

});

/* login route and logout */
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'ViewLogin')->name('login');
    Route::get('signup-mechanic', 'ViewSignupMechanic')->name('signup.mechanic');
    Route::get('signup-shopowner', 'ViewSignupShop')->name('signup.shop');
    Route::get('signup-vehicle', 'ViewSignupVehicle')->name('signup.vehicle');
    Route::get('verify/{token}', 'verify');
    Route::post('signup-mechanic', 'CreateMechanic')->name('mechanic.create');
    Route::post('signup-vehicle', 'CreateClient')->name('client.create');
    Route::post('signup-shopowner', 'CreateShopAdmin')->name('shop.create');
    Route::get('signup-mechanic-verification', 'ViewSignupVehicleSuccess')->name('signup.vehicle-success');
    Route::post('login', 'loginAction')->name('login.post');
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

/* admin route */
Route::middleware('auth')->group(function () {

    Route::controller(AdminController::class)->prefix('admin')->group(function () {
        Route::get('', 'ViewDashboard')->name('dashboard');
    });

    Route::controller(MechanicController::class)->prefix('mechanic')->group(function () {
        Route::get('', 'ViewMechanicDashboard')->name('mechanic');
        Route::get('appointments', 'ViewAppointment')->name('appointment');
        Route::get('messages', 'ViewMessages')->name('messages');
        Route::get('settings', 'ViewSettings')->name('mechanic.settings');
        Route::get('messages/{id}', 'ViewMessageById')->name('message');
        Route::get('pending-appointments', 'ViewPendingAppointment')->name('appointment.pending');
        Route::get('history-appointments', 'ViewHistoryAppointment')->name('appointment.history');
        Route::get('fetch-appointmentnotifications', 'ViewAppointment')->name('appointment');
        Route::get('fetch-appointmentnotifications', 'fetchNotifications');
        Route::get('/view-appointment/{id}', 'ViewAppointmentModal');
        Route::post('/approve-appointment', 'approveAppointment')->name('appointment.approve');
        Route::post('/complete-appointment', 'completeAppointment')->name('appointment.complete');
        Route::post('/reject-appointment', 'rejectAppointment')->name('appointment.reject');
        Route::post('/redirect-appointment', 'readandredirectappointment')->name('appointment.read');
        Route::post('/addserviceonedit', 'addServiceonEdit')->name('addserviceonedit');
        Route::post('/add-service', 'addService');
        Route::get('edit-appointments/{id}', 'ViewEditAppointment')->name('appointment.edit');
        Route::post('messages/mechanic/chats/send', 'SendChatMessage')->name('chats_send');
        Route::get('messages/mechanic/chats/get/{id}', 'GetChat')->name('chat_get');
        Route::post('change-status', 'changeMechanicStatus')->name('mechanic.change_status');
        Route::post('settings/name', 'ChangeName')->name('mechanic.name.change');
        Route::post('settings/location', 'ChangeLocation')->name('mechanic.location.change');
        Route::post('settings/profile', 'ChangeProfile')->name('mechanic.profile.change');
        Route::post('settings/services', 'ChangeServices')->name('mechanic.services.change');
    });

    Route::controller(ShopController::class)->prefix('shop')->group(function () {
        Route::get('', 'ViewMechanicDashboard')->name('shop');
        Route::get('locationsettings', 'ViewLocationSettings')->name('location');
        Route::get('appointments', 'ViewAppointment')->name('shop.appointment');
        Route::get('messages', 'ViewMessages')->name('adminmessages');
        Route::get('messages/{id}', 'ViewMessageById')->name('message');
        Route::get('pending-appointments', 'ViewPendingAppointment')->name('shop.appointment.pending');
        Route::get('history-appointments', 'ViewHistoryAppointment')->name('shop.appointment.history');
        Route::get('fetch-appointmentnotifications', 'ViewAppointment')->name('appointment');
        Route::get('fetch-appointmentnotifications', 'fetchNotifications');
        Route::get('/view-appointment/{id}', 'ViewAppointmentModal');
        Route::post('/approve-appointment', 'approveAppointment')->name('appointment.approve');
        Route::post('/reject-appointment', 'rejectAppointment')->name('appointment.reject');
        Route::post('/redirect-appointment', 'readandredirectappointment')->name('appointment.read');
        Route::post('/addserviceonedit', 'addServiceonEdit')->name('addserviceonedit');
        Route::post('/add-service', 'addService');
        Route::post('location/save', 'SaveLocation');
        Route::get('edit-appointments/{id}', 'ViewEditAppointment')->name('appointment.edit');
        Route::post('messages/mechanic/chats/send', 'SendChatMessage')->name('chats_send');
        Route::get('messages/mechanic/chats/get/{id}', 'GetChat')->name('chat_get');
    });

});