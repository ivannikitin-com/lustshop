document.addEventListener("DOMContentLoaded", () => {
    const ACTIVE_CLASSS = "flex-active";

    const imageThumbnails = document.querySelectorAll(".flex-control-nav li img")
    const wrapperThumbnails = document.querySelectorAll('.flex-control-nav li')

    const removeActiveClassWrapper = () => {
        wrapperThumbnails.forEach(item => {
            item.classList.remove(ACTIVE_CLASSS);
        })
    }

    const changeClassName = (image) => () => {
        setTimeout(() => {
            if (image.classList.contains(ACTIVE_CLASSS)) {
                removeActiveClassWrapper();
                const parentElement = image.parentElement;
                parentElement.classList.add(ACTIVE_CLASSS)
            }
        }, 0)
    }

    if ( imageThumbnails.length > 0 ) {
        changeClassName(imageThumbnails[0])()
        imageThumbnails.forEach(image => image.addEventListener('click', changeClassName(image)) )
    }

})