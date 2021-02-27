@extends('errors::illustrated-layout')

@section('title', __(/*$exception->getMessage() ?:*/ 'O yol bu yol deyil.'))
{{--@section('code', '404')--}}
{{--@section('message', __($exception->getMessage() ?: 'O yol bu yol deyil.'))--}}
@section('image')
    <style>
        body, html {
            height: 100%;

            background-image: url({{asset('404.jpg')}});

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
    </style>
@endsection

