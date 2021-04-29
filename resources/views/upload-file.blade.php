<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload A File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="app-page-loader" class="hidden">
                    <div class="flex items-center justify-center pt-8">
                        <span class="w-100 text-green-500 opacity-75"><i class="fas fa-circle-notch fa-spin fa-5x"></i></span>
                    </div>
                    <h4 class="text-center"><strong>{{ __('Uploading.....') }}</strong></h4>
                </div>
                <form method="POST" action="{{route('file.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-center bg-grey-lighter">
                            <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue-500 cursor-pointer hover:bg-blue-500 hover:text-white">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-base leading-normal">Select a file</span>
                                <input id="app-file-ele" type='file' name="file" class="hidden" />
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            @error('file')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center px-4">
                <div class='overflow-x-auto w-full'>

                    <!-- Table -->
                    <table class='mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-50">
                            <tr class="text-gray-600 text-left">
                                <th class="font-semibold text-sm uppercase px-6 py-4">
                                    File
                                </th>
                                <th class="font-semibold text-sm uppercase px-6 py-4">
                                    Status
                                </th>
                                <th class="font-semibold text-sm uppercase px-6 py-4 text-center">
                                    Created At
                                </th>
                                <th class="font-semibold text-sm uppercase px-6 py-4">

                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($data['files'] as $file)
                            <tr>
                                <td class="px-6 py-4">
                                    <a href="{{route('file.download')}}?path={{$file->path}}">{{$file->path}}</a>
                                </td>
                                <td class="px-6 py-4">
                                    @if($file->status == 'ready')
                                    <span class="text-green-800 bg-green-200 font-semibold px-2 rounded-full">
                                        Ready
                                    </span>
                                    @else
                                    <span class="text-red-800 bg-red-200 font-semibold px-2 rounded-full">
                                        In Progress
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <p>{{date('d M Y H:i a',strtotime($file->updated_at))}}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{route('file.data',[$file->id])}}" class="text-purple-800 hover:underline {{$file->status != 'ready'?'pointer-events-none':''}}">Show Data</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center p-6">No Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
