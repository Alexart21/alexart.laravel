<style>
    .hh{
        text-align: center;
        font-family: "Helvetica Neue Light", "HelveticaNeue-Light", "Helvetica Neue", Calibri, Helvetica, Arial, sans-serif;
    }
</style>
@php
$msg = 'Не более ' . config('app.all_forms_rate_limit') . ' попыток в минуту';
@endphp
@extends('errors::minimal')
<h3 class="hh" style="text-shadow: 1px 0 red;">{{ $msg }}</h3>
@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Превышен лимит запросов!'))

<h2 class="hh" id="timer">60</h2>

<script>
    function tiktak()
    {
        let timer=document.getElementById("timer");
        let secs=timer.innerHTML;
        --secs;
        timer.innerHTML=secs;
        if(secs==0)
        {
            document.location.reload();
        }


    }
    document.addEventListener('DOMContentLoaded', function(){
        setInterval(tiktak,1000);
    });
</script>
