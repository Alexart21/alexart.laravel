'use strict'
// Окно чата/мессенджеров
window.addEventListener('load', () => {
    let msgBlock = document.getElementById('msg-block');
    const msgContent = document.getElementById('msg-content');
    const msgImg = document.querySelector('.msg-img');
    const msgClosed = document.querySelector('.msg-closed');

    const al = document.getElementById('container').clientWidth;
    msgBlock.style.right = (screen_w - al) / 2 + 'px'; //позиционируем в правый край родителя

    const showMsg = () => { // показ окна чата с анимацией
        // $('#msg-block').velocity('transition.bounceIn');
        msgBlock.style.display = 'block';
    };
    // Всплывающая подсказка над чатом
    const showTooltip = () => {
        if (msgBlock.hasAttribute('data-closed') && !readCookie('msg')) { // только при свернутом окошке и нету куки (не заходил больше часа или сколько там)
            let promise = document.querySelector('audio').play();
            if (promise !== undefined) {
                promise.then(_ => {
                    console.log('play!');
                }).catch(err => {
                    console.log(err.message);
                });
            }
            $('[data-toggle="tooltip"]').tooltip('show');
            document.cookie = "msg=1;max-age=3600;path=/"; // куку на час(в течении этого времени больше не будет всплывающих подсказок)
        }
    };
    //
    const rmTooltip = () => { // убиваем tooltip
        let tltp = document.querySelector('.tooltip');
        if (tltp) {
            tltp.remove();
        }
    };
    //
    const rmMsgAnim = () => { // нефиг всю дорогу мерцать
        const bar = document.querySelector('.msg-closed').classList;
        bar.remove('button-anim');
    };
    // несколько задержек
    setTimeout(showMsg, 3000); //  показываем блок с чатом
    setTimeout(showTooltip, 6000); // показываем всплывающую подсказку/приглашение
    setTimeout(rmTooltip, 14000); // скрываем подсказку
    setTimeout(rmMsgAnim, 30000); // выключаем анимацию
    msgBlock.addEventListener('mouseover', () => { // по наведению мыши тож прибиваем
        rmTooltip();
    });
    msgContent.addEventListener('click', () => { // разворачиваем окно чата
        if (msgBlock.hasAttribute('data-closed')) { // свернуто
            // msgBlock.style.height = '370px';
            msgBlock.classList.add('msg-opened');
            msgBlock.style.background = 'url(/img/wats-bg.gif)';
            msgBlock.style.boxShadow = '0 0 30px #999';
            msgImg.style.left = 'calc(50% - 30px)';
            msgClosed.style.display = 'none';
            msgBlock.removeAttribute('data-closed');
            showMsg();
        }
    });
    //
    const msgClose = document.querySelector('#msg-block button');
    msgClose.addEventListener('click', () => { // сворачиваем окно чата
        if (!msgBlock.hasAttribute('data-closed')) { // окно не свернуто
            msgImg.style.left = '240px';
            // msgBlock.style.height = '';
            msgBlock.classList.remove('msg-opened');
            msgBlock.style.background = '';
            msgBlock.style.boxShadow = '';
            msgClosed.style.display = '';
            msgBlock.setAttribute('data-closed', '');
        }
    });
});
