const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});



$(document).ready(function () {

  // loadContent('dash_data/dash.php');


  $('#user-data').click(function () {
      loadContent('user_data/user_data.php');
  });
  $('#room-data').click(function () {
      loadContent('room_data/room.php');
  });
  $('#dash-data').click(function () {
    loadContent('dash_data/dash_data.php');
});

  function loadContent(page) {
      $.ajax({
          url: page,
          type: 'GET',
          success: function (data) {
              $('#content').html(data);
          },
          error: function () {
              $('#content').html('<p>Failed to load content.</p>');
          }
      });
  }
});

