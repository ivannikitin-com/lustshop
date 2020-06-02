const MIN_WIDTH = 768

const openContent = element => () => {
  element.parentElement.classList.toggle("footer__column--open")
}

const getToggleElements = () => {
  if (window.innerWidth < 768) {
    const footerAccordion = document.querySelectorAll(".footer__column--collapse")

    if (footerAccordion.length) {
      footerAccordion.forEach(item => {
        item.firstElementChild.addEventListener("click", openContent(item.firstElementChild))
      })
    }
  }
}

document.addEventListener("DOMContentLoaded", getToggleElements)
document.addEventListener("resize", getToggleElements)
