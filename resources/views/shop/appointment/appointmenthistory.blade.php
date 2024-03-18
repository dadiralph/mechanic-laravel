@extends('shop.shop_layouts.app')

@section('page_title', 'Shop | Appointments History')
@section('dashboard', 'collapsed')
@section('appointment.show', 'show')
@section('history.appointment.active', 'active')
@section('messages', 'collapsed')
@section('location', 'collapsed')


@section('content')
    
<div class="pagetitle">
    <h1>Appointments</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Appointments History</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
      
      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>

            <div class="card-body">
                <h5 class="card-title">Appointments <span>| Today</span></h5>

                <table class="table table-borderless datatable">
                <thead>
                    <tr>
                    <th scope="col">Customer</th>
                    <th scope="col">Address (province, city, brgy, street (landmark))</th>
                    <th scope="col">Appointment Type</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->client->first_name }} {{ $appointment->client->middle_name }} {{ $appointment->client->last_name }} {{ $appointment->client->suffix }}</td>
                        <td>{{ $appointment->client->province }}, {{ $appointment->client->city }}, {{ $appointment->client->barangay }}, {{ $appointment->client->street }} @if (!empty($customer->landmark))
                            ({{ $appointment->client->landmark }})
                        @endif
                        </td>
                        <td>{{ $appointment->appointment_type }}</td>
                        <td>{{ $appointment->date_start }} ({{ \Carbon\Carbon::createFromFormat('H:i', $appointment->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::createFromFormat('H:i', $appointment->end_time)->format('h:i A') }})</td>
                        <td><span class="badge bg-danger">{{ $appointment->status }}</span></td>
                        <td><a class="view-appointment" data-appointment-id="{{ $appointment->id }}">view</a></td>
                    </tr>
                    @endforeach
                </tbody>
                </table>

            </div>

        </div>
      </div><!-- End Recent Sales -->

    </div>
</section>

@endsection