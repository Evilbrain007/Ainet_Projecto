@extends('layouts.master')

@section('title', $title)

@section('content')
    <div class="page-header">
        <h5>Departamento</h5>
        <h1>{{$department->name}}</h1>
    </div>
    <div class="container">
        <table class="table table-hover">
        <thead>
            <tr>
                <th>Total de impressões</th>
                <th>P/B</th>
                <th>Cor</th>
                <th>N.º de impressões hoje</th>
                <th>Média imp. diárias deste mês</th>
            </tr>
        </thead>
            <tbody>
            <tr>
                <td>{{$statistics['totalPrints']}}</td>
                <td> {{$statistics['bwColoredPrintsRatio']}}</td>
                <td>{{$statistics['coloredBWPrintsRatio']}}</td>
                <td>{{$statistics['totalPrintsToday']}}</td>
                <td>{{number_format($statistics['printAvgCurrentMonth'],2)}}</td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection

