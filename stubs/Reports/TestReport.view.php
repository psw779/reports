<div class="<?php print config('reports.css.wrapper'); ?>">
    <div class="<?php print config('reports.css.chart'); ?>">
        <?php
        \koolreport\widgets\google\ColumnChart::create([
            'dataSource' => $this->dataStore('data'),
        ]);
        ?>
    </div>
</div>
<div class="<?php print config('reports.css.wrapper'); ?>">
    <?php
    \koolreport\widgets\koolphp\Table::create([
        'dataSource' => $this->dataStore('data'),
        'cssClass' => [
            'table' => config('reports.css.table'),
        ]
    ]);
    ?>
</div>