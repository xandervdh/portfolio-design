// Create cross browser requestAnimationFrame method:
window.requestAnimationFrame = window.requestAnimationFrame
    || window.mozRequestAnimationFrame
    || window.webkitRequestAnimationFrame
    || window.msRequestAnimationFrame
    || function (f) {
        setTimeout(f, 1000 / 60)
    }

var layer0 = document.getElementById('layer0')
var layer1 = document.getElementById('layer1')
var layer2 = document.getElementById('layer2')
var layer3 = document.getElementById('layer3')
var layer4 = document.getElementById('layer4')
var layer5 = document.getElementById('layer5')
var layer6 = document.getElementById('layer6')
var parallax_cover = document.getElementById('parallax_cover')
var logo = document.getElementById('logo')

function parallaxbubbles() {
    var scrolltop = window.pageYOffset // get number of pixels document has scrolled vertically
    layer0.style.top = -scrolltop * .1 + 'px' // move bubble1 at 20% of scroll rate
    layer1.style.top = -scrolltop * .2 + 'px' // move bubble2 at 50% of scroll rate
    layer2.style.top = -scrolltop * .3 + 'px' // move bubble2 at 50% of scroll rate
    layer3.style.top = -scrolltop * .4 + 'px' // move bubble2 at 50% of scroll rate
    layer4.style.top = -scrolltop * .6 + 'px' // move bubble2 at 50% of scroll rate
    logo.style.top= -scrolltop * -.05 + 'px'
    layer5.style.top = -scrolltop * .8 + 'px' // move bubble2 at 50% of scroll rate
    layer6.style.top = -scrolltop + 'px' // move bubble2 at 50% of scroll rate
    parallax_cover.style.top = -scrolltop + 'px' // move bubble2 at 50% of scroll rate
}

window.addEventListener('scroll', function () { // on page scroll
    requestAnimationFrame(parallaxbubbles)
}, false)