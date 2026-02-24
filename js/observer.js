//Observers
let options = {
    threshold: 1
}

const opacityObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if(entry.isIntersecting) {
            entry.target.style.opacity = "1";

        }
    });
}, options);

let titleOptions = {
    threshold: 0.5
}

const titleObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if(entry.isIntersecting) {
            entry.target.classList.add('animating');

        }
    });
}, titleOptions);

//Binding observers

fadeInElements = document.getElementsByClassName('fade-in');
titleElements = document.getElementsByClassName('left-animation')

for(let i = 0; i < fadeInElements.length; i++){
    opacityObserver.observe(fadeInElements[i]);
}
for(let i = 0; i < titleElements.length; i++){
    titleObserver.observe(titleElements[i]);
}

// MMenu removed - now using standalone mobile menu component


