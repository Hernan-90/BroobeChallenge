@extends('layouts.principal')

@section('content')
    <section class="history-section centered">
        <div class="table-container">
            <table class="table">
                <tr>
                    <th class="table-head">URL</th>
                    <th class="table-head">ACCESSIBILITY</th>
                    <th class="table-head">PWA</th>
                    <th class="table-head">SEO</th>
                    <th class="table-head">PERFORMANCE</th>
                    <th class="table-head">BEST PRACTICES</th>
                    <th class="table-head">STRATEGY</th>
                    <th class="table-head">DATETIME</th>
                </tr>
                @forelse ($history as $metric)
                    <tr class="table-row">
                        <td class="table-value">{{ $metric->url }}</td>
                        <td class="table-value">{{ $metric->accessibility_metric }}</td>
                        <td class="table-value">{{ $metric->pwa_metric }}</td>
                        <td class="table-value">{{ $metric->performance_metric }}</td>
                        <td class="table-value">{{ $metric->seo_metric }}</td>
                        <td class="table-value">{{ $metric->best_practices_metric }}</td>
                        <td class="table-value">{{ $metric->strategy->name }}</td>
                        <td class="table-value">{{ $metric->created_at }}</td>
                    </tr>
                @empty
                    <tr><td>No hay metricas guardadas</td></tr>
                @endforelse
            </table>
        </div>
    </section>
@endsection