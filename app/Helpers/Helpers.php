<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('globalFunction')) {
    function rating($id_menu)
    {
        // Logika function global
        $rating = DB::table('rating_comments')
            ->select(DB::raw('ifnull(sum(rating),0) as rating'))
            ->where('id_menu', $id_menu)->first();
        $total = DB::table('rating_comments')
            ->select(DB::raw('count(rating) as total'))
            ->where('id_menu', $id_menu)->first();
        if($rating->rating > 0){

        echo number_format($rating->rating / $total->total, 1, '.', '');
        }

    }
}
