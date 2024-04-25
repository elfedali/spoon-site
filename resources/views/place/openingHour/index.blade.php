{{--
    @extends('layouts.app')

    @section('content')
        openingHour.index template
    @endsection
--}}
<x-app-layout>
    @php
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    @endphp

    <div>
        <a href="{{ route('places.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
            {{ __('label.all') }}
        </a>
    </div>
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
        {{ $place->title }}
    </h1>
    @include('place._tab')
    <section>
        {{ html()->form('PUT', 'places.opening-hours.update', ['place' => $place])->open() }}
        {{-- Table of regular opening hours --}}
        <x-table>
            <x-thead>
                <x-th>
                    {{ __('label.is_open') }}
                </x-th>
                <x-th>
                    {{ __('label.day') }}
                </x-th>
                <x-th>
                    {{ __('label.time_start') }}
                </x-th>
                <x-th>
                    {{ __('label.time_end') }}
                </x-th>
            </x-thead>
            <tbody>
                @foreach ($days as $day)
                    <x-tr>
                        <x-td>
                            {{-- Checkbox or select input for open/closed status --}}
                            <input type="checkbox" name="is_open_monday" value="1">
                        </x-td>
                        <x-td>
                            {{ __('label.days.' . $day) }}
                        </x-td>
                        <x-td>
                            {{-- Time input for start time --}}
                            <!-- Example: -->
                            <input type="time" name="start_time_monday">
                        </x-td>
                        <x-td>
                            {{-- Time input for end time --}}
                            <!-- Example: -->
                            <input type="time" name="end_time_monday">
                        </x-td>
                    </x-tr>
                @endforeach
            </tbody>
        </x-table>

        {{-- Table of exceptions --}}
        <h2 class="text-lg mt-4 mb-4">
            Les exceptions
        </h2>
        <x-table>
            <x-thead>
                <x-th>
                    {{ __('label.date') }}
                </x-th>
                <x-th>
                    {{ __('label.is_open') }}
                </x-th>
                <x-th>
                    {{ __('label.time_start') }}
                </x-th>
                <x-th>
                    {{ __('label.time_end') }}
                </x-th>
            </x-thead>
            <tbody>
                <x-tr>
                    <x-td>
                        {{-- Date input for exception --}}
                        <!-- Example: -->
                        <input type="date" name="exception_date_1">
                    </x-td>
                    <x-td>
                        {{-- Checkbox or select input for open/closed status --}}
                        <!-- Example: -->
                        <input type="checkbox" name="is_open_exception_1" value="1">
                    </x-td>
                    <x-td>
                        {{-- Time input for start time --}}
                        <!-- Example: -->
                        <input type="time" name="start_time_exception_1">
                    </x-td>
                    <x-td>
                        {{-- Time input for end time --}}
                        <!-- Example: -->
                        <input type="time" name="end_time_exception_1">
                    </x-td>
                </x-tr>
                <!-- Repeat rows for other exceptions -->
            </tbody>
        </x-table>

        <div>
            {{ html()->submit(__('label.save'))->class('btn mt-4') }}
        </div>
        {{ html()->form()->close() }}
    </section>

</x-app-layout>
