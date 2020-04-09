import $ from "jquery"

const formID = "#filter_posts"
const button = "#post_submit"

$(formID).on("change", function() {
  $(button).click()
})
