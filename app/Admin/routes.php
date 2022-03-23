<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // $router->resource('asuka_arousal', AsukaArousalController::class);
    // $router->resource('asuka_card', AsukaCardController::class);
    // $router->resource('asuka_proposal', AsukaProposalController::class);
    // $router->resource('asuka_skill', AsukaSkillController::class);
    // $router->resource('asuka_weapon', AsukaWeaponController::class);
    
    Route::group(['prefix' => 'pawapuro'], function () {
        // Route::resource('banner', 'Yume\Official\BannerController');
        Route::resource('deck', \Pawapuro\DeckController::class);
        Route::resource('player', \Pawapuro\PlayerController::class);
    });

    $router->resource('pawaapp_player', PAWAAPP_Player_Controller::class);
    $router->resource('pawaapp_player_skill', PAWAAPP_Player_Skill_Controller::class);

    // $router->resource('mhw_material_type', '\App\Admin\Controllers\MHW\MHW_Material_Type_Controller');
    // $router->resource('mhw_material', '\App\Admin\Controllers\MHW\MHW_Material_Controller');
    // $router->resource('mhw_skill', '\App\Admin\Controllers\MHW\MHW_Skill_Controller');
    // $router->resource('mhw_skill_series', '\App\Admin\Controllers\MHW\MHW_Skill_Series_Controller');
    // $router->resource('mhw_equipment', '\App\Admin\Controllers\MHW\MHW_Equipment_Controller');

    $router->resource('keywords/royal', '\App\Admin\Controllers\LineBot\RoyalBotController');
    $router->resource('keywords/monica', '\App\Admin\Controllers\LineBot\MonicaBotController');

});

