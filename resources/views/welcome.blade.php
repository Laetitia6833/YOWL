<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <meta name="csrf-token" id="token" value="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <script src="http://localhost:8098"></script> --}}
    {{-- <script src="http://172.28.208.1:8098"></script> --}}
    {{-- <link href="{{ asset('css/reset.css') }}" rel="stylesheet"> --}}
</head>

<body>
    <div id="app">
        <div>
            <home />
        </div>
    </div>
    {{-- <script>
        console.log(window.Laravel);
    </script> --}}
    <script src="{{ mix('js/app.js') }}"></script>


</body>

</html>
