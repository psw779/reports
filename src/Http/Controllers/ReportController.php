<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Report;
use App\Models\ReportCategory;

class ReportController extends Controller {

    public function __construct() {
        if (config('report.auth', true))
            $this->middleware('auth');
    }

    private function checkPub($object) {
        if (!in_array(Auth::id(), config('report.adminIds')) && $object->pub != 1)
            return abort(404);
    }

    private function getPage($object = null) {
        return [
            'title' => $object ? implode(' - ', [$object->title, config('report.page.name')]) : config('report.page.title'),
            'desc' => $object ? $object->desc : config('report.page.desc'),
            'tree' => $this->getTree(),
        ];
    }

    private function getTree($category = null) {
        return ReportCategory::with(['reports' => function($query) use ($category) {
                                $query->when(!in_array(Auth::id(), config('report.adminIds')), function ($query) {
                                    return $query->where('pub', 1);
                                })
                                ->when($category, function ($query, $category) {
                                    return $query->where('category_id', $category->id);
                                })
                                ->orderBy('priority', 'DESC')
                                ->orderBy('title');
                            }])
                        ->when($category, function ($query, $category) {
                            return $query->where('id', $category->id);
                        })
                        ->when(!in_array(Auth::id(), config('report.adminIds')), function ($query) {
                            return $query->where('pub', 1);
                        })
                        ->orderBy('priority', 'DESC')
                        ->orderBy('title')
                        ->get();
    }

    public function index(ReportCategory $category = null) {
        if ($category)
            $this->checkPub($category);

        $page = $this->getPage($category);

        $tree = $category ? $this->getTree($category) : $page['tree'];

        return view('report.index', compact('category', 'page', 'tree'));
    }

    public function show(ReportCategory $category, Report $report) {
        $this->checkPub($category);
        $this->checkPub($report);

        $page = $this->getPage($report);

        $reportClass = 'App\\Reports\\' . $report->name;
        $reportContent = (new $reportClass(['report' => $report]))->run()->render($report->view ?? $report->name, true);

        return view('report.show', compact('category', 'report', 'page', 'reportContent'));
    }

    public function sitemap() {
        return response()
                        ->view('report.sitemap', ['tree' => $this->getTree()])
                        ->header('Content-Type', 'application/xml');
    }

}
