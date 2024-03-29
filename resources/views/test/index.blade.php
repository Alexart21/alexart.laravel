<x-layouts.test title="Test form">
    <h1>TEST</h1>
    <form id="test-form" method="post" action="{{ route('test.store') }}" enctype="multipart/form-data">
        @csrf
        {{--Имя--: <input type="text" name="name" value="{{ old('name') }}" /><br>
        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        <div id="name-err-index" class="index-err-msg text-danger"></div>
        Email.--: <input type="text" name="email" value="{{ old('email') }}" /><br>
        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        <div id="email-err-index" class="index-err-msg text-danger"></div>
        Тел.--: <input type="text" name="phone" value="{{ old('phone') }}" /><br>
        @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
        <div id="phone-err-index" class="index-err-msg text-danger"></div>
        Текст.: <textarea name="body">{{ old('body') }}</textarea><br>
        @error('body')<div class="text-danger">{{ $message }}</div>@enderror
        <div id="body-err-index" class="index-err-msg text-danger"></div>--}}
        --Title--: <input type="text" name="title" value="{{ old('title') }}" /><br>
        @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        <input type="file" name="avatar" value="{{ old('avatar') }}">
        @error('avatar')
        <div class="text-danger">{{ $message }}</div>@enderror
        <button>Send</button>
    </form>
    @if($photos)
        <div style="display: flex">
            @foreach($photos as $photo)
                <div style="max-width: 300px">
                    <img style="max-width: 300px" src="{{ asset($photo->link) }}" alt=""><br>
                    @if($photo->title)
                       <p>{{ $photo->title }}</p>
                    @endif
                    <form method="post" action="{{ route('test.remove', [ $photo->id ]) }}">
                        @csrf
                        @method('DELETE')
                        <div>&nbsp;&nbsp;
                            <button class="btn btn-danger">удалить
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
    <script>
        /*let form = document.getElementById('test-form');
        form.onsubmit = async (e) => {
            e.preventDefault();
            // clearErrMsgs('index-err-msg');
            let formData = new FormData(form);
            let response = await fetch("{{ route('test.store') }}", {
               method: 'POST',
               body: formData
           });
           if (!response.ok) { // при ошибках 500 или других придет html страница ошибки а не json. Оповещаем и останавливаем
               if(response.status == 422){ // ошибки валидации
                   let result = await response.json();
                   console.log('validate errors');
                   let errors = result.errors;
                   for (let key in errors) { // выводим сообщения об ошибках
                       try {
                           let errBlock = document.getElementById(key + '-err-index');
                           errBlock.innerText = errors[key][0];
                       } catch (e) {
                           continue;
                       }
                   }
                   return;
               }else if(response.status == 500){
                   console.log(response);
                   return;
               }
               // другая ошибка
               console.log(response);
               return;
           }

           if (response.ok) {
               let result = await response.json();
               if (result.success) {
                   console.log('form submited');
               }

               // console.log(result);
           }
       }*/
    </script>
    <style>
        .orbit-loader {
            width: 24px;
            height: 24px;
            color: red;
            /*animation: rot 2s linear 0s infinite;*/
        }

        @keyframes rot {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .red-icon {
            width: 60px;
            height: 60px;
            fill: red;
        }

        .blue-icon {
            width: 40px;
            height: 40px;
            fill: blue;
        }
    </style>
    <img class="orbit-loader" src="{{ asset('svg/orbit-variant.svg') }}" alt="">
    @svg('svg/abacus.svg', 'red-icon')
    @svg('svg/account-badge.svg', 'blue-icon')
    <br>
    <a href="{{ route('test.download') }}">загрузить файл</a>
</x-layouts.test>
