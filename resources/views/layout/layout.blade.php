<!doctype html>
<html lang="" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Dating Site</title>

    <style>
        body {
            width: 100%;

            float: left;
        }

        .class1,
        .class2,
        .class3 {
            width: 33.33%;
            float: left;
            height: 900px;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 750px;
        }

        .card {
            background-color: dodgerblue;
            color: white;
            padding: 4rem;
            height: 12rem;
        }

        .cards {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-gap: 1rem;
        }
        @media (min-width: 600px) {
            .cards { grid-template-columns: repeat(2, 1fr); }
        }

        @media (min-width: 900px) {
            .cards { grid-template-columns: repeat(3, 1fr); }
        }
    </style>
</head>
<body style="position: relative;  min-height: 100vh; background-image: url('bg1.jpg'); background-size: cover;">
<div>
    <nav class="bg-white shadow-lg" style="position: sticky; top:0; z-index: 100; background: #202020">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        @auth()
                            <a href="/main" class="flex items-center py-4 px-2">
                            <span class="text-red-600 text-3xl "
                            >Dating Site</span>
                            </a>
                        @else
                            <a href="/home" class="flex items-center py-4 px-2">
                            <span class="text-red-600 text-3xl"
                            >Dating Site</span>
                            </a>
                        @endauth
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        @auth()
                            <span class="font-semibold text-blue-400 text-lg" style="padding: 15px"
                            >Welcome, {{ auth()->user()->first_name }}!</span>
                            <form action="/user" method="GET"
                                  class="py-4 px-2 text-gray-100 border-b-4 border-green-500 font-semibold"
                                  style="position: absolute; right: 100px">
                                @csrf
                                <button type="submit">My Profile</button>
                            </form>
                            <form action="/logout" method="POST"
                                  class="py-4 px-2 text-gray-100 border-b-4 border-green-500 font-semibold"
                                  style="position: absolute; right: 20px">
                                @csrf
                                <button type="submit">Log Out</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div>
        @yield('content')
    </div>
    <footer class="container-fluid text-center" style="position: fixed;
         bottom: 0; width: 100%; height: 2rem; color: grey; background: #262626">
        <p> &copy; Copyright 2022 Dating Site</p>
    </footer>
</div>
</body>
</html>
