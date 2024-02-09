function nightMode() {
    const body = document.body
    const wasNightMode = localStorage.getItem('nightMode') === 'true'

    localStorage.setItem('nightMode', !wasNightMode)
    body.classList.toggle('body-night-mode', !wasNightMode)
}

document.querySelector('.day-and-night').addEventListener('click', nightMode)
function onload(){
    document.body.classList.toggle('body-night-mode', localStorage.getItem('nightMode') === 'true')
}

document.addEventListener('DOMContentLoaded', onload)
