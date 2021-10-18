<?php

Route::get('/countries/autocomplete', [AscentCreative\Geo\Controllers\CountryController::class, 'autocomplete']);

Route::get('/geo-check', function() {
    dump(AscentCreative\Geo\Models\Country::countErrors());
});

Route::get('/geo-country-tree', function() {
   
    $nodes = AscentCreative\Geo\Models\Country::get()->toTree();
    echo '<PRE>';
    $traverse = function ($categories, $prefix = '') use (&$traverse) {
        foreach ($categories as $category) {
            echo "".$prefix.' '.$category->name . "<br/>";
    
            $traverse($category->children, $prefix.'-');
        }
    };

    echo '</PRE>';
    
    $traverse($nodes);

});



/* Route::get('/geo-install', function() {

    foreach(AscentCreative\Geo\Models\Country::all() as $country) {
        echo $country->name;
        //$country->name = str_replace('*', '', $country->name);
        //$country->name .= '*';
        //$country->created_at = new DateTime();
        $country->save();
    }

    // foreach(AscentCreative\Geo\Models\Country::where('_lft', '>', 569)->where('_rgt', '<', 842)->get() as $uk) {
    //     $uk->delete();
    // }

    //dump(AscentCreative\Geo\Models\Country::where('name', 'England')->first()->descendants);

    foreach(AscentCreative\Geo\Models\Country::where('name', 'England')->first()->children as $node) {
      //  @dump('delete ' . $node->name);
        $node->delete();

    }

    foreach(AscentCreative\Geo\Models\Country::where('name', 'Northern Ireland')->first()->children as $node) {
    
        $node->delete();

    }

    foreach(AscentCreative\Geo\Models\Country::where('name', 'Scotland')->first()->children as $node) {
    
        $node->delete();

    }
    
    
    foreach(AscentCreative\Geo\Models\Country::where('name', 'Wales')->first()->children as $node) {
    
        $node->delete();

    }



    // AscentCreative\Geo\Models\Country::fixTree();

    dump(AscentCreative\Geo\Models\Country::countErrors());


}); */

