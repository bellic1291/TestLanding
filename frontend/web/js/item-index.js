$('.vr-img-btn').on('click', function() {
  var path = $(this).find('.vr-img').attr('src');
  $('.item-img').attr('src', path);
});

$('.btn-cart').on('click', function(e) {
    $.ajax({
          url: '/cart/add-item',
          type: 'post',
          data: {'id' : $(this).attr('id')},
          success: function (params) {
               $.pjax.reload({container:'#tooltip'});
          }
    });
});