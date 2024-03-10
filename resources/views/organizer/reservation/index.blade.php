
@extends('layouts.organizer')
@section('content')
    <div class="text-center">
        <a href="{{ route('events.create') }}" class="inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Add New event
        </a>
    </div>
<div class="relative mt-10 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">
                    #
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                   user
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                   event
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    date de reservation
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                   status
                </th>
            </tr>
        </thead>
        <tbody>
           @foreach ($reservations as $reservation )
            <tr>
                <th scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{ $reservation->id }}
                <td class="px-6 py-4 text-center">
                {{ $reservation->user->name }}
                </td>
                <td class="px-6 py-4 text-center">
                {{ $reservation->event->title}}
                </td>
                <td class="px-6 py-4 text-center">
                {{ $reservation->reservation_date }}
                </td>
                <td class="px-6 py-4 text-center">
                {{ $reservation->available_seats }}
                </td>
                <td class="px-6 py-4 text-center">
                <button class="hover:text-blue-500" onclick="reservation.prreservationDefault(); document.getElementById('update-reservation-form').submit();">
                    <span class="text-gray-900 whitespace-no-wrap">
                        @if($reservation->status == 1)
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-indigo-300">Accepted</span>
                        @else
                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-indigo-300">Refused</span>
                        @endif
                    </span>
                </button>
                </td>
              


        @endforeach
        </tbody>
    </table>
</div>
@endsection
