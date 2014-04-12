/**
 * Highligh an entry in the navigation bar
 * @param entry Class name of the entry to highlight
 */
function menu_active(entry) {
  $('nav li.entree_'+entry).addClass('active');
}

/**
 * Give the focus to the comment block using an anchor
 */
function comment_focus() {
  location.href = '#comments';
}

/**
 * Add a comment for an article
 * @param id Id of the article
 */
function comment_add() {
  $('#comments .form').fadeIn(2000);
  $('#comments .boutons').remove();
  $('#comments .form input[type="text"]:first').focus();
  comment_focus();
}
