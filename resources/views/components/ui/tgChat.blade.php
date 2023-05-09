{{--<audio preload="auto">
    <source src="{{ asset('audio/buben.mp3') }}" type="audio/mpeg">
    <source src="{{ asset('audio/buben.ogg') }}" type="audio/ogg">
</audio>--}}
<script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            window.replainSettings = { id: '7a62a2d7-0ab8-4734-a7be-954f867b1e2a' };
            (function(u){var s=document.createElement('script');s.async=true;s.src=u;
                var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
            })('https://widget.replain.cc/dist/client.js');
            // beep
            /*let promise = document.querySelector('audio').play();
            if (promise !== undefined) {
                promise.then(_ => {
                    console.log('play!');
                }).catch(err => {
                    console.log(err.message);
                });
            }*/
        }, 3000);
    });
</script>
