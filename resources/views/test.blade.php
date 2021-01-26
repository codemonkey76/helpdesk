@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="max-w-none mx-auto">
            <div class="bg-white overflow-hidden sm:rounded-lg sm:shadow">

                <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                    <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
                        <div class="ml-4 mt-4">
                            <div class="flex flex-col">
                                <h2 class="text-2xl leading-6 font-medium text-gray-900 mb-2">Message From</h2>

                                <div class="flex">
                                    <div class="flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                                </div>
                                <div class="ml-4 flex flex-col">
                                    <h3 class="text-lg leading-6 font-medium text-gray-700">
                                        Tom Cook
                                    </h3>
                                    <p class="text-sm text-blue-500 mt-1">
                                        <a href="#">
                                            tom@example.com
                                        </a>
                                    </p>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-4 mt-4 flex-shrink-0 flex">
                        </div>
                    </div>
                </div>

                <div class="max-w-2xl text-gray-500 border rounded m-3 p-2">
                    This is some test text, that someone has entered into a textbox <strong>can contain some bold text</strong> as well as <i>italics</i>.
                    <ul>
                        <li>Item 1</li>
                        <li>Item 2</li>
                    </ul>
                </div>

                <div class="m-3">
                    <button @click="showModal=false" type="button"
                            class="mt-3 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
