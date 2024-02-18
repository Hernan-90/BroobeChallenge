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

    <div class="modal-container centered" id="modal"></div>

    <script>
        $('#btn_save').hide()
        $('#spinner').hide()
        $('#modal').hide()

        $('#metrics-form').on('submit', function(e) {
            e.preventDefault()
            const categoryContainer = document.getElementById('categories-container')
            categoryContainer.innerHTML = ''
            const modalContent = document.getElementById('modal')
            modalContent.innerHTML = ''
            
            $('#spinner').show()
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
                error: function({responseJSON}, status) {
                    $('#spinner').hide()
                    showModal( modalContent, status, responseJSON.message)
                }
            });
        });

        $('#btn_save').on('click', function () {
            const modalContent = document.getElementById('modal')
            modalContent.innerHTML = ''

            const data = {
                url: document.getElementById('url').value,
                accessibility_metric: document.getElementById('accessibility') ? document.getElementById('accessibility').textContent : null,
                best_practices_metric: document.getElementById('best-practices') ? document.getElementById('best-practices').textContent : null,
                performance_metric: document.getElementById('performance') ? document.getElementById('performance').textContent : null,
                pwa_metric: document.getElementById('pwa') ? document.getElementById('pwa').textContent : null,
                seo_metric: document.getElementById('seo') ? document.getElementById('seo').textContent : null,
                strategy_id: document.getElementById('strategy').value == 'DESKTOP' ? 1 : 2,
            }

            $.ajax({
                url: "{{ route('store') }}",
                type: "POST",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: data,
                success: function(data, status) {
                    showModal( modalContent, status, data)
                },
                error: function({responseJSON}, status) {
                    showModal( modalContent, status, responseJSON.message)
                }
            });
        })
        
        const showModal = ( node, status, msg ) => {
            $('#modal').show()
            node.innerHTML = `
                <div class="modal-card">
                    <div class="modal-img-container centered ${status}">
                        <img src="{{ asset('img/${status}.png') }}" alt="Tour photo" class="modal-img">
                        <h2 class="modal-title">${status}</h2>
                    </div>
                    <div class="modal-info-container centered">
                        <p class="modal-text">${msg}</p>
                        <a href="#" class="btn btn-modal" onclick="modalClose()">close</a>
                    </div>
                </div>
            `
        }

        $('#modal').on('click', function () {
            $('#modal').hide()
        })
    </script>
@endsection