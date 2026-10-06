const button = document.getElementById("button")
const ul = document.getElementById("ul")

document.getElementById('button').addEventListener('click', function () {
    button.classList.toggle("active");
    ul.classList.toggle("is-active");
});


document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen = document.querySelector('.loading-screen');
    setTimeout(() => {
        loadingScreen.classList.add('hidden');
    }, 2500);
});

const rootElement = document.documentElement;
const toggleButton = document.getElementById('toggle-theme');
toggleButton.addEventListener('click', () => {
    rootElement.classList.toggle('active');
});