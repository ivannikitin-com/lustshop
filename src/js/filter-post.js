const formID = document.getElementById('filter_posts')
const button = document.getElementById('post_submit')

if ( formID ) {
  formID.addEventListener("change", () => {
    button.click();
  })
}
