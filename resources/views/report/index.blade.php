@extends('report.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            @if ($category)
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb px-2 py-1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('report.index') }}">Raporty</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $category->title }}
                    </li>
                </ol>
            </nav>
            <h3 class="my-1">
                {{ $category->title }}
            </h3>
            @if ($category->desc)
            <p class="my-1">
                {{ $category->desc }}
            </p>
            @endif
            @endif
            @foreach ($tree as $treeCategory)
            @if ($treeCategory->reports->count() > 0)
            @if (!$category)
            <h5 class="my-1">
                <a href="{{ route('report.index', ['category' => $treeCategory]) }}">{{ $treeCategory->title }}</a>
            </h5>
            @if ($treeCategory->desc)
            <p class="my-1">
                {{ $treeCategory->desc }}
            </p>
            @endif
            @endif
            <div class="pt-2 pb-4 pl-2 pr-0 list-group">
                @foreach ($treeCategory->reports as $treeReport)
                <a href="{{ route('report.show', ['category' => $treeCategory, 'report' => $treeReport]) }}" class="list-group-item list-group-item-action">
                    <h6 class="my-1 text-primary">
                        {{ $treeReport->title }}
                    </h6>
                    @if ($treeReport->desc)
                    <p class="my-1">
                        {{ $treeReport->desc }}
                    </p>
                    @endif
                </a>
                @endforeach
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection