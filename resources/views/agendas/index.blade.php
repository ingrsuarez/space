@extends('layouts.app')

@section('content')

	<div class="container">

		@livewire('show-agenda',['professionals' => $professionals])
    </div>

@endsection