<?php

    namespace Martin\Strings\Updates;

    use Schema;
    use October\Rain\Database\Updates\Migration;
    use Martin\Strings\Models\String;

    class CreateStringsTable extends Migration {

        public function up() {

            Schema::create(String::TEMPLATE_VARS_TABLE_NAME, function($table) {
                $table->increments('id')->unsigned();
                $table->string('string_slug' , 100)->nullable(false)->unique();
                $table->string('string_label', 100)->nullable(false);
                $table->text  ('string_value'     )->nullable(false);
                $table->string('string_scope'     )->nullable(false);
                $table->text  ('string_help'      )->nullable(true);
                $table->timestamps();
            });

        }

        public function down() {
            Schema::dropIfExists(String::TEMPLATE_VARS_TABLE_NAME);
        }

    }

?>