<x-layouts.admin title="Режим contenteditable">
    <div class="c-main">
        <h3>Режим contenteditable страница : {{ $data->page }}</h3>
        <h4><a href="{{ route('content.edit', [$data->id]) }}">в режим редактора</a></h4>
        <div class="contenteditable-block" contenteditable="true">
            {!! $data->page_text !!}
        </div>
        <h3 id="result-block"></h3>
        <button id="content-suuccess" class="btn btn-success">Отправить</button>
        <span id="c_loader">...отправка</span>
        <script>
            let contentBlock = document.querySelector('.contenteditable-block');
            let csrf = document.getElementById('_csrf_token').getAttribute('content');
            let btnS = document.getElementById('content-suuccess');
            let c_loader = document.getElementById('c_loader');
            let resultBlock = document.getElementById('result-block');
            // console.log(csrf);
            btnS.addEventListener('click', () => {
                fetchContent()
            });

            async function fetchContent() {
                c_loader.style.display = 'block';
                let url = '{{ route('contenteditable.store') }}';
                let data = contentBlock.innerHTML;
                // let formData = new FormData();
                await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify({
                        _token: csrf,
                        id: {{ $data->id }},
                        data: data
                    })
                })
                    .then(response => response.json())
                    .then(result => {
                        console.log(result);
                        resultBlock.innerHTML = '<span style="color:green">Успешно!</span>';
                        c_loader.style.display = 'none';
                        setTimeout(() => {
                            resultBlock.innerHTML = '';
                        }, 5000)
                    })
                    .catch(error => {
                        console.log(error);
                        c_loader.style.display = 'none';
                        resultBlock.innerHTML = '<span style="color:red">Ошибка!</span>';
                        setTimeout(() => {
                            resultBlock.innerHTML = '';
                        }, 5000)
                    })
            }
        </script>
    </div>
</x-layouts.admin>
