<?php
/**
 * Keep Nectar reveal-button data-text synced with CallRail numbers.
 */
function giant_sync_nectar_phone_data_text() {
	?>
	<script id="sync-nectar-phone-data-text">
	(function () {
		'use strict';

		const selector = '.nectar-text-reveal-button__text';

		function syncDataText(element) {
			const visibleText = element.textContent.trim();

			if (
				visibleText &&
				element.getAttribute('data-text') !== visibleText
			) {
				element.setAttribute('data-text', visibleText);
			}
		}

		function syncAll() {
			document.querySelectorAll(selector).forEach(syncDataText);
		}

		function initPhoneNumberSync() {
			syncAll();

			const observer = new MutationObserver(function (mutations) {
				mutations.forEach(function (mutation) {
					const element =
						mutation.target.nodeType === Node.TEXT_NODE
							? mutation.target.parentElement
							: mutation.target;

					if (!element) {
						return;
					}

					if (element.matches && element.matches(selector)) {
						syncDataText(element);
					}

					if (element.querySelectorAll) {
						element
							.querySelectorAll(selector)
							.forEach(syncDataText);
					}
				});
			});

			observer.observe(document.body, {
				childList: true,
				subtree: true,
				characterData: true
			});

			['click', 'touchstart', 'keydown', 'scroll'].forEach(function (eventName) {
				window.addEventListener(eventName, syncAll, {
					once: true,
					passive: true
				});
			});
		}

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', initPhoneNumberSync);
		} else {
			initPhoneNumberSync();
		}
	})();
	</script>
	<?php
}
add_action('wp_footer', 'giant_sync_nectar_phone_data_text', 99);