  
  @extends('layouts.master')
@section('content')
<!-- ************************add*********************************** -->
  
<!-- This is an example component -->
<div class="max-w-2xl mx-auto">
 
 <!-- Modal toggle -->
 <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="category-modal">
 Add New Category
 </button>

 <!-- Main modal -->
 <div id="category-modal" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
     <div class="relative w-full max-w-md px-4 h-full md:h-auto">
         <!-- Modal content -->
         <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
             <div class="flex justify-end p-2">
                 <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="category-modal">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                 </button>
             </div>
             <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('categories.store') }}" method="post">
                @csrf
                 <h3 class="text-xl font-medium text-gray-900 dark:text-white">New Category</h3>
                 <div>
                     <label for="name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Name</label>
                     <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required="">
                 </div>
                

                 <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Category</button>
             </form>
         </div>
     </div>
 </div> 
</div>
<!-- ******************************************************************************* -->
 <div class="relative mt-10 overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category )
                <tr>
                    <th scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $category->id }}
                    </th>
                    <td class="px-6 py-4 text-center">
                        {{ $category->name }}
                    </td>
                    <td class="flex gap-5 px-6 py-4 justify-center">
                        <button>
                            <span class="material-symbols-outlined dark:hover:text-red-500 hover:text-red-500" type="button" data-modal-toggle="categoryupdate-modal{{$category->id}}">
                                edit
                            </span>
                        </button>

                        <!-- *******************************update**************************** -->
                        <!-- Main modal -->
                        <div id="categoryupdate-modal{{$category->id}}" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
                            <div class="relative w-full max-w-md px-4 h-full md:h-auto">
                                <!-- Modal content -->
                                <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
                                    <div class="flex justify-end p-2">
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="categoryupdate-modal{{$category->id}}">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                        </button>
                                    </div>
                                    <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('categories.update', $category->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">update Category</h3>
                                        <div>
                                            <label for="name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Name</label>
                                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{$category->name}}"  required="">
                                        </div>
                                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Category</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ******************************************************************************* -->

                        <form action="{{ route('categories.destroy',$category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button>
                                <span class="material-symbols-outlined dark:hover:text-red-500 hover:text-red-500" >
                                    delete
                                </span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @endsection


               
