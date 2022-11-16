<x-layouts.test title="Test form">
    <h1>DaData New datalist</h1>
    <p>Здесь для имитации datalist использованы файлы datalist.js(css)</p>
    <div id="universe">
        <h3 id="res2"></h3>
        <ul class="select-list-group" id="slg">
            <li>
                <form action="{{ route('test.save') }}" id="form2" method="POST">
                    @csrf
                    <input id="search2" name="q" type="text" class="select-list-group__search"
                           placeholder="начните печатать"/>
                </form>
                <span class="select-list-group__toggle"> </span>
                <ul class="select-list-group__list" data-toggle="false">
                    {{-->
                    <li class="select-list-group__list-item" data-display="true" data-highlight="false">Juin 2015</li>--}}
                </ul>
            </li>
        </ul>
    </div>
    <button type="submit" form="form2">SEND</button>
    <script>
        let inp2 = document.getElementById('search2');
        let form2 = document.getElementById('form2');
        let res2 = document.getElementById('res2');
        let listBlock = document.querySelector('.select-list-group__list');
        let str;
        inp2.addEventListener('input', (e) => {
            str = e.target.value;
            if (str.length > 3) { // со скольки букв начинать живой поиск
                fetchData2(form2);
            }
        });
        inp2.addEventListener('change', (e) => {
            res2.innerText = str;
        });

        //
        async function fetchData2(form) {
            let formData = new FormData(form);
            // console.log(inp2);
            // console.log(inp2.value);
            // return;
            let response = await fetch("{{ route('test.info') }}", {
                method: 'POST',
                body: formData
            });
            if (!response.ok) {
                console.log(response);
            } else {// статус 200
                result = await response.json();
                if (result.success) { // успешно
                    // let address = result.address;
                    // console.log(address)
                    if (result.address && result.count) {
                        console.log(result.address)
                        listBlock.innerHTML = '';
                        let arr = result.address;
                        arr.map((item) => {
                            let li = document.createElement('li');
                            li.classList.add('select-list-group__list-item');
                            li.setAttribute('data-display', 'true');
                            li.setAttribute('data-highlight', 'false');
                            li.innerText = item;
                            listBlock.prepend(li);
                        })
                        init_list();
                        /*let option = document.createElement('option')
                        option.value = address;
                        datalist.prepend(option);*/
                    }
                } else { // фиг знает че за ошибка
                    console.log(response);
                }
            }
        }
    </script>
    <hr>
    <style>
        .d-list, input#addr-inp, .d-list datalist, .d-list option {
            width: 100%;
            min-width: 500px;
            display: inline-block;
        }

        #addr-inp, #addr-inp:focus {
            /*border: none;*/
            outline: none;
            padding: .7em;
            font-size: 120%;
            border: 1px solid #e1a20e;
            border-radius: 5px;
        }

        #reset {
            display: inline-block;
        }

        [list]::-webkit-calendar-picker-indicator {
            display: none !important;
        }
    </style>
    <p>Стандартный браузерный datalist</p>
    <br>
    <h3>Введите адрес</h3>
    <h1 id="res"></h1>
    <div class="d-list">
        <form action="" id="addr-form">
            @csrf
            <input name="q" list="addr" id="addr-inp"><input id="reset" type="reset" value="X">
            <datalist id="addr">
            </datalist>
        </form>
    </div>
    <script>
        let inp = document.getElementById('addr-inp');
        let datalist = document.getElementById('addr');
        let addrForm = document.getElementById('addr-form');
        let res = document.getElementById('res');
        let q;
        inp.addEventListener('input', (e) => {
            q = e.target.value;
            if (q.length > 3) { // со скольки букв начинать живой поиск
                fetchData(addrForm);
            }
        });
        inp.addEventListener('change', (e) => {
            res.innerText = q;
        });

        async function fetchData(form) {
            let formData = new FormData(form);
            let response = await fetch("{{ route('test.info') }}", {
                method: 'POST',
                body: formData
            });
            if (!response.ok) {
                console.log(response);
            } else {// статус 200
                result = await response.json();
                if (result.success) { // успешно
                    let address = result.address;
                    // console.log(address)
                    if (result.address && result.count) {
                        console.log(result.address)
                        datalist.innerHTML = '';
                        let arr = result.address;
                        arr.map((item) => {
                            let option = document.createElement('option');
                            option.value = item;
                            datalist.prepend(option);
                        })
                        /*let option = document.createElement('option')
                        option.value = address;
                        datalist.prepend(option);*/
                    }
                } else { // фиг знает че за ошибка
                    console.log(response);
                }
            }
        }
    </script>
</x-layouts.test>
