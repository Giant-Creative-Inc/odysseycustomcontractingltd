(function ($) {

	new SimpleLightbox('.sl-gallery a');

	// SCROLL TO TOP
	$("a[href='#0']").click(function () {
		$("html, body").animate({scrollTop: 0}, "slow");
		return false;
	});

	$(window).scroll(function() {
		const topBar = $('#wrapper-navbar');
		const activeClass = 'sticky-on';
		let scrollTop=$(this).scrollTop();

		if(scrollTop>1){
			topBar.addClass(activeClass);
		} else{
			topBar.removeClass(activeClass);
		}
	});

	var triggerTabList = [].slice.call(document.querySelectorAll('#valPropTabs button'))
	triggerTabList.forEach(function (triggerEl) {
		var tabTrigger = new bootstrap.Tab(triggerEl)

		triggerEl.addEventListener('click', function (event) {
			event.preventDefault()
			tabTrigger.show()
		})
	})

})(jQuery);