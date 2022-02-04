let seeMore = document.getElementsByClassName('more');

for (let i = 0; i < seeMore.length; i++) {
  seeMore[i].addEventListener('click', expand);
}

function expand(e) {
    e.target.parentElement.className = 'preview';
    e.target.style.display = "none";
}

document.addEventListener('click', function (event) {
    if (event.target.closest('.preview')) return;
    var element = document.querySelector('.preview');
    if(element)
        element.classList.remove('preview');

    for (let i = 0; i < seeMore.length; i++) {
      seeMore[i].style.display = "inline";
    }
}, false);
