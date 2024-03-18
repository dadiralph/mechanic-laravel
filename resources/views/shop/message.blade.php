@extends('shop.shop_layouts.app')

@section('page_title', 'Auto Mechanics | Messages')
@section('appointment', 'collapsed')
@section('dashboard', 'collapsed')
@section('location', 'collapsed')

@section('content')

<div class="pagetitle">
    <h1>Messages</h1>
</div>

<section class="chat-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fs-3 fw-bold">Chats</span>
                            <div class="icons-headers d-flex align-items-center">

                                {{-- <button class="btn btn-light"><i class="bx bx-edit   fs-5 fw-bold"></i></button>
                                --}}
                                <button class="btn btn-light" type="button" id="settings-menu" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="bx bx-cog  fs-5 fw-bold"></i></button>

                                <!-- dropdown settings -->
                                <div class="dropdown">
                                    <ul class="dropdown-menu" aria-labelledby="settings-menu">
                                        <li><a class="dropdown-item" href="#">Settings</a></li>
                                        <li><a class="dropdown-item" href="#">Help and Feedback</a></li>

                                    </ul>
                                </div>

                            </div>
                        </div>
                        <!--Search Button-->
                        <form class="form my-2">
                            <button>
                                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                                    aria-labelledby="search">
                                    <path
                                        d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                                        stroke="currentColor" stroke-width="1.333" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <input class="input" placeholder="Search mechanics, contacts and messages" required=""
                                type="text">
                            <button class="reset" type="reset">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                    </path>
                                </svg>
                            </button>
                        </form>

                        <!-- Profile -->
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="d-flex align-items-center">
                                <img src="{{Auth::user()->profileURL}}" class="img-fluid rounded-circle me-2"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="fw-bold">
                                    <span>{{Auth::user()->displayName}}</span>
                                    <br>
                                    {{-- <small class="fw-normal">Online</small> --}}
                                </div>
                            </div>
                            <div class="icons-dropdown">
                                <button class="btn btn-light" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-horizontal-rounded fs-4 fw-bold"></i>
                                </button>

                                <!-- dropdown Option Profile -->
                                <div class="dropdown">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Status</a></li>
                                        <li><a class="dropdown-item" href="#">Settings</a></li>
                                        <li><a class="dropdown-item" href="#">Profile</a></li>
                                        <li><a class="dropdown-item" href="#">Sign-out</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <!-- Navs links -->
                        <ul class="nav nav-tabs mt-4  justify-content-start" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Recent</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Contact</button>
                            </li>

                        </ul>

                    </div>

                    <div class="card-body" style="height: 55vh; overflow-y: scroll;">

                        <!-- tab content for recent messages -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active " id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <ul class="list-group list-group-flush">

                                    @foreach($convos as $convo)
                                    <li class="list-group-item position-relative">
                                        <div class="position-absolute top-0 end-0">
                                            <button class="btn btn-light" type="button" id="dropdownMenuButton1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded fw-bold"></i>
                                            </button>
                                            <!-- dropdown menu messages -->
                                            <div class="dropdown">
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <!-- <li><a class="dropdown-item" href="#"><i
        class="bx bx-trash-alt me-2"></i>Archieve</a></li> -->
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="bx bxs-trash-alt me-2"></i>Delete</a></li>
                                                    <!-- <li><a class="dropdown-item" href="#"><i
        class="bx bxs-envelope me-2"></i>Mark as Unread</a></li>
        <li><a class="dropdown-item" href="#"><i
        class="bx bxs-no-entry me-2"></i>Block</a></li> -->
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <img src="{{$convo['sender_data']['profile']}}"
                                                class="img-fluid rounded-circle me-2"
                                                style="width: 50px; object-fit: cover; height:50px">
                                            <a class="dropdown-item fw-bold  overflow-hidden"
                                                href="{{$convo['client']}}">
                                                {{ $convo['sender_data']['name']['first_name'] }} {{
                                                $convo['sender_data']['name']['middle_name'] }} {{
                                                $convo['sender_data']['name']['last_name'] }} {{
                                                $convo['sender_data']['name']['suffix'] }}
                                                <br>
                                                <span class="fw-normal">{{$convo['last_message']}}</span><br>
                                                <span class="fw-normal">
                                                    {{ formatTimeAgo($convo['latest_timestamp']) }}
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-lg-flex d-block align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                @if(isset($contact) && $contact != null)
                                <img src="{{$contact['profile']}}" alt="profile" class="img-fluid rounded-circle me-2"
                                    style="width:50px; object-fit:cover;height:50px;">
                                <div class="flex-column d-flex">
                                    <h3 class="fs-5 fw-bold">
                                        {{ $contact['name']['first_name'] }} {{ $contact['name']['middle_name'] }} {{
                                        $contact['name']['last_name'] }} {{ $contact['name']['suffix'] }}
                                    </h3>
                                    {{-- <small>(Online)</small> --}}
                                </div>
                                @endif
                            </div>
                            {{-- <div class="icon-group d-flex align-items-center">
                                <button class="btn btn-light"><i class="bx bxs-phone-call fs-4 fw-bold"></i></button>
                                <button class="btn btn-light"><i class="bx bxs-video fs-4 fw-bold "></i></button>
                                <button class="btn btn-light"><i class="bx bxs-user-plus fs-3 fw-bold "></i></button>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card-body" style="height: 72vh; overflow-y: scroll;">
                        <div class="chat-container">
                            {{--
                            <div class="client-replies my-3">
                                <div class="px-lg-5 px-0">
                                    <p class="border border-2 p-3 my-2 rounded" style="margin-left:30%">Message of user
                                    </p>
                                    <div class=" text-end mb-5">
                                        <small class="fw-normal">1 min ago.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="client-replies my-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{$contact['profile']}}" class="rounded-circle img-fluid me-3"
                                        alt="profile-pic" style="width:50px; object-fit:cover; height:50px;">
                                    <span class="fw-bold me-2">{{ $contact['name']['first_name'] }} {{
                                        $contact['name']['middle_name'] }} {{
                                        $contact['name']['last_name'] }} {{ $contact['name']['suffix'] }}</span>
                                </div>
                                <div class="px-lg-5 px-0">
                                    <p class="border border-2 p-3 my-2 rounded" style="margin-right:30%">Reply of
                                        contact</p>
                                    <small class="fw-normal">1 min ago.</small>
                                </div>
                            </div>
                            --}}
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="" id="sendMessageForm">
                            @csrf
                            <div class="d-flex align-items-center">
                                <textarea name="" id="messageInput" cols="30" rows="1" class="form-control p-2 me-2"
                                    placeholder="send message" required></textarea>
                                <button type="submit" class="btn btn-primary"><i
                                        class="bx bx-send fs-3 fw-bold"></i></button>
                            </div>
                        </form>
                        <div class="d-flex align-items-center justify-content-start my-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // Function to send a message through API
    function sendMessage(message) {
        // Replace 'YOUR_API_ENDPOINT' with the actual API endpoint
        const apiEndpoint = 'mechanic/chats/send/';
        var csrfToken = "{{ csrf_token() }}";
        const data = {
            _token: csrfToken,
            message: message,
            receiver: "{{$contact["id"]}}",
            sender: "{{Auth::user()->localId}}"
        }
        console.log(data)
        // Make an AJAX request to the API
        $.ajax({
            url: apiEndpoint,
            type: 'POST',
            data: data,
            success: function (response) {
                console.log('Message sent successfully:', response);
                toastr.success('{{ Session::get('success') }}', 'Message sent', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 300
                });
                getMessages()
                // You can handle the success response here, e.g., update UI or show a success message
            },
            error: function (error) {
                console.error('Error sending message:', error);
                // You can handle the error response here, e.g., show an error message
            }
        });
    }
    function getMessagesRecursive() {
        const receiver = "{{$contact["id"]}}";
        const intervalTime = 10000; // 10 seconds

        function makeAjaxRequest() {
            $.ajax({
                url: 'mechanic/chats/get/' + receiver,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    console.log("hey");
                    updateChatContainer(response);
                    setTimeout(makeAjaxRequest, intervalTime); // Call itself after a 5-second delay
                },
                error: function (xhr) {
                    console.log(xhr);
                    setTimeout(makeAjaxRequest, intervalTime); // Retry after a 5-second delay on error
                }
            });
        }
        makeAjaxRequest();
    }
    function getMessages() {
        const receiver = "{{$contact["id"]}}";
        try {
            $.ajax({
                url: 'mechanic/chats/get/' + receiver,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log("hey")
                    console.log(response)
                    updateChatContainer(response);
                },
                error: function (xhr) {
                    console.log(xhr)
                }
            });
        } catch (e) {
            console.log("error")
        }

    }

    // Example usage: call this function when submitting the form
    $(document).ready(function () {
        $('#sendMessageForm').submit(function (e) {
            e.preventDefault();
            const message = $('textarea').val();
            sendMessage(message);
            $("#messageInput").val('')
        });
    });



    function updateChatContainer(response) {
        // Assuming you have a reference to your chat container
        messages = response["data"];
        const chatContainer = $('.chat-container');
        chatContainer.empty();

        // Iterate through the received messages and append them to the chat container
        messages.forEach(function (message) {
            const messageHTML = createMessageHTML(message);
            chatContainer.append(messageHTML);
        });
    }

    function createMessageHTML(message) {
        // Assuming you have a way to distinguish between user and contact messages
        const isUserMessage = message.sender === '{{Auth::user()->localId}}'; // Replace 'user' with the actual identifier for user messages
        // Use the appropriate HTML structure based on the message sender
        const messageContainerClass = isUserMessage ? 'client-replies my-3' : 'contact-replies my-3';
        const alignmentStyle = isUserMessage ? 'margin-left:30%' : 'margin-right:30%';

        // Construct the HTML for the message
        const messageHTML = `
            <div class="${messageContainerClass}">
                <div class="${isUserMessage ? 'text-end' : ''}">
                    <p class="border border-2 p-3 my-2 rounded" style="${alignmentStyle}">
                        ${message.message}
                    </p>
                </div>
                <div class="${isUserMessage ? 'text-end' : ''} mb-5">
                    <small class="fw-normal">${formatTimeAgo(message.timestamp)}</small>
                </div>
            </div>
            `;

        return messageHTML;
    }

    function formatTimeAgo(timestampString) {
        const timestamp = new Date(timestampString);
        const now = new Date();
        const diff = Math.floor((now - timestamp) / 1000); // Convert milliseconds to seconds

        const minute = 60;
        const hour = minute * 60;
        const day = hour * 24;
        const month = day * 30;
        const year = day * 365;

        if (diff >= year) {
            const years = Math.floor(diff / year);
            return years + ' year' + (years > 1 ? 's' : '') + ' ago';
        } else if (diff >= month) {
            const months = Math.floor(diff / month);
            return months + ' month' + (months > 1 ? 's' : '') + ' ago';
        } else if (diff >= day) {
            const days = Math.floor(diff / day);
            return days + ' day' + (days > 1 ? 's' : '') + ' ago';
        } else if (diff >= hour) {
            const hours = Math.floor(diff / hour);
            return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';
        } else {
            const minutes = Math.floor(diff / minute);
            return minutes + ' minute' + (minutes > 1 ? 's' : '') + ' ago';
        }
    }
    getMessagesRecursive()

</script>
@endsection

@section('toastr_script')

@if (Session::has('success'))
<script>
    toastr.options = {
        'progressBar': true,
        "closeButton": true,
    }
    toastr.success("{{ Session::get('success') }}", 'Success!', { timeout: 12000 })
</script>

@endif

@endsection