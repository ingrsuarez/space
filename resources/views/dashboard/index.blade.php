@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary">Dashboard</div>

            <div class="card-body mb-2">

                <h1>{{ $chart1->options['chart_title'] }}</h1>
                {!! $chart1->renderHtml() !!}
            </div>

           
        </div>
        <div class="card mt-2">
            <div class="card-header">Dashboard 2</div>
            <div class="card-body">

                <h1>{{ $chart2->options['chart_title'] }}</h1>
                {!! $chart2->renderHtml() !!}

            </div>

        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
{!! $chart2->renderChartJsLibrary() !!}
{!! $chart2->renderJs() !!}
@endsection
