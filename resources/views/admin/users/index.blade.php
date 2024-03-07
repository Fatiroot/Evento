
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
                        profile
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        email
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        role
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                       status
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        action
                    </th>
                </tr>
            </thead>
            <tbody>
               @foreach ($users as $user )


                <tr>
                    <th scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       {{ $user->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img src="{{$user->getFirstMediaUrl('images')}}" alt="" class="rounded-full h-12 w-12">
                    <td class="px-6 py-4 text-center">
                    {{ $user->name }}
                    </td>
                    <td class="px-6 py-4 text-center">
                    {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 text-center">
                       @foreach($user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4 text-center">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" id="update-user-form">
                        @csrf
                        @method('PUT')
                        <a href="#" class="hover:text-blue-500" onclick="event.preventDefault(); document.getElementById('update-user-form').submit();">
                            <p class="text-gray-900 whitespace-no-wrap">
                                @if($user->status == 1)
                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-indigo-300">Accepted</span>
                                @else
                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-indigo-300">Banned</span>
                                @endif
                            </p>
                        </a>
                    </form>
                    </td>
                    <td class="px-6 py-4 text-center">
                    <div class="flex gap-5 px-6 py-4 justify-center">
                        <form action="{{route('users.destroy' ,$user->id)}}" method="post">
                            @csrf
                            @method('delete')
                              <button>
                                <span class="material-symbols-outlined dark:hover:text-red-500 hover:text-red-500">
                                    delete
                                </span>
                            </button>
                        </form>
                    </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endsection
