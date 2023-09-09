<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('الواجهة') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
                    @if(@isset($success) || @isset($error))
                    @if(@isset($success))
                    <div class="bg-green-400  shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white">
                           <h1 class="font-semibold text-xl text-white leading-tight" > {{ $success }}</h1>
                        </div>
                    </div>
                    @elseif(@isset($error))
                    <div class="bg-red-400  shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white ">
                           <h1 class="font-semibold text-xl text-white  leading-tight" > {{ $error }} </h1>
                        </div>
                    </div>
                    @endif
                    
                @endisset
               
        </div>
    </div>
</x-app-layout>
