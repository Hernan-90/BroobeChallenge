<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MetricHistoryRun;
use App\Models\Strategy;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MetricController extends Controller
{
    public function index(){
        $categories = Category::all();
        $strategies = Strategy::all();

        return view('sections.home', [
            'categories' => $categories,
            'strategies' => $strategies,
        ]);
    }

    public function requestMetrics(Request $request){
        $providedUrl = $request->url;
        $providedCategories = $request->category;
        $selectedStrategy = $request->strategy;

        $selectedCategories = '';
        foreach ($providedCategories as $value) {
            $selectedCategories = $selectedCategories . "category=$value&";
        }

        $key = config('services.metrics.key');
        $url = config('services.metrics.url')."?url=$providedUrl&key=$key&$selectedCategories"."strategy=$selectedStrategy";

        $client = new Client();
        $response = $client->request('GET', $url);

        $data = $response->getBody()->getContents();

        return json_decode($data);
    }

    public function storeMetrics(Request $request){
        $algo = new MetricHistoryRun();

        $algo->url = $request->url;
        $algo->accessibility_metric = $request->accessibility;
        $algo->best_practices_metric = $request->bestpractices;
        $algo->performance_metric = $request->performance;
        $algo->pwa_metric = $request->pwa;
        $algo->seo_metric = $request->seo;
        $algo->strategy_id = $request->strategy;

        $algo->save();

        return response()->json('excelente pa', 200);
    }

    public function showHistory(){
        $metricsHistory = MetricHistoryRun::all();

        return view('sections.history', [
            'history' => $metricsHistory,
        ]);
    }
}
