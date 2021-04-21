<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('report.index') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    @foreach ($tree as $treeCategory)
    <url>
        <loc>{{ route('report.index', ['category' => $treeCategory]) }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    @foreach ($treeCategory->reports as $treeReport)
    <url>
        <loc>{{ route('report.show', ['category' => $treeCategory, 'report' => $treeReport]) }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    @endforeach
    @endforeach
</urlset>