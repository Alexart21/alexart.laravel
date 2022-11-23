'use strict'
// подтверждение удаления
function confirmTrash() {
  return confirm('Отправить в корзину ?');
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
