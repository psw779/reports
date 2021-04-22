<?php

namespace psw779\reports\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use psw779\reports\Models\Report;
use psw779\reports\Models\ReportCategory;

class ReportController extends Controller {

    public function __construct() {
        if (config('reports.auth', true))
            $this->middleware(['web', 'auth']);
    }

    private function checkPub($object) {
        if (!in_array(Auth::id(), config('reports.adminIds')) && $object->pub != 1)
            return abort(404);
    }

    private function getPage($object = null) {
        return [
            'title' => $object ? implode(' - ', [$object->title, config('reports.page.name')]) : config('reports.page.title'),
            'desc' => $object ? $object->desc : config('reports.page.desc'),
            'tree' => $this->getTree(),
        ];
    }

    private function getTree($category = null) {
        return ReportCategory::with(['reports' => function($query) use ($category) {
                                $query->when(!in_array(Auth::id(), config('reports.adminIds')), function ($query) {
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
                        ->when(!in_array(Auth::id(), config('reports.adminIds')), function ($query) {
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

        return view('reports::index', compact('category', 'page', 'tree'));
    }

    public function show(ReportCategory $category, Report $report) {
        $this->checkPub($category);
        $this->checkPub($report);

        $page = $this->getPage($report);

        $reportClass = 'App\\Reports\\' . $report->name;
        $r = (new $reportClass(['report' => $report]))->run();

        $reportContent = $r->render($report->view ?? $report->name, true);

        return view('reports::show', compact('category', 'report', 'page', 'reportContent', 'r'));
    }

    public function sitemap() {
        return response()
                        ->view('report.sitemap', ['tree' => $this->getTree()])
                        ->header('Content-Type', 'application/xml');
    }

}
