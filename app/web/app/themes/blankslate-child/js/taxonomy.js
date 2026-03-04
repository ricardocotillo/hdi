/**
 * Taxonomy Page - Load More Products via AJAX
 */

document.addEventListener('DOMContentLoaded', function() {
    // Set up event listeners for filters
    setupFilterListeners();
    
    // Set up load more button
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            loadMoreProducts();
        });
    }
});

function setupFilterListeners() {
    const filters = document.querySelectorAll('.filter-select, .filter-input');
    
    filters.forEach(filter => {
        filter.addEventListener('change', filterProducts);
    });
}

function filterProducts() {
    // Reset to page 1 and load filtered products
    loadFilteredProducts(1);
}

function loadFilteredProducts(paged = 1) {
    const grid = document.getElementById('productos-grid');
    const loadMoreBtn = document.getElementById('load-more-btn');
    
    // Get filter values
    const fabricantes = document.getElementById('filter-fabricantes')?.value || '';
    const marcas = document.getElementById('filter-marcas')?.value || '';
    const sku = document.getElementById('filter-oem')?.value || '';
    const codFabricante = document.getElementById('filter-fabricante-code')?.value || '';
    
    // Get current taxonomy info
    const currentTermId = window.taxonomyData?.currentTermId || '';
    const currentTaxonomy = window.taxonomyData?.currentTaxonomy || '';
    const searchQuery = window.taxonomyData?.searchQuery || '';
    
    const formData = new FormData();
    formData.append('action', 'filter_productos');
    formData.append('paged', paged);
    formData.append('fabricantes', fabricantes);
    formData.append('marcas', marcas);
    formData.append('sku', sku);
    formData.append('cod_fabricante', codFabricante);
    formData.append('current_term_id', currentTermId);
    formData.append('current_taxonomy', currentTaxonomy);
    formData.append('search_query', searchQuery);
    formData.append('nonce', window.taxonomyData?.nonce || '');
    
    // Clear grid and show loading state if first page
    if (paged === 1) {
        grid.innerHTML = '<div class="loading-message"><div class="loading-spinner"></div><span>Cargando productos...</span></div>';
    }
    
    fetch(window.taxonomyData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = data.data.html;
            const products = tempDiv.querySelectorAll('.producto-item');
            
            if (paged === 1) {
                grid.innerHTML = '';
            }
            
            if (products.length === 0 && paged === 1) {
                grid.innerHTML = '<p class="no-productos">No hay productos que cumplan los filtros.</p>';
                if (loadMoreBtn) {
                    loadMoreBtn.parentElement.style.display = 'none';
                }
            } else {
                products.forEach((product, index) => {
                    // Agregar pequeño delay escalonado para animación suave
                    setTimeout(() => {
                        product.classList.add('fade-in');
                        grid.appendChild(product);
                    }, index * 50);
                });
                
                // Update or hide load more button
                if (loadMoreBtn) {
                    if (data.data.has_more) {
                        loadMoreBtn.setAttribute('data-paged', paged + 1);
                        loadMoreBtn.parentElement.style.display = 'flex';
                        loadMoreBtn.classList.remove('loading');
                    } else {
                        loadMoreBtn.parentElement.style.display = 'none';
                    }
                }
            }
        } else {
            console.error('Error loading products:', data.data);
            grid.innerHTML = '<p class="error-message">Error al cargar productos.</p>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        grid.innerHTML = '<p class="error-message">Error al cargar productos.</p>';
    });
}

function loadMoreProducts() {
    const btn = document.getElementById('load-more-btn');
    
    if (!btn || btn.classList.contains('loading')) {
        return;
    }
    
    btn.classList.add('loading');
    const paged = parseInt(btn.getAttribute('data-paged'));
    
    const grid = document.getElementById('productos-grid');
    const fabricantes = document.getElementById('filter-fabricantes')?.value || '';
    const marcas = document.getElementById('filter-marcas')?.value || '';
    const sku = document.getElementById('filter-oem')?.value || '';
    const codFabricante = document.getElementById('filter-fabricante-code')?.value || '';
    
    // Get current taxonomy info
    const currentTermId = window.taxonomyData?.currentTermId || '';
    const currentTaxonomy = window.taxonomyData?.currentTaxonomy || '';
    const searchQuery = window.taxonomyData?.searchQuery || '';
    
    const formData = new FormData();
    formData.append('action', 'filter_productos');
    formData.append('paged', paged);
    formData.append('fabricantes', fabricantes);
    formData.append('marcas', marcas);
    formData.append('sku', sku);
    formData.append('cod_fabricante', codFabricante);
    formData.append('current_term_id', currentTermId);
    formData.append('current_taxonomy', currentTaxonomy);
    formData.append('search_query', searchQuery);
    formData.append('nonce', window.taxonomyData?.nonce || '');
    
    fetch(window.taxonomyData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = data.data.html;
            const newProducts = tempDiv.querySelectorAll('.producto-item');
            
            newProducts.forEach((product, index) => {
                // Agregar pequeño delay escalonado para animación suave
                setTimeout(() => {
                    product.classList.add('fade-in');
                    grid.appendChild(product);
                }, index * 50);
            });
            
            // Update button state
            if (data.data.has_more) {
                btn.setAttribute('data-paged', paged + 1);
                btn.classList.remove('loading');
            } else {
                btn.parentElement.style.display = 'none';
            }
        } else {
            console.error('Error loading products:', data.data);
            btn.classList.remove('loading');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        btn.classList.remove('loading');
    });
}
