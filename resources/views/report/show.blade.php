@extends('report.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
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
    {!! $reportContent !!}
</div>
@endsection