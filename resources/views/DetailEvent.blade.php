@extends('layouts.home')
@section('content')

  <main id="main" class="main-page">

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
      <div class="container">
        <div class="section-header">
          <h2>Event Details</h2>
          <p>Praesentium ut qui possimus sapiente nulla.</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <img src="{{ $event->getFirstMediaUrl('images') }}" alt="Speaker 2" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="details">
                    <h2>Title</h2>
                    <h4>{{ $event->title }}</h4>
                    <h2>description</h2>
                    <p>{{ $event->description }}</p>
                    <h2>available seats</h2>
                    <p>{{ $event->available_seats }}</p>
                    <h2>Category</h2>
                    <p><i class="fas fa-location-dot" style="color: #c0b9d5;"></i>{{ $event->category->name }}</p>
                    <h2>Location</h2>
                    <p>{{ $event->location}}</p>
                    <h2>price</h2>
                    <p>{{ $event->price}} $</p>
                    <h2>Start date</h2>
                    <p>{{ $event->start_date}}</p>
                    <h2>End date</h2>
                    <p>{{ $event->end_date}}</p>
                    <div class="text-center">
                        <form id="reservationForm" method="POST" action="{{ route('reservation') }}">
                            @csrf
                            <input type="hidden" class="form-control" name="event_id" value="{{ $event->id }}">
                            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">
                            @auth
                                @if ($event->available_seats != 0)
                                    <button id="submitButton" type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                                @else
                                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                        <dd class="text-red-500 font-bold text-lg sm:col-span-2">
                                            Event sold out
                                        </dd>
                                    </div>
                                @endif
                            @else
                                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                    <dd class="text-red-500 font-bold text-lg sm:col-span-2">
                                        Login to reserve your place in this event
                                    </dd>
                                </div>
                            @endauth

                            @if (session('success'))
                                <div class="alert alert-success mt-3" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger mt-3" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                                @auth
                                    @if (Auth::user()->events->contains('id', $event->id) && Auth::user()->events->where('id', $event->id)->first()->pivot->status == 1)
                                        <a id="downloadButton" href="{{ route('ticket', $event) }}" class="btn btn-success">Download Ticket</a>
                                    @endif
                                @endauth
                        </form>
                        <script>
                            document.getElementById('downloadButton').addEventListener('click', function() {
                                this.style.display = 'none';
                            });

                            document.getElementById('submitButton').addEventListener('click', function() {
                                this.disabled = true;
                            });
                        </script>



                    </div>
                </div>
            </div>
        </div>

      </div>
    </section>

  </main>




    @endsection
