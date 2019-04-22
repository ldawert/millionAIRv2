function toggleMenu() {
  //document.getElementById('title_menu_button').innerHTML = 'YOU CLICKED ME!';
  let menu = document.getElementById('title_categories');
  let menuButton = document.getElementsByClassName('button_menu');
  menuButton[0].classList.toggle('button_menu_active');
  menu.classList.toggle('hide');
}
