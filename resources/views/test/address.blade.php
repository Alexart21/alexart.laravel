<x-layouts.test title="Test form">
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
    <h1>DaData</h1>
    <br>
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
                // fetchData2();
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
