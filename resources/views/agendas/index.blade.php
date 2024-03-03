@extends('layouts.app')

@section('content')

	<div class="container">
		@isset($professional)
			@livewire('show-agenda',['user' => $user, 'professionals' => $professionals, 'professional' => $professional, 'institution' => $institution])
		@else
		@livewire('show-agenda',['user' => $user, 'professionals' => $professionals , 'institution' => $institution])
		@endisset

    </div>

	<div class="container">
		
		@isset($services)
			@livewire('show-agenda-services',['service' => $service, 'services' => $services, 'user' => $user, 'institution' => $institution])
		@endisset

    </div>

@endsection