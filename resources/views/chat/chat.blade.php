@extends('layouts.app')

@section('content')
<div class="container">
    <chat-component class="col-12" user="{{ auth()->user() }}"></chat-component>
</div>
@endsection