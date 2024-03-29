@extends('layouts.app')

@section('content')

    @can('system.charts')
    
        <div class="container mb-4 row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary bg-gradient text-white">Turnos por institucion</div>

                    <div class="card-body mb-2">

                        <h1>{{ $appointments_institution->options['chart_title'] }}</h1>
                        {!! $appointments_institution->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('institution.charts')
    <div class="container mb-4 row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary bg-gradient text-white">Atención de pacientes en los últimos 3 meses</div>

                <div class="card-body mb-2">

                    <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}
                </div>

            
                </div>
                <div class="card mt-2">
                    <div class="card-header bg-primary bg-gradient text-white">Turnos otorgados últimos 3 meses</div>
                    <div class="card-body  mb-2">

                        <h1>{{ $chart2->options['chart_title'] }}</h1>
                        {!! $chart2->renderHtml() !!}

                </div>

                
            </div>

            <div class="card">
                <div class="card-header bg-primary bg-gradient text-white">Turnos por obra social</div>

                    <div class="card-body mb-2">

                        <h1>{{ $chart_insurance->options['chart_title'] }}</h1>
                        {!! $chart_insurance->renderHtml() !!}
                    </div>

            
                </div>


                
            </div>
        </div>
    </div>
    @endcan

    @can('professional.charts')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header bg-primary bg-gradient text-white">Total de consultas realizadas</div>

                    <div class="card-body mb-2">

                        <h1>{{ $user_attention->options['chart_title'] }}</h1>
                        {!! $user_attention->renderHtml() !!}
                    </div> 
                    <div class="card-header bg-primary bg-gradient text-white">Turnos por mes</div>

                    <div class="card-body mb-2">

                        <h1>{{ $chart_professional->options['chart_title'] }}</h1>
                        {!! $chart_professional->renderHtml() !!}
                    </div> 

                    <div class="card-header bg-primary bg-gradient text-white">Movimiento de caja</div>

                    <div class="card-body mb-2">

                        <h1>{{ $user_cash->options['chart_title'] }}</h1>
                        {!! $user_cash->renderHtml() !!}
                    </div> 

                    
                    
                </div>
            </div>
        </div>
    </div>

    @endcan

@endsection

@section('scripts')
    @can('system.charts')
    {!! $appointments_institution->renderChartJsLibrary() !!}
    {!! $appointments_institution->renderJs() !!}
    @endcan
    @can('institution.charts')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart2->renderChartJsLibrary() !!}
    {!! $chart2->renderJs() !!}
    {!! $chart_insurance->renderChartJsLibrary() !!}
    {!! $chart_insurance->renderJs() !!}
    @endcan
{!! $chart_professional->renderChartJsLibrary() !!}
{!! $chart_professional->renderJs() !!}
{!! $user_cash->renderChartJsLibrary() !!}
{!! $user_cash->renderJs() !!}
{!! $user_attention->renderChartJsLibrary() !!}
{!! $user_attention->renderJs() !!}
@endsection
