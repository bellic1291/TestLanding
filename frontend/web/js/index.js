$(document).on('click', '.div-index-col', function() {
    location.href = '/site/view-item?id=' + $(this).attr('id');
});