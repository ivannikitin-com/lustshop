import $ from "jquery"
import "slick-carousel"

$(".slider-products__carousel, .related__carousel, .recently__carousel").slick({
  arrows: true,
  dots: false,
  slidesToShow: 4,
  prevArrow:
    '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" transform="rotate(180)" width="7" height="12"><path fill="currentColor" fill-rule="evenodd" d="M6.992 5.999a.992.992 0 0 1-.292.706l-4.988 5a.999.999 0 1 1-1.415-1.412L4.58 5.999.297 1.705A1 1 0 1 1 1.712.293l4.988 5c.195.194.292.45.292.706z"/></svg></button>',
  nextArrow:
    '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="12"><path fill="currentColor" fill-rule="evenodd" d="M6.992 5.999a.992.992 0 0 1-.292.706l-4.988 5a.999.999 0 1 1-1.415-1.412L4.58 5.999.297 1.705A1 1 0 1 1 1.712.293l4.988 5c.195.194.292.45.292.706z"/></svg></button>',
  responsive: [
    {
      breakpoint: 470,
      settings: {
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
      },
    },
  ],
})
