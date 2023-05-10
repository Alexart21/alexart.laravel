<audio preload="auto">
    <source src="{{ asset('audio/buben.mp3') }}" type="audio/mpeg">
    <source src="{{ asset('audio/buben.ogg') }}" type="audio/ogg">
</audio>
<a id="tg-btn-outher" href="https://t.me/Mihalych211" target="_blank"><div class="tg-btn"></div></a>
<script>
    window.addEventListener('load', () => {
        if (!('ontouchstart' in window || navigator.maxTouchPoints)){ // для десктопов
            console.log('desktop');
            setTimeout(() => {
                window.replainSettings = {
                    id: '7a62a2d7-0ab8-4734-a7be-954f867b1e2a',
                    onClientOpenedChat: () => {
                        // клиент открыл чат или открылся по таймеру
                        // куку на 1 час
                        // в течении часа не будет всплывашек
                        document.cookie = 'chat_open=1;max-age=3600';
                    },
                };
                (function(u){var s=document.createElement('script');s.async=true;s.src=u;
                    var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
                })('https://widget.replain.cc/dist/client.js');
            }, 3000);
            window.addEventListener('scroll', () => {
                // откроем через .. после скрола
                setTimeout(() => {
                    if(!readCookie('chat_open')){
                        window.ReplainAPI('open');
                        // установить стартовое сообщение (Перебивает то что было в настройках)
                        // window.ReplainAPI('setStartMessage', 'Привет!!! 👋');
                        // звук
                        let promise = document.querySelector('audio').play();
                        if (promise !== undefined) {
                            promise.then(_ => {
                                console.log('play!');
                            }).catch(err => {
                                console.log(err.message);
                            });
                        }
                    }
                }, 3000);
            })
        }else { // для мобил просто кнопка с ссылкой
            console.log('mobile');
            document.getElementById('tg-btn-outher').style.display = 'block';
        }
    });
</script>
