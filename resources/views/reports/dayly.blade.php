<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('التقرير اليومي') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xs   mx-auto sm:px-6 lg:px-8">
           
                    @if(@isset($student_attends))
                    <div class=" bg-blue-300 shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white">
                           <h1 class="font-semibold text-xl text-white leading-tight" > عدد اللطللاب الحاضرون : {{ $student_attends_count }}</h1>
                        </div>
                    </div>
        </div>
    {{-- make table for  student_attends --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-fixed w-full">
                    <thead>
                      <tr class="bg-blue-300">
                        <th class="px-4 py-2">الرقم</th>
                        <th class="px-4 py-2">الاسم</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($student_attends as $key => $student_attend)
                        <tr>
                            <td class="border px-4 py-2">{{ $key+1 }}</td>
                            <td class="border px-4 py-2">{{ $student_attend->name }}</td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
                    {{-- @endif --}}
                    
                @endisset
                <div class="max-w-xs   mx-auto sm:px-6 lg:px-8">

                @if(@isset($student_absents))
                <div class=" bg-red-300 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                       <h1 class="font-semibold text-xl text-white leading-tight" > عدد اللطللاب الغائبين : {{ $student_absents_count }}</h1>
                    </div>
                </div>
                </div>
    {{-- make table for  student_absents --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-fixed w-full">
                    <thead>
                      <tr class="bg-red-300">
                        <th class="px-4 py-2">الرقم</th>
                        <th class="px-4 py-2">الاسم</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($student_absents as $key => $student_absent)
                        <tr>
                            <td class="border px-4 py-2">{{ $key+1 }}</td>
                            <td class="border px-4 py-2">{{ $student_absent->name }}</td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
               
        </div>
    </div>
                @endif
        </div>
</x-app-layout>
