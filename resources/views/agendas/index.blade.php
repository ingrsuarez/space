@extends('layouts.app')

@section('content')

	<div class="container">
		@isset($professional)
			@livewire('show-agenda',['professionals' => $professionals, 'professional' => $professional])
		@else
		@livewire('show-agenda',['professionals' => $professionals])
		@endisset

    </div>

@endsection