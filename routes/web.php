<?php

use App\Http\Controllers\Controller;

Auth::routes();

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect('/offers');
    }

    if (Auth::user()->name == 'modelarnia') {
        return redirect('/patterns');
    } else {
        return redirect('/offers');
    }
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('raporty');
});


Route::prefix('/offers')->name('offers.')->group(function () {
    Route::get('/data', 'OffersController@getDataIndex')        ->name('data');
    Route::get('/materials/data', 'MaterialsController@getDataIndex')     ->name('materials.data');
    Route::resource('/materials', 'MaterialsController', ['except' => ['destroy','show']]);
    Route::resource('/{id}/details', 'DetailsController');
    Route::get('/details', 'DetailsController@getIndexDetails')    ->name('details');
    Route::get('/details/data', 'DetailsController@getDataDetails')     ->name('details-data');
    Route::get('/details/searching', 'SearchController@searchDetail')        ->name('details-searching');
    Route::post('/details/searching', 'SearchController@searchDetailResults')->name('details-searching-results');
    Route::get('/stats', 'StatsController@index')                ->name('stats');
});
Route::resource('/offers', 'OffersController', ['except' => ['destroy']]);

Route::prefix('/tech')->group(function () {
    Route::get('/orders/data', 'OrdersController@getIndexData')                ->name('orders.data');
    Route::resource('/orders', 'OrdersController');
});



Route::prefix('reports')->group(function () {
    Route::get('/czas-wykonania', 'KokilaReportsController@czaswykonania_search') ->name('czas-wykonania');
    Route::post('/czas-wykonania', 'KokilaReportsController@czaswykonania_results')->name('czas-wykonania-results');
    Route::get('/odbiory', 'KokilaReportsController@getIndexOdbiory')      ->name('odbiory');
    Route::get('/odbiory/data', 'KokilaReportsController@getDataOdbiory')       ->name('odbiory-data');
    Route::get('/zalania', 'KokilaReportsController@getIndexZalania')      ->name('zalania');
    Route::get('/zalania/data', 'KokilaReportsController@getDataZalania')       ->name('zalania-data');
    Route::get('/niezgodnosci', 'KokilaReportsController@getIndexNiezgodnosci') ->name('niezgodnosci');
    Route::get('/niezgodnosci/data', 'KokilaReportsController@getDataNiezgodnosci')  ->name('niezgodnosci-data');
    Route::get('/uwagi', 'KokilaReportsController@getIndexUwagi')        ->name('uwagi');
    Route::get('/uwagi/data', 'KokilaReportsController@getDataUwagi')         ->name('uwagi-data');
    Route::get('/raporty', 'KokilaReportsController@raporty')              ->name('raporty');
    Route::get('/weight-per-client', 'KokilaReportsController@weightperclient')      ->name('weight-per-client');
    Route::get('/weight-per-group', 'KokilaReportsController@weightpergroup')       ->name('weight-per-group');
    Route::get('/wybraki', 'KokilaReportsController@wybraki')              ->name('wybraki');
    Route::get('/wagi-odlewow', 'KokilaReportsController@getIndexWagiOdlewów')  ->name('wagi-odlewow');
    Route::get('/wagi-odlewow/data', 'KokilaReportsController@getDataWagiOdlewów')   ->name('wagi-odlewow-data');
    Route::get('/monitoring-in-work', 'KokilaReportsController@monitoring_inwork')   ->name('monitoring-in-work');
    Route::get('/monitoring-all', 'KokilaReportsController@monitoring_all')       ->name('monitoring-all');
    Route::get('/logs', 'KokilaReportsController@logs');
    Route::get('/magazyn', 'KokilaReportsController@stan_magazynowy')      ->name('magazyn');
    Route::get('/zaformowane', 'KokilaReportsController@getIndexZaformowane')  ->name('zaformowane');
    Route::get('/zaformowane/data', 'KokilaReportsController@getDataZaformowane')   ->name('zaformowane-data');
    Route::get('/badania-ndt', 'KokilaReportsController@getIndexBadaniaNDT')   ->name('badania-ndt');
    Route::get('/badania-ndt/data', 'KokilaReportsController@getDataBadaniaNDT')    ->name('badania-ndt-data');
    Route::get('/machining', 'KokilaReportsController@getIndexMachining')    ->name('machining');
    Route::get('/machining/data', 'KokilaReportsController@getDataMachining')     ->name('machining-data');
    Route::get('/uzyski', 'KokilaReportsController@getIndexUzyski')       ->name('uzyski');
    Route::get('/uzyski/data', 'KokilaReportsController@getDataUzyski')        ->name('uzyski-data');
    Route::get('/inserted-datas', 'KokilaReportsController@inserted_datas')       ->name('inserted-datas');
});

 
Route::prefix('kokila')->group(function () {
    Route::get('/czaswykonania', function () {
        (new Controller)->insertLog('czas_wykonania_old_link');
        return redirect()->route('czas-wykonania');
    });
    Route::get('/odbiory', function () {
        (new Controller)->insertLog('odbiory_old_link');
        return redirect()->route('odbiory');
    });
    Route::get('/zalania', function () {
        (new Controller)->insertLog('zalania_old_link');
        return redirect()->route('zalania');
    });
    Route::get('/niezgodnosci', function () {
        (new Controller)->insertLog('niezgodnosci_old_link');
        return redirect()->route('niezgodnosci');
    });
    Route::get('/uwagi', function () {
        (new Controller)->insertLog('uwagi_old_link');
        return redirect()->route('uwagi');
    });
    Route::get('/raporty', function () {
        (new Controller)->insertLog('raporty_old_link');
        return redirect()->route('raporty');
    });
    Route::get('/weightperclient', function () {
        (new Controller)->insertLog('weightperclient_old_link');
        return redirect()->route('weight-per-client');
    });
    Route::get('/weightpergroup', function () {
        (new Controller)->insertLog('weightpergroup_old_link');
        return redirect()->route('weight-per-group');
    });
    Route::get('/wybraki', function () {
        (new Controller)->insertLog('wybraki_old_link');
        return redirect()->route('wybraki');
    });
    Route::get('/wagiodlewow', function () {
        (new Controller)->insertLog('wagiodlewow_old_link');
        return redirect()->route('wagi-odlewow');
    });
    Route::get('/monitoring_inwork', function () {
        (new Controller)->insertLog('monitoring_inwork_old_link');
        return redirect()->route('monitoring-in-work');
    });
    Route::get('/monitoring_all', function () {
        (new Controller)->insertLog('monitoring_all_old_link');
        return redirect()->route('monitoring-all');
    });
    Route::get('/magazyn', function () {
        (new Controller)->insertLog('magazyn_old_link');
        return redirect()->route('magazyn');
    });
    Route::get('/zaformowane', function () {
        (new Controller)->insertLog('zaformowane_old_link');
        return redirect()->route('zaformowane');
    });
    Route::get('/badania_ndt', function () {
        (new Controller)->insertLog('badania_ndt_old_link');
        return redirect()->route('badania-ndt');
    });
    Route::get('/machining', function () {
        (new Controller)->insertLog('machining_old_link');
        return redirect()->route('machining');
    });
    Route::get('/uzyski', function () {
        (new Controller)->insertLog('uzyski_old_link');
        return redirect()->route('uzyski');
    });
    Route::get('/inserted_datas', function () {
        (new Controller)->insertLog('inserted_datas_old_link');
        return redirect()->route('inserted-datas');
    });
});

Route::get('/raporty', function () {
    (new Controller)->insertLog('raporty_very_old_link');
    return redirect()-route('raporty');
});

Route::prefix('/patterns')->name('patterns.')->group(function () {
    Route::get('/data', 'PatternsController@getDataIndex')  ->name('data');
    Route::get('/patterns-status/{id}', 'PatternsController@changeStatus')  ->name('status-change');
    Route::post('/patterns-status/{id}', 'PatternsController@updateStatus')  ->name('status-update');
    // Route::get('/patterns_search',              'PatternsController@search');
    // Route::post('/patterns_search',             'PatternsController@search_results');
    Route::get('/patterns-report', 'PatternsController@raport')        ->name('report-form');
    Route::post('/patterns-report', 'PatternsController@raport_show')   ->name('report-results');
    Route::get('/patterns-delete-protocol/{id}', 'PatternsController@delete_protocol');

    // old urls
    Route::get('/patterns_status/{id}', function () {
        return redirect()->route('patterns.status-change');
    });
    Route::post('/patterns_status/{id}', function () {
        return redirect()->route('patterns.status-update');
    });
    Route::get('/patterns_raport', function () {
        return redirect()->route('patterns.report-form');
    });
    Route::post('/patterns_raport', function () {
        return redirect()->route('patterns.report-results');
    });
});

Route::resource('/patterns', 'PatternsController');
Route::get('/modele', function () {
    return redirect()->route('patterns.index');
});
