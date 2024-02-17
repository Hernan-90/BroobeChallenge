@extends('layouts.principal')

@section('content')
    <table>
        <tr>
            <th>URL</th>
            <th>ACCESSIBILITY</th>
            <th>PWA</th>
            <th>SEO</th>
            <th>PERFORMANCE</th>
            <th>BEST PRACTICES</th>
            <th>STRATEGY</th>
            <th>DATETIME</th>
        </tr>
        @forelse ($history as $metric)
            <tr>
                <td>{{ $metric->url }}</td>
                <td>{{ $metric->accessibility_metric }}</td>
                <td>{{ $metric->pwa_metric }}</td>
                <td>{{ $metric->performance_metric }}</td>
                <td>{{ $metric->seo_metric }}</td>
                <td>{{ $metric->best_practices_metric }}</td>
                <td>{{ $metric->strategy->name }}</td>
                <td>{{ $metric->created_at }}</td>
            </tr>
        @empty
            <tr><td>No hay metricas guardadas</td></tr>
        @endforelse
    </table>
@endsection