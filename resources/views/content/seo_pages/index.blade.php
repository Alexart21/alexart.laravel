@php
    use App\Models\Content;
    $data = new Content();
    $data->title_seo = 'Поисковая оптимизация сайтов в Чебоксарах';
    $data->description = 'Поисковая оптимизация ускорение скорости загрузки сайтов в Чебоксарах';
@endphp
<x-layouts.main :data="$data">
    <link rel="stylesheet" href="/css/seo.css">
    <h1>Поисковая оптимизация сайтов</h1>
    <div class="centerwrap relative">
        <div id="js-headertext" class="headertext">
            <h1>SEO-студия «Улучшатель сайтов»</h1>
            <span class="headertext_subtitle">
                        <span class="fs30">Делаем продвижение эффективным</span><br>
                        С нас — техническая оптимизация сайта,<br>у вас — больше продаж при меньшем рекламном бюджете.

                    </span>
        </div>
        <nav class="main-icons">
            <div class="seo-link-outer">
                <a class="seo-link d-flex" href="{{ route('seo.speed') }}">
                    <div class="main-nav-icon d-flex">
                                <span class="for-img">
                                    <img src="/img/seo/seo_icon.svg#speed" alt="Скорость сайтов">
                                </span>
                        <span class="for-txt">
                                    Ускорение
                                    <br>
                                    загрузки сайта
                                </span>
                    </div>
                </a>
            </div>
            <div class="seo-link-outer">
                <a class="seo-link d-flex" href="{{ route('seo.tech') }}">
                    <div class="main-nav-icon d-flex">
                                <span class="for-img">
                                    <img src="/img/seo/seo_icon.svg#seo" alt="Внутренняя SEO оптимизация">
                                </span>
                        <span class="dib v-align-m ml10 for-txt">
                                    Внутренняя SEO
                                    <br>
                                    оптимизация
                                </span>
                    </div>
                </a>
            </div>
            <div class="seo-link-outer">
                <a class="seo-link d-flex" href="{{ route('seo.semantic') }}">
                    <div class="main-nav-icon d-flex">
                                <span class="for-img">
                                    <img src="/img/seo/seo_icon.svg#semantic" alt="Семантический веб">
                                </span>
                        <span class="dib v-align-m ml10 for-txt">
                                    Семантическая
                                    <br>
                                    структура сайта
                                </span>
                    </div>
                </a>
            </div>
        </nav>
    </div>
    <h2 class="container text-center">
        Как аудит и исправление ошибок влияет на продажи
    </h2>
    <div class="text-center h3">Рассмотрим на примере</div>
    <div>
        {{----}}
        <div class="audit-block lightGray">
            <div class="audit-block__items">
                <div class="audit-block__item">
                    <div class="audit-block__item-bg">
                        <svg viewBox="0 0 504 258" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <symbol id="chart-arrow-up" viewBox="0 0 48 48">
                                    <path
                                        d="M24 40.35q-.95 0-1.6-.65-.65-.65-.65-1.65V16.4l-9.2 9.25q-.75.7-1.65.7-.9 0-1.6-.7-.7-.7-.7-1.65t.7-1.7L22.4 9.25q.3-.4.725-.575.425-.175.925-.175.4 0 .825.175.425.175.725.525l13.15 13.1q.7.75.7 1.7t-.7 1.65q-.7.7-1.625.7t-1.575-.7L26.3 16.4v21.65q0 1-.675 1.65-.675.65-1.625.65Z"></path>
                                </symbol>
                                <symbol id="chart-arrow-down" viewBox="0 0 48 48">
                                    <path
                                        d="M24 39.45q-.45 0-.875-.175t-.725-.525L9.3 25.65q-.7-.65-.7-1.625t.7-1.625q.7-.7 1.625-.7t1.625.7l9.2 9.1V9.9q0-.95.65-1.625T24 7.6q1 0 1.65.675.65.675.65 1.625v21.6l9.2-9.15q.65-.65 1.6-.65.95 0 1.65.7.7.65.7 1.6 0 .95-.7 1.65L25.6 38.75q-.35.35-.75.525-.4.175-.85.175Z"></path>
                                </symbol>
                                <pattern id="chart-grid-pattern" viewBox="0 0 50.4 25.8" width="9.975%" height="9.95%">
                                    <g fill="rgba(0,0,0,.25)">
                                        <rect x="0" y="0" width="100%" height="1"></rect>
                                        <rect x="0" y="0" width="1" height="100%"></rect>
                                    </g>
                                </pattern>
                            </defs>
                            <rect id="chart-grid" x="0" y="0" width="100%" height="100%"
                                  fill="url(#chart-grid-pattern)"></rect>
                            <path
                                d="m0 187.13 31 7 38-2 35 1 35 10 31 7 38-1 36-6 34-12 33 3 37-4 32 17 37-9 35-3 33 12 19-2"
                                fill="none" stroke="red" stroke-width="2"></path>
                        </svg>
                    </div>
                    <div class="audit-block__item-content">
                        <h3 class="audit-block__item-content-title fs22 bold">ДО исправления ошибок</h3>
                        <div class="audit-block__values audit-block__values--down">
                            <div class="audit-block__values-item">
                                <div class="audit-block__values-item-text"><span>10 000 </span><span>посещений</span>
                                </div>
                                <svg class="audit-block__values-item-icon">
                                    <use xlink:href="#chart-arrow-down"></use>
                                </svg>
                            </div>
                            <div class="audit-block__values-item">
                                <div class="audit-block__values-item-text"><span>500 </span><span>заявок</span></div>
                                <svg class="audit-block__values-item-icon">
                                    <use xlink:href="#chart-arrow-down"></use>
                                </svg>
                            </div>
                            <div class="audit-block__values-item">
                                <div class="audit-block__values-item-text"><span>400 </span><span>продаж</span></div>
                                <svg class="audit-block__values-item-icon">
                                    <use xlink:href="#chart-arrow-down"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="audit-block__item">
                    <div class="audit-block__item-bg">
                        <svg viewBox="0 0 504 258" xmlns="http://www.w3.org/2000/svg">
                            <use xlink:href="#chart-grid"></use>
                            <path
                                d="m0 205.13 16-1 36 2 35-8 34-28 36-3 35-6 33 3 36-8 29-23 40-24 35-21 34-51 34-24 35 28 36-6"
                                fill="none" stroke="green" stroke-width="2"></path>
                        </svg>
                    </div>
                    <div class="audit-block__item-content">
                        <h3 class="audit-block__item-content-title fs22 bold">ПОСЛЕ</h3>
                        <div class="audit-block__values audit-block__values--up">
                            <div class="audit-block__values-item">
                                <div class="audit-block__values-item-text"><span>11 000 </span><span>посещений</span>
                                </div>
                                <svg class="audit-block__values-item-icon">
                                    <use xlink:href="#chart-arrow-up"></use>
                                </svg>
                            </div>
                            <div class="audit-block__values-item">
                                <div class="audit-block__values-item-text"><span>550 </span><span>заявок</span></div>
                                <svg class="audit-block__values-item-icon">
                                    <use xlink:href="#chart-arrow-up"></use>
                                </svg>
                            </div>
                            <div class="audit-block__values-item">
                                <div class="audit-block__values-item-text"><span>450 </span><span>продаж</span></div>
                                <svg class="audit-block__values-item-icon">
                                    <use xlink:href="#chart-arrow-up"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{----}}
        <div class="h3 text-center">Если средний чек вашего продукта,
            к примеру, 10 000 руб., это
        </div>
        <div class="h1 text-center red">+ 500 000 руб.</div>
    </div>
    <div class="text-center container">
        <span class="h1">Как показывает практика,</span>
        <span class="h1 mark">у 9 из 10 сайтов есть ошибки!</span>
    </div>
    <br>
    <div class="text-center h3">
        В этом нет вины ваших программистов, просто техническая оптимизация — отдельная задача для соответствующих
        специалистов.
    </div>
    <br>
    <div class="d-flex justify-content-center container text-center">
        <div class="h1 w-50 d-flex flex-column justify-content-center">
            <span class="h1 header_shadow">За счет чего достигается результат</span>
        </div>
        <div class="w-50 border-left motiv">
            <p class="h2 header_shadow">
                Яндекс и Google начинают правильно «видеть» сайт и выводить его выше при нужных запросах
            </p>
            <p>
                Увеличивается скорость сайта, а вместе с тем и конверсия.
            </p>
            <p>
                С ростом посещаемости и конверсии вы получаете больше заявок.
            </p>
        </div>
    </div>
    <p class="h2 container text-center">Как мы работаем</p>
    <div class="container d-flex justify-content-center">
        <div class="etap-block d-flex">
            <div class="d-flex flex-column w-75">
                <div class="d-flex justify-content-center w-100">
                    @svg('svg/format-list-bulleted.svg', 'etap-icon')
                </div>
                <div class="h3 text-center header_shadow">Аудит</div>
                <div class="text-center">
                    Заказываете анализ сайта, чтобы узнать ошибки, понять объём работ и примерный бюджет.
                </div>
            </div>
            @svg('svg/arrow-right-thin.svg', 'etap-icon')
        </div>
        <div class="etap-block d-flex">
            <div class="d-flex flex-column w-75">
                <div class="d-flex justify-content-center w-100">
                    @svg('svg/format-list-numbered-rtl.svg', 'etap-icon')
                </div>
                <div class="h3 text-center header_shadow">Список</div>
                <div class="text-center">
                    Теперь вы знаете все проблемы сайта, приоритет исправления ошибок, цены, сроки.
                </div>
            </div>
            @svg('svg/arrow-right-thin.svg', 'etap-icon')
        </div>
        <div class="etap-block d-flex">
            <div class="d-flex flex-column w-75">
                <div class="d-flex justify-content-center w-100">
                    @svg('svg/cog.svg', 'etap-icon')
                </div>
                <div class="h3 text-center header_shadow">Исправление</div>
                <div class="text-center">
                    Заказываете поочерёдное исправление ошибок сайта по пунктам аудита.
                </div>
            </div>
            @svg('svg/arrow-right-thin.svg', 'etap-icon')
        </div>
        <div class="etap-block d-flex">
            <div class="d-flex flex-column w-75">
                <div class="d-flex justify-content-center w-100">
                    @svg('svg/check-outline.svg', 'etap-icon')
                </div>
                <div class="h3 text-center header_shadow">Готово!</div>
                <div class="text-center">
                    Получаете быстрый, оптимизированный и понятный сайт для поисковых систем.
                </div>
            </div>
            @svg('svg/arrow-right-thin.svg', 'etap-icon')
        </div>
    </div>
    <div class="lightGray container">
        <div class="text-center h1 header_shadow">
            Для тех кому нужна прверка сайта
        </div>
        <div class="container d-flex justify-content-center">
            <a class="d-block req-item w-25 d-flex flex-column justify-content-around" href="{{ route('seo.speed') }}">
                <img loading="lazy" src="/img/seo/seo_speed.jpg" alt="">
                <div class="h3 text-center header_shadow">Аудит скорости</div>
                <p>
                    Найдём проблемы, влияющие на скорость загрузки сайта. Расставим их в порядке важности. Пусть ваш
                    сайт "летает"!
                </p>
                <div class="req-price d-flex justify-content-between">
                    <div><b>1 - 3 дня</b></div>
                    <div><span class="red">12 000</span> ₽</div>
                </div>
            </a>
            <a class="d-block req-item w-25 d-flex flex-column justify-content-around" href="{{ route('seo.tech') }}">
                <img loading="lazy" src="/img/seo/seo_tech.jpg" alt="">
                <div class="h3 text-center header_shadow">Технический аудит</div>
                <p>
                    Сделаем аудит технической внутренней оптимизации сайта. Прилагается консультация по любым пунктам
                    аудита. Поможем рассчитать примерный бюджет на SEO оптимизацию.
                </p>
                <div class="req-price d-flex justify-content-between">
                    <div><b>1 - 4 дня</b></div>
                    <div><span class="red">14 000</span> ₽</div>
                </div>
            </a>
            <a class="d-block req-item w-25 d-flex flex-column justify-content-around"
               href="{{ route('seo.semantic') }}">
                <img loading="lazy" src="/img/seo/seo_semantic.jpg" alt="">
                <div class="h3 text-center header_shadow">Аудит семантики</div>
                <p>
                    Правильно ли поисковые системы понимают информацию на вашем сайте? Отличают ли важную информацию от
                    дополнительной, от рекламы и от прочего?
                </p>
                <div class="req-price d-flex justify-content-between">
                    <div><b>1 - 4 дня</b></div>
                    <div><span class="red">16 000</span> ₽</div>
                </div>
            </a>
        </div>
    </div>
    <br>
    <div class="h1 text-center container">Заказать аудит сайта</div>
    <div class="lightGray container seo-index-form">
        <x-ui.seoForm/>
    </div>

</x-layouts.main>
