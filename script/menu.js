$('#menu-user-info').click(function(){
    $('.ui.sidebar').sidebar('toggle');
    setTimeout(function(){
      $('.ui.modal').modal('show');
    },450);
});
$('#menu-button').click(function() {
  $('.ui.sidebar').sidebar('toggle');
});
