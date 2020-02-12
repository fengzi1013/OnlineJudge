@extends('layouts.client')

@section('title',trans('main.Problems').' | '.config('oj.main.siteName'))

@section('content')

    <div class="container">
        <div class="my-container alert-danger">
            <h5>
                <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
                @if(isset($msg))
                    {!! $msg !!}
                @else
                    权限不足！
                @endif
            </h5>
        </div>
    </div>

@endsection