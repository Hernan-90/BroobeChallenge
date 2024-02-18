<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetricStoreRequest;
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
        $validatedData = $request->validate([
            'category' => 'required|array',
        ]);

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

    public function storeMetrics(MetricStoreRequest $request){
        MetricHistoryRun::create($request->all());

        return response()->json('Los valores han sido guardados exitosamente', 200);
    }

    public function showHistory(){
        $metricsHistory = MetricHistoryRun::all();

        return view('sections.history', [
            'history' => $metricsHistory,
        ]);
    }
}
