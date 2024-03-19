{{--
    @extends('layouts.app')

    @section('content')
        post.create template
    @endsection
--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post Create
        </h2>
    </x-slot>

    {{ html()->form('POST', route('posts.store'))->open() }}

    @include('post._form')
    {{ html()->submit('Create')->class('mt-4 bg-blue-500 text-white p-2 rounded-md') }}
    {{ html()->form()->close() }}


</x-app-layout>
