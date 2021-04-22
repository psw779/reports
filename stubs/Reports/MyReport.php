<?php

namespace App\Reports;

use App\Models\Material;

class MyReport extends \koolreport\KoolReport {

    use \koolreport\laravel\Friendship;

    function settings() {
        return array(
            'dataSources' => array(
                'elo' => array(
                    'class' => '\koolreport\laravel\Eloquent',
                )
            ),
            "assets" => array(
                "path" => "../../public/resources/kool",
                "url" => "resources/kool",
            ),
        );
    }

    function setup() {
        $materials = Material::select('sku', 'name', 'brand')
                ->filter()
                ->take(10);

        $this->src('elo')
                ->query($materials)
                ->pipe($this->dataStore('offices'));
    }

}
