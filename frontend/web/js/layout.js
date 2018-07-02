/*$('.btn-tooltip').on('click', function() {
   location.href = '/cart/view-items';
});*/

$(document).on('click', '.btn-view', function() {
   location.href = '/cart/view-items';
});

$(document).on('click', '.btn-clear', function() {
   $.ajax({
          url: '/cart/clear-items',
          type: 'post',
          success: function (params) {
               $.pjax.reload({container:'#tooltip, #cart-items-grid'});
               //$.pjax.reload({container:''});
          }
    });
});