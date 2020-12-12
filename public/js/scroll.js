let scrollpos = window.scrollY
const header = document.querySelectorAll(".change")
const logoNav = document.querySelector('.logo')
const searchButton = document.querySelector('.search')
const screen = document.querySelector(".parallax")
const height = screen.offsetHeight * .7
console.log(height)
for (let i = 0; i < header.length; i++){
    header[i].classList.add("fade-in")
    logoNav.classList.add('hide')
    searchButton.classList.add('fade-in')
}
for (let i = 0;i < header.length; i++){
    let add_class_on_scroll = () => header[i].classList.add("fade-in")
    let remove_class_on_scroll = () => header[i].classList.remove("fade-in")
    let add_class = () =>  logoNav.classList.add('hide')
    let remove_class = () => logoNav.classList.remove('hide')
    let add = () => searchButton.classList.add('fade-in')
    let remove = () => searchButton.classList.remove('fade-in')

    window.addEventListener('scroll', function() {
        scrollpos = window.scrollY

        if (scrollpos >= height) {
            remove_class_on_scroll()
            remove_class()
            remove()
        }
        else {
            add_class_on_scroll()
            add_class()
            add()
        }

        console.log(scrollpos)
    })
}



