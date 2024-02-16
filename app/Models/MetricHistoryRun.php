<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricHistoryRun extends Model
{
    use HasFactory;

    protected $table = 'metric_history_run';

    protected $fillable = [
        'url',
        'accessibility_metric',
        'best_practices_metric',
        'performance',
        'pwa_metric',
        'seo_metric',
        'strategy_id',
    ];

    public function strategy(){
        return $this->belongsTo(Strategy::class);
    }

}
