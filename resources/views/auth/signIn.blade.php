@extends('layout.layout')

@section('content')

    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 ">
        <div class="max-w-md w-full space-y-8"  style="padding: 20px; background: #202020; border-radius: 20px">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-green-600">Sign in to your account</h2>
            </div>
            <form class="mt-8 space-y-6" action="/login" method="POST">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px ">
                    <div>
                        <label for="email-address" class="sr-only ">Email address</label>
                        <input id="email-address" name="email" type="email" autocomplete="email"
                               value="{{ old('email') }}" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 bg-gray-300 border border-gray-400 placeholder-gray-700 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                               placeholder="Email address">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 bg-gray-300 border border-gray-400 placeholder-gray-700 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                               placeholder="Password">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-green-700"> Remember me </label>
                    </div>

                    <div class="text-sm">
                        <a href="/forgot-password" class="font-medium text-green-800 hover:text-green-500"> Forgot your
                            password? </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-lg font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="max-w-md w-full space-y-8">
                <a href="/register">
                    <div class="mt-6 text-center text-xl font-abold text-green-600 hover:text-green-400 pb-4">
                        Register
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection


