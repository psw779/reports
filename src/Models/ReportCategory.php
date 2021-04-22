<?php

namespace psw779\reports\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReportCategory extends Model {

    use HasFactory;

    public function reports() {
        return $this->hasMany(Report::class, 'category_id');
    }

    public static function createTable() {
        $tableName = with(new static)->getTable();

        if (!Schema::hasTable($tableName))
            Schema::create($tableName, function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('pub');
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('desc')->nullable();
                $table->integer('priority')->nullable();
            });
    }

}
