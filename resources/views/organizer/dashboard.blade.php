
  @extends('layouts.organizer')
@section('content')
<!-- STATISTICS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-6">
    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
        <div class="space-y-2">
            <p class="text-xs text-gray-400 uppercase">Events</p>
            <div class="flex items-center space-x-2">
                <h1 class="text-xl font-semibold text-black">{{$eventcount}}</h1>
            </div>
        </div>
        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3v4a1 1 0 0 0 1 1h4 M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5 M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0  M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5"></path></svg>
    </div>

    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
        <div class="space-y-2">
            <p class="text-xs text-gray-400 uppercase">Resrvations</p>
            <div class="flex items-center space-x-2">
                <h1 class="text-xl font-semibold text-black">{{$reservationCount}}</h1>
            </div>
        </div>
        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
    </div>

</div>
<!-- END OF STATISTICS -->
  <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Dashboard</h1>

                <div class="flex flex-wrap mt-6">
                    <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-plus mr-3"></i> Monthly Reports
                        </p>
                        <div class="p-6 bg-white">
                            <canvas id="chartOne" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 pl-0 lg:pl-2 mt-12 lg:mt-0">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-check mr-3"></i> Resolved Reports
                        </p>
                        <div class="p-6 bg-white">
                            <canvas id="chartTwo" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <!-- ************************************************ -->
            </main>


        </div>

    </div>
    @endsection
