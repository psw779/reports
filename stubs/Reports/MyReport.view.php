<?php

use \koolreport\widgets\koolphp\Table;

Table::create([
    "dataSource" => $this->dataStore("offices"),
]);
