@extends('layouts.principal')

@section('content')
    <form action={{ route('show') }} method="post" id="metrics-form" class="form-container">
        @csrf
        <div class="centered">
            <div>
                <label for="url">URL:</label>
                <input id="url" name="url" type="text" value="https://Broobe.com">
            </div>
            <div>
                <label for="strategy">STRATEGY:</label>
                <select name="strategy" id="strategy">
                        <option value="" selected>Choose one</option>
                    @foreach($strategies as $strategy)
                        <option value={{ $strategy->name }}> {{ $strategy->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="">CATEGORIES:</label>
            <div class="centered">
                @foreach ($categories as $category)
                    <div>
                        <input type="checkbox" name="category[]" value={{ $category->name }}>
                        <label for="category">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <button id="btn_submit">Get metrics</button>
    </form>

    <section>
        <div id="categories-container"></div>
        <button id="btn_save">Save Metric Run</button>
    </section>

    <script>
        $('#btn_save').hide()
        $('#metrics-form').on('submit', function(e) {
            const categoryContainer = document.getElementById('categories-container')

            e.preventDefault()
            $.ajax({
                url: "{{ route('show') }}",
                type: "POST",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: $(this).serialize(),
                success: function({lighthouseResult}) {
                    categoryContainer.innerHTML = ''
                    const {categories} = lighthouseResult
                    for (const category in categories) {
                        const {id, title, score} = categories[category]
                        categoryContainer.innerHTML += `
                            <div>
                                <p>${title}</p>
                                <p id=${id}>${score}</p>
                            </div>
                        `
                    }
                    $('#btn_save').show()
                },
                error: function(xhr, status, error) {
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