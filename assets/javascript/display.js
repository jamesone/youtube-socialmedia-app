$(document).ready(function() {

	// //On hover show the options to share there video
	// 	$('.btn-share-hover').click(function() {
	// 		$('.share-wrap').('slow/400/fast', function() {
				
	// 		}).on('blur', function(){
	// 			// alert('hi');
	// 			$(this).slideUp();
	// 	}).slideDown();

});

$('body').on('click', '.btn-share-hover', function(e){
	e.preventDefault();
	$('.share-wrap').on('blur', function(){
		$('.share-wrap').fadeOut();
	}).fadeIn();

	
	// $(this).next('textarea').keyup(function() {

	// 	var textTitle = $(this).val();
	// 	$(this).prev('.hidden-text').text(textTitle);

	// }).on('blur', function(){
	// 	// alert('hi');
	// 	$(this).slideUp();

	// }).slideDown();
});
$('body').on('click', '.cancel-share', function(e){
		$('.share-wrap').fadeOut();

		});