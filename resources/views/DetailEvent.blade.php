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
            <img src="{{ $event->getFirstMediaUrl('images') }}" alt="Speaker 1" class="img-fluid">
          </div>
          <div class="col-md-6">
            <div class="details">
              <h2>{{ $event->title }}</h2>
              <p>{{ $event->description }}</p>
              <p>{{ $event->available_seats }}</p>
              <p>{{ $event->category->name }}</p>
              <p>{{ $event->location}}</p>
              <p>{{ $event->price}}</p>
              <p>{{ $event->start_date}}</p>
              <p>{{ $event->end_date}}</p>
              <div class="text-center">
                <form method="POST" action="{{ route('reservation', Auth::user()) }}">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="event_id" value="{{ $event->id }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Buy Now</button>
                </form>
          </div>
        </div>
      </div>
    </section>

  </main>




    @endsection
