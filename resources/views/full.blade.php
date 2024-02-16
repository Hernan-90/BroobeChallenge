<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Challenge PHP - Broobe</title>

        <!-- Fonts -->

        <!-- Styles -->

    </head>
    <body >
        <header>
            <h1>Broobe Challenge</h1>
            <nav>
                <ul>
                    <li><a href={{ route('home') }}>Run Metric</a></li>
                    <li><a href={{ route('history') }}>Metric History</a></li>
                </ul>
            </nav>
        </header>
        <main>
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
        </main>
    </body>
</html>