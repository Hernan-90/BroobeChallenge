<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        
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
            <form action={{ route('show') }} method="post" id="metrics-form">
                @csrf
                <div>
                    <label for="url">URL</label>
                    <input id="url" name="url" type="text" value="https://Broobe.com">
                </div>
                <div>
                    <label for="">CATEGORIES</label>
                    <div>
                        @foreach ($categories as $category)
                            <div>
                                <input type="checkbox" name="category[]" value={{ $category->name }}>
                                <label for="category">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label for="strategy">Strategy</label>
                    <select name="strategy" id="strategy">
                            <option value="" selected>Choose one</option>
                        @foreach($strategies as $strategy)
                            <option value={{ $strategy->name }}> {{ $strategy->name }} </option>
                        @endforeach
                    </select>
                </div>
                <button id="btn_submit">Get metrics</button>
            </form>
            <section>
                <div id="categories-container"></div>
                <button id="btn_save">Save Metric Run</button>
            </section>
        </main>
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
    </body>
</html>
