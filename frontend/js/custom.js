$("#stars-default").rating('create',{coloron:'yellow',onClick:function(){$('#start_rating').val(this.attr('data-rating')); }});
function showForm() {
	$('.form').show();
}

$('#check-cus').on('change', function () {
	$('.check-cus').toggle();
	console.log('ok');
});