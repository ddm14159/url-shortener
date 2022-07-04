
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    <title>{{__('interface.title')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="d-flex h-100 text-center text-white bg-dark">

<div class="container-fluid d-flex h-100 justify-content-center align-items-center p-0">
    <main class="px-3">

        <p class="lead">{{__('interface.intro')}}</p>
        {{ Form::open(['route' => 'store']) }}
        {{ Form::token() }}
        {{ Form::text('url', $url ?? null, ['size' => 60, 'placeholder' => __('interface.placeholder')]) }}
        {{ Form::submit(__('interface.submit')) }}
        {{ Form::close() }}
        @error('url')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @if (isset($shortened))
            <div class="p-2"><h5><a href="{{ $shortened }}" class="text-white">{{ $shortened }}</a></h5></div>
        @endif
    </main>
</div>

</body>
</html>
