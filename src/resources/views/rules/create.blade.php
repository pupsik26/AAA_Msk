@extends('rules.index')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('store') }}">
        @include('rules._form')
        <div class="flex-btn">
            <button class="btn btn-success mt-1">
                {{ __('Создать') }}
            </button>
        </div>
    </form>
@endsection
