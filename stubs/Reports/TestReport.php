<?php

namespace App\Reports;

use App\Models\Material;

class TestReport extends \koolreport\KoolReport {

    function settings() {
        return array(
            'dataSources' => array(
                'elo' => array(
                    'class' => '\koolreport\laravel\Eloquent',
                )
            ),
        );
    }

    function setup() {
        $materials = Material::select('brand')
                ->selectRaw('count(*) as total')
                ->selectRaw('convert(avg(id), int) as avgid')
                ->filter()
                ->groupBy('brand')
                ->orderBy('total')
                ->take(100);

        $this->src('elo')
                ->query($materials)
                ->pipe($this->dataStore('data'));
    }

}
