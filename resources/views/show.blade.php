@extends('reports::app')
@section('content')
<div class="{{ config('reports.css.container') }}">
    <div class="row">
        <div class="{{ config('reports.css.col') }}">

            <!-- breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb px-2 py-1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('report.index') }}">Raporty</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('report.index', ['category' => $category]) }}">{{ $category->title }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $report->title }}
                    </li>
                </ol>
            </nav>

            <!-- head -->
            <h3 class="my-1">
                {{ $report->title }}
            </h3>
            @if ($report->desc)
            <p class="my-1">
                {{ $report->desc }}
            </p>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="{{ config('reports.css.col') }}">
            {!! $reportContent !!}
        </div>
    </div>
</div>

<?php
\koolreport\widgets\koolphp\Table::create([
    'dataSource' => $r->dataStore('data'),
    'cssClass' => [
        'table' => config('reports.css.table'),
    ]
]);
?>

@endsection