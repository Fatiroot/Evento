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
                        <form method="POST" action="{{ route('reservation', Auth::user()) }}">
                            @csrf
                            <input type="hidden" class="form-control" name="event_id" value="{{ $event->id }}">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </section>

  </main>




    @endsection
