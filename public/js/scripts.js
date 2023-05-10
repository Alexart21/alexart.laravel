'use strict'

const screen_w = document.body.clientWidth;
const screen_h = document.body.clientHeight;
/*let scrollHeight = Math.max( // полная высота с прокручиваемой частью
    document.body.scrollHeight, document.documentElement.scrollHeight,
    document.body.offsetHeight, document.documentElement.offsetHeight,
    document.body.clientHeight, document.documentElement.clientHeight
);*/
window.onresize = function () {
    window.screen_w = document.body.clientWidth;
    window.screen_h = document.body.clientHeight;
};

/*Мобильное левое меню*/
function mobLeft() {
    const menuBtn = document.querySelector('.mob-menu-button'); //кнопка
    const menu = document.querySelector('.mob-menu-list'); // выезжающий блок
    menuBtn.addEventListener('click', function () {
        menu.classList.toggle('menu-animate');
        menuBtn.classList.toggle('btn-pos');
    });
    // закритие мобильного меню при клики вне его
    const Btn = $('.mob-menu-button'),
        $menu = $('.mob-menu-list');
    $(document).click(function (e) {
        if (!Btn.is(e.target) && !$menu.is(e.target) && $menu.has(e.target).length === 0) {
            console.log();
            if (menu.classList.contains('menu-animate')) {
                // menu.classList.remove('menu-animate');
                menu.classList.toggle('menu-animate');
                menuBtn.classList.toggle('btn-pos');
            }
        }
        ;
    });
    ////////
    /*const c = mobLink.length;
    // чтоб меню закрывалось при клике на любую ссылку
    for (let i = 0; i < c; i++) {
        mobLink[i].addEventListener('click', function () {
            menu.classList.toggle('menu-animate');
            menuBtn.classList.toggle('btn-pos');
            menuCol.classList.toggle('open');
        });
    }*/
}

/* кнопка наверх */
const scr = document.getElementById('scroller');
window.addEventListener('scroll', () => {
    let top = window.pageYOffset; // сколько проскролено
    if (top > 500) {
        scr.style.display = 'block';
    } else {
        scr.style.display = 'none';
    }
});
scr.addEventListener('click', () => {
    // $('body,html').animate({scrollTop: 0}, 300);
    window.scrollTo(0, 0);
});

/* фиксация верхнего меню */
function menu_fix() {
    const h_hght = 500; // высота шапки
    const h_mrg = 0; // отступ когда шапка уже не видна
    $(function () {
        let top = $(this).scrollTop(); // сколько проскролено
        const menu = $('#menu_outer'), // блок меню
            resp = $('nav.resp'),
            ul = $('nav.resp ul'),
            link = $('.resp a'),
            leftMenu = $('#l_menu');
        if ((top + h_mrg) > h_hght && screen_w >= 930) { // включается "скролл-меню"
            menu.css({
                'top': h_mrg,
                'position': 'fixed',
                'background': 'transparent',
                'z-index': '10'
            });
            resp.css({
                'border': 'none',
                'marginTop': '-20px',
            });
            ul.addClass('scrolled');
            link.css({
                'color': '#313A3D',
                'borderRight': '1px dotted #e61b05'
            });
            /* leftMenu.css({
                 'position': 'fixed',
                 'top': 0
             });*/
        } else {
            menu.css({
                'top': 0,
                'position': 'relative',
                'background': '',
                'z-index': ''
            });
            resp.css({
                'background-color': '',
                'border': '',
                'marginTop': ''
            });
            ul.removeClass('scrolled');
            link.css({
                'color': '',
                'borderRight': ''
            });
            /*leftMenu.css({
                'position': ''
            });*/
        }
    });
}

//
$(window).scroll(function () {
    menu_fix(); // фиксация верхнего меню
});
// доставание cookie
function readCookie(name) {
    const matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
// звук
function beep(){
    let snd = new Audio("data:audio/x-wav;base64, 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");
    let promise = snd.play();
    promise.then(_ => {
        console.log('play!');
    }).catch(err => {
        console.log(err.message);
    });
}
/////////////
/* Далее в обертке window.onload */
window.onload = () => {
    // console.log('here');
    $("#tel").mask('+7 (999)-999-99-99');
    $("#call-tel").mask("+7(999) 999-99-99");
    // модалка с оповещением что выслано письмо
    /*const mailInfo = document.querySelector('#success-modal');
    if (mailInfo) {
        $('#success-modal').modal();
        setTimeout(function() {
            $('#success-modal').modal('hide');
        }, 4000);
    }*/
    // анимация в шапке
    const shtorka = document.querySelector('.shtorka');
    shtorka.classList.add('shtorka-animate');

    mobLeft(); // мобильное меню
    //
    (function ($) {
        new WOW().init();
    })(jQuery);
};
/* конец обертка onload */
function showOverlay() {
    $('#container').prepend('<div id="overlay"></div>');
    $('#overlay').show();
}
function hideOverlay() {
    $('#overlay').remove();
    $('#container_loading').hide();
}
// окраска активной AJAX ссылки верхнего меню
function linkColor() {
    let links = document.querySelectorAll('.resp li a'); // все ссылки верхнего меню
    let currentLink = window.location.pathname; // нажатая ссылка
    for (var i = 0; i < links.length; i++) {
        let y = links[i].pathname;
        if (y == currentLink && currentLink != '/') {
            // console.log(links[i]);
            links[i].classList.add('header_shadow');
            links[i].classList.add('cursor-default');
            links[i].onclick = () => {
                return false;
            }
        } else {
            links[i].classList.remove('header_shadow');
            links[i].classList.remove('cursor-default');
            links[i].onclick = () => {
                return true;
            }
        }
    }
}

// Параграф "этапы создания сайта" на главной странице окраска активной ссылки
let etap = [ // массив с описаниями
    "Уяснение задач заказчика, определение целевой аудитории сайта, написание брифа(в народном фольклоре ТЗ).Прототипирование или составление эскиза где определяются расположения элементов страниц.",
    "Определение концепции дизайна.Цветовое и графическое решение будущего сайта, выбор шрифтов и др.",
    "Страницы сайта должны корректно отображаться во всех браузерах.Как правило хорошего тона нынче можно говорить об <a class=\"portf-call\" href=\"/sozdanie#response\"><b> адаптивной верстке</b></a> т.е. сайт должен быть хорошо читаем без потери функционала и на смартфонах и на планшетах и на настольных пк, и даже на тех устройствах, которые появятся в будущем.",
    "Программирование идет параллельно с версткой.Постановка сайта \"на движок\" выбранный заказчиком(или разработанный нами).Проектирование и наполнение контентом базы данных(если требуется).Можем предложить собственную CMS которая в отличии от \"универсальных\" будет заточена под Ваш конкретный сайт и очень проста в использовании.",
    "Наполнение содержимым.Если сайт будет продвигаться в поисковиках, пишутся грамотные SEO тексты под поисковые запросы по ключевым словам.",
    "Здесь идет полная проверка работоспособности сайта.Так же тестируется стойкость к XSS атакам и SQL инъекциям.",
    "Собственно выкладка на выбранный хостинг.Этот этап может быть сделан уже в процессе верстки.Например когда коммерческий сайт планируеться к SEO продвижению.Ведь SEO&mdash; процесс нескорый и тут время-деньги."
];
const etli = document.querySelector('#etap ul');
if (etli) {
    etli.onclick = (e) => {
        let li = e.target;
        if (!li) return;
        $('#etap ul li').removeClass('etap_active'); // убираем окраску если есть
        li.classList.add('etap_active'); // подсветить новый li
        let n = li.dataset.n;
        document.getElementById('etap_target').innerHTML = etap[n]; // впендюриваем описание куда надо

    };
}
/* Левое меню окраска активной ссылки */
let leftMenu = document.querySelector('#l_menu');
if (leftMenu) {
    leftMenu.onclick = (e) => {
        let a = e.target;
        if (a.nodeName != 'A') return;
        let li = a.parentElement;
        if (li.nodeName != 'LI') return;
        /*if(li.classList.contains('link-active')){ // ссылка уже активна ничего не делаем
            a.onclick = () => {
                return false;
            }
        }*/
        $('#l_menu li').removeClass('link-active'); // убираем окраску если есть
        li.classList.add('link-active'); // подсветить новый li
    };
}
/******/
const callBtn = document.getElementById('call');
callBtn.onclick = () => {
    $('#callback').modal('show');
    $('.modal-content').velocity('transition.bounceIn');
}
//
function startLoader(){
    document.getElementById('container_loading').style.display = 'block';
}
function stopLoader(){
    document.getElementById('container_loading').style.display = 'none';
}
// очистка сообщений об ошибках
function clearErrMsgs(errClass){
    let msgs = document.getElementsByClassName(errClass);
    let i = 0;
    while (msgs[i]) {
        msgs[i].innerHTML = '';
        i++;
    }
}

function showSuccess(msgBlock, form){
    msgBlock.innerHTML = '<span style="color: green">Спасибо, сообщение отправлено!</span>';
    $('#successModal').modal('show');
    $('#successModal .modal-content').velocity('transition.bounceIn');
    form.reset();
    setTimeout(() => {
        msgBlock.innerHTML = '';
        $('#successModal').modal('hide');
    }, 4000)
}

function showServerError(msgBlock, status, statusText, rateLimit) {
    let errMsg = status == 429 ? 'Лимит исчерпан. Не более ' + rateLimit + ' запросов в минуту' : `Ошибка ${status} ${statusText}`;
    msgBlock.innerHTML = '<span style="color: red">' + errMsg + '</span>';
    $('#successModal').modal('show');
    $('#successModal .modal-content').velocity('transition.bounceIn');
    setTimeout(() => {
        msg.innerHTML = '';
        $('#successModal').modal('hide');
    }, 8000);
}

function showDbError(msgBlock){
    msgBlock.innerHTML = '<span style="color: red">Ошибка базы данных!</span>';
    $('#successModal').modal('show');
    $('#successModal .modal-content').velocity('transition.bounceIn');
    setTimeout(() => {
        msgBlock.innerHTML = '';
        $('#successModal').modal('hide');
    }, 8000);
}
// подтверждение выхода
let logoutDialog = document.getElementById('logoutDialog');
if(logoutDialog){
    let logoutBtn = document.getElementById('logout-btn');
    let confirmBtn = logoutDialog.querySelector('#confirmBtn');
    let logoutForm = document.getElementById('logout-form');
    if (typeof logoutDialog.showModal !== 'function') {
        logoutDialog.hidden = true;
    }
    logoutBtn.addEventListener('click', () => {
        if (typeof logoutDialog.showModal === "function") {
            logoutDialog.showModal();
        } else {
            console.log('Sorry, the <dialog> API is not supported by this browser');
            // logoutForm.submit();
            return;
        }
        //
        logoutForm.onsubmit = (e) => {
            e.preventDefault();
        }
        confirmBtn.addEventListener('click', () => {
            console.log('exit');
            logoutForm.submit();
        });
        logoutDialog.addEventListener('close', () => {
            console.log('отмена');
            logoutForm.onsubmit = (e) => {
                e.preventDefault = true;
            }
        });
    });
}
// запрос для DAdAta сервиса
// передаем name {name: 'name'}
async function fetchDaData(name, url,  csrfToken, datalist){
    let formData = new FormData();
    formData.append('name', name);
    formData.append('_token', csrfToken);
    let response = await fetch(url, {
        method: 'POST',
        body: formData
    });
    if (!response.ok) {
        console.log(response);
    } else {// статус 200
        let result = await response.json();
        if (result.success) { // успешно
            let names = result.names;
            // console.log(address)
            if (names && result.count) {
                console.log(names)
                datalist.innerHTML = '';
                names.map((item) => {
                    let option = document.createElement('option');
                    option.value = item;
                    datalist.prepend(option);
                })
            }
        } else { // фиг знает че за ошибка
            console.log(response);
        }
    }
}
