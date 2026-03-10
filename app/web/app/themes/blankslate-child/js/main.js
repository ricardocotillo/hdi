document.addEventListener('DOMContentLoaded', function() {
	const headerSticky = document.querySelector('.header-sticky');
	
	if (!headerSticky) return;
	
	const messageTop = document.querySelector('#message-top');
	
	window.addEventListener('scroll', function() {
		const messageTopHeight = messageTop ? messageTop.offsetHeight : 60;
		if (window.scrollY > messageTopHeight) {
			headerSticky.classList.add('sticky');
		} else {
			headerSticky.classList.remove('sticky');
		}
	});

	// Menu mobile toggle
	const menuMobileButton = document.getElementById('menu-mobile-button');
	const menuPrincipal = document.getElementById('menu-principal');
	const menuIcon = menuMobileButton ? menuMobileButton.querySelector('i') : null;

	if (menuMobileButton && menuPrincipal && menuIcon) {
		menuMobileButton.addEventListener('click', function() {
			menuPrincipal.classList.toggle('show');
			menuIcon.classList.toggle('fa-bars');
			menuIcon.classList.toggle('fa-times');
		});
	}

	// Submenu toggle for mobile
	const menuItems = document.querySelectorAll('#menu-principal > li');
	menuItems.forEach(item => {
		const submenu = item.querySelector('ul');
		if (submenu) {
			const link = item.querySelector('a');
			link.addEventListener('click', function(e) {
				// Solo prevenir default si estamos en mobile
				if (window.innerWidth < 768) {
					const isActive = item.classList.contains('active');
					const hasOpenedOnce = item.dataset.openedOnce === 'true';
					if (!isActive || !hasOpenedOnce) {
						e.preventDefault();
						item.classList.add('active');
						item.dataset.openedOnce = 'true';
					}
				}
			});
		}
	});

	// Smooth scroll for cotizar buttons
	const cotizarLinks = document.querySelectorAll('a.btn-cotizar[href^="#"]');
	cotizarLinks.forEach(link => {
		link.addEventListener('click', function(e) {
			const targetId = link.getAttribute('href');
			const target = targetId ? document.querySelector(targetId) : null;
			if (!target) return;

			e.preventDefault();
			target.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});
	});

	// Search Productos
	const searchInput = document.getElementById('search-productos-input');
	const searchBtn = document.getElementById('search-productos-btn');
	const searchResults = document.getElementById('search-productos-results');
	let searchTimeout;

	if (searchInput && searchResults) {
		searchInput.addEventListener('input', function() {
			const query = this.value.trim();
			
			// Clear previous timeout
			clearTimeout(searchTimeout);
			
			// Clear results if search is empty
			if (query.length === 0) {
				searchResults.classList.add('hidden');
				return;
			}
			
			// Debounce search - wait 300ms after user stops typing
			searchTimeout = setTimeout(() => {
				if (query.length >= 2) {
					performSearch(query);
				}
			}, 300);
		});

		// Close results when clicking outside
		document.addEventListener('click', function(e) {
			if (!e.target.closest('.search-productos-container')) {
				searchResults.classList.add('hidden');
			}
		});

		// Prevent closing results when clicking inside them
		searchResults.addEventListener('click', function(e) {
			if (e.target.tagName === 'A') {
				// Allow link to work and close results
				setTimeout(() => {
					searchResults.classList.add('hidden');
					searchInput.value = '';
				}, 100);
			}
		});
	}

	function performSearch(query) {
		if (!searchProductosData) return;

		// Show results container with loader
		searchResults.classList.remove('hidden');
		
		// Clear previous results and show loader
		searchResults.innerHTML = '';
		const loaderItem = document.createElement('li');
		loaderItem.id = 'search-productos-loader';
		loaderItem.className = 'search-productos-loader show';
		searchResults.appendChild(loaderItem);

		fetch(searchProductosData.ajaxUrl, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: 'action=search_productos&search=' + encodeURIComponent(query) + '&nonce=' + searchProductosData.nonce
		})
		.then(response => response.json())
		.then(data => {
			if (data.success) {
				displaySearchResults(data.data || {});
			} else {
				searchResults.innerHTML = '<li class="no-results">No se encontraron productos</li>';
				searchResults.classList.remove('hidden');
			}
		})
		.catch(error => {
			console.error('Error in search:', error);
			searchResults.innerHTML = '<li class="no-results">Error en la búsqueda</li>';
			searchResults.classList.remove('hidden');
		});
	}

	function displaySearchResults(payload) {
		const results = Array.isArray(payload.items) ? payload.items : [];
		const totalResults = Number.isInteger(payload.total) ? payload.total : results.length;
		const searchUrl = payload.search_url || '';

		searchResults.innerHTML = '';

		// Create sticky header with count
		const countItem = document.createElement('li');
		countItem.className = 'search-results-count';
		countItem.textContent = `${totalResults} resultado${totalResults === 1 ? '' : 's'}`;
		searchResults.appendChild(countItem);

		if (results.length === 0) {
			const noResultsItem = document.createElement('li');
			noResultsItem.className = 'no-results';
			noResultsItem.textContent = 'No se encontraron productos';
			searchResults.appendChild(noResultsItem);
			searchResults.classList.remove('hidden');
			return;
		}
		
		// Create items container
		const itemsContainer = document.createElement('div');
		itemsContainer.className = 'search-results-item-list';

		results.forEach(product => {
			const li = document.createElement('li');
			li.className = 'search-result-item';
			
			let imageHtml = '';
			if (product.image) {
				imageHtml = `<img src="${product.image}" alt="${product.title}" class="result-image">`;
			}
			
			li.innerHTML = `
				<a href="${product.url}" class="result-link">
					${imageHtml}
					<span class="result-title">${product.title}</span>
				</a>
			`;
			
			itemsContainer.appendChild(li);
		});

		searchResults.appendChild(itemsContainer);

		// Create sticky footer with "show all" link
		if (searchUrl) {
			const allResultsItem = document.createElement('li');
			allResultsItem.className = 'search-results-all';
			allResultsItem.innerHTML = `<a href="${searchUrl}" class="search-results-all-link">Mostrar todos los resultados</a>`;
			searchResults.appendChild(allResultsItem);
		}
		
		searchResults.classList.remove('hidden');
	}
});

