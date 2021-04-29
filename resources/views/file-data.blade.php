<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('File Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center px-4">
                <div class='overflow-x-auto w-full'>
                    <!-- Table -->
                    <table class='mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-50">
                            <tr class="text-gray-600 text-left">
                                @foreach($data['headers'] as $header)
                                <th class="font-semibold text-sm uppercase px-6 py-4">
                                    {{$header}}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @for ($i = 0; $i <= $data['total_rows']; $i++)
                              <tr>
                                  @foreach($data['values']->where('row_number',$i)->toArray() as $value)
                                  <td>
                                     {{$value['value']}} 
                                  </td>
                                  @endforeach
                              </tr>
                            @endfor
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
