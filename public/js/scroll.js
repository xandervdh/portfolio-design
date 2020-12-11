let scrollpos = window.scrollY
const header = document.querySelectorAll(".change")
const screen = document.querySelector(".parallax").offsetHeight
const height = screen * .7
for (let i = 0; i < header.length; i++){
    header[i].classList.add("fade-in")
}
for (let i = 0;i < header.length; i++){
    let add_class_on_scroll = () => header[i].classList.add("fade-in")
    let remove_class_on_scroll = () => header[i].classList.remove("fade-in")

    window.addEventListener('scroll', function() {
        scrollpos = window.scrollY

        if (scrollpos >= height) { remove_class_on_scroll() }
        else { add_class_on_scroll() }

        console.log(scrollpos)
    })
}



