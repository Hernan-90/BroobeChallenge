@extends('layouts.principal')

@section('content')
    <section class="metric-section centered">
        <form action={{ route('show') }} method="post" id="metrics-form" class="form-container">
            @csrf
            <div class="row centered">
                <div class="side-70">
                    <label for="url" class="label">URL:</label>
                    <input id="url" name="url" type="text" class="url-input" value="https://broobe.com" required>
                </div>
                <div class="side-30">
                    <label for="strategy" class="label">STRATEGY:</label>
                    <select name="strategy" id="strategy" class="select-input" required>
                            <option value="" selected>Choose one</option>
                        @foreach($strategies as $strategy)
                            <option value={{ $strategy->name }}> {{ $strategy->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <label for="" class="label">CATEGORIES:</label>
                <div class="centered check-container">
                    @foreach ($categories as $category)
                        <div class="centered">
                            <input type="checkbox" name="category[]" class="checkbox-input" value={{ $category->name }} class>
                            <label for="category" class="check-label">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <button id="btn_submit" class="btn btn-metrics">GET METRICS</button>
        </form>

        <div class="score-container centered">
            <h2 class="score-title">Metric Scores:</h2>
            <div class="lds-ring" id="spinner"><div></div><div></div><div></div><div></div></div>
            <div id="categories-container" class="centered scores-metric"></div>
            <button id="btn_save" class="btn btn-save">Save Metric Run</button>
        </div>
    </section>

    <script>
        $('#btn_save').hide()
        $('#spinner').hide()

        $('#metrics-form').on('submit', function(e) {
            e.preventDefault()
            $('#spinner').show()
            const categoryContainer = document.getElementById('categories-container')
            categoryContainer.innerHTML = ''
            $('#btn_save').hide()

            $.ajax({
                url: "{{ route('show') }}",
                type: "POST",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: $(this).serialize(),
                success: function({lighthouseResult}) {
                    const {categories} = lighthouseResult
                    for (const category in categories) {
                        const {id, title, score} = categories[category]
                        categoryContainer.innerHTML += `
                            <div class="score-card ${id}-style">
                                <img src="{{ asset('img/${id}.png') }}" alt="" class="card-img">
                                <p class="score-category">${title}</p>
                                <p id=${id} class="score-value">${score}</p>
                            </div>
                        `
                    }
                    $('#btn_save').show()
                    $('#spinner').hide()
                },
                error: function(xhr, status, error) {
                    $('#spinner').hide()
                    console.error('AJAX Request Error:', status, error);
                }
            });
        });

        $('#btn_save').on('click', function () {
            const data = {
                url: document.getElementById('url').value,
                performance: document.getElementById('performance') ? document.getElementById('performance').textContent : null,
                accessibility: document.getElementById('accessibility') ? document.getElementById('accessibility').textContent : null,
                bestpractices: document.getElementById('best-practices') ? document.getElementById('best-practices').textContent : null,
                seo: document.getElementById('seo') ? document.getElementById('seo').textContent : null,
                pwa: document.getElementById('pwa') ? document.getElementById('pwa').textContent : null,
                strategy: document.getElementById('strategy').value == 'DESKTOP' ? 1 : 2,
            }

            $.ajax({
                url: "{{ route('store') }}",
                type: "POST",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: data,
                success: function(response) {
                    // console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Request Error:', status, error);
                }
            });
        })
    </script>
@endsection