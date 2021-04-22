<?php

namespace psw779\reports\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Report extends Model {

    use HasFactory;

    public function category() {
        return $this->belongsTo(ReportCategory::class);
    }

    public static function createTable() {
        $tableName = with(new static)->getTable();

        if (!Schema::hasTable($tableName))
            Schema::create($tableName, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('category_id');
                $table->string('name');
                $table->string('view')->nullable();
                $table->boolean('pub');
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('desc')->nullable();
                $table->integer('priority')->nullable();
            });
    }

}
