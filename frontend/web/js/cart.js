$(document).on('click', 'span.span-grid', function() {
    

    
    $.ajax({
          url: $(this).attr('action'),
          type: 'post',
          data: {'id' : $(this).attr('vr-id')},
          success: function () {
            $.pjax.reload({container:'#cart-items-grid'}); 
          }
    });   
});

