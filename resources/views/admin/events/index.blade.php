
  @extends('layouts.master')
@section('content')

    <div class="relative mt-10 overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        title
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        start date
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        end date
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                       price
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                       Location
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                       Event Category
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                       Available seats
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                       automatic acceptance
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                       status
                    </th>
                </tr>
            </thead>
            <tbody>
               @foreach ($events as $event )
                <tr>
                    <th scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       {{ $event->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-12 h-12 rounded-full" src="{{$event->getFirstMediaUrl('images')}}" alt="event photo">
                    </th>
                    <td class="px-6 py-4 text-center">
                    {{ $event->title }}
                    </td>
                    <td class="px-6 py-4 text-center">
                    {{ $event->start_date }}
                    </td>
                    <td class="px-6 py-4 text-center">
                    {{ $event->end_date }}
                    </td>
                    <td class="px-6 py-4 text-center">
                    {{ $event->price }}
                    </td>
                    <td class="px-6 py-4 text-center">
                       {{$event->location}}

                    </td>
                    <td class="px-6 py-4 text-center">
                       {{$event->category->name}}

                    </td>
                    <td class="px-6 py-4 text-center">
                    {{ $event->available_seats }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button type="button" class="hover:text-blue-500" onclick="event.preventDefault(); document.getElementById('update-event-form').submit();">
                            <p class="text-gray-900 whitespace-no-wrap">
                                @if($event->automatic_acceptance == 1)
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-indigo-300">Yes</span>
                                @else
                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-indigo-300">No</span>
                                @endif
                            </p>
                        </button>
                    </td>
                    </td>
                    <form id="update-status-form-{{ $event->id }}" method="POST" action="{{ route('events.updateStatus', $event->id) }}" style="display: none;">
                        @csrf
                        @method('put')
                    </form>

                    <td class="px-6 py-4 text-center">
                        <button class="hover:text-blue-500" onclick="event.preventDefault(); document.getElementById('update-status-form-{{ $event->id }}').submit();">
                            <span class="text-gray-900 whitespace-no-wrap">
                                @if($event->status == 0)
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-indigo-300">Accepted</span>
                                @else
                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-indigo-300">Refused</span>
                                @endif
                            </span>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endsection
