<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sections = \App\Helpers\Admin\Helper::getAdminSections();
        $array = [];
        foreach ($sections as $path => $section){
            if (isset($section['children'])){
                foreach ($section['children'] as $path2 => $section2){
                    $array[] = ['path' => $path2, 'type' => 'read', 'user_class_id' => 1];
                    $array[] = ['path' => $path2, 'type' => 'edit', 'user_class_id' => 1];
                    $array[] = ['path' => $path2, 'type' => 'delete', 'user_class_id' => 1];
                }
            }
            else{
                $array[] = ['path' => $path, 'type' => 'read', 'user_class_id' => 1];
                $array[] = ['path' => $path, 'type' => 'edit', 'user_class_id' => 1];
                $array[] = ['path' => $path, 'type' => 'delete', 'user_class_id' => 1];
            }
        }

        DB::table('admin_access_rights')->insert($array);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
