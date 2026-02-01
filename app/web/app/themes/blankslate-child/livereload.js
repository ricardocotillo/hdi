(function() {
	// Livereload script para desarrollo
	// Se conecta automáticamente a http://localhost:35729
	
	const LIVERELOAD_HOST = 'localhost';
	const LIVERELOAD_PORT = 35729;
	
	let socket = null;
	let reconnectAttempts = 0;
	const MAX_RECONNECT_ATTEMPTS = 10;
	const RECONNECT_DELAY = 1000;
	
	function connect() {
		try {
			socket = new WebSocket('ws://' + LIVERELOAD_HOST + ':' + LIVERELOAD_PORT + '/livereload');
			
			socket.onopen = function() {
				console.log('[LiveReload] Conectado al servidor de LiveReload');
				reconnectAttempts = 0;
			};
			
			socket.onmessage = function(e) {
				try {
					const message = JSON.parse(e.data);
					
					if (message.command === 'reload') {
						console.log('[LiveReload] Recargando página...');
						window.location.reload();
					} else if (message.command === 'alert') {
						alert(message.message);
					}
				} catch (err) {
					console.error('[LiveReload] Error al procesar mensaje:', err);
				}
			};
			
			socket.onerror = function(error) {
				console.log('[LiveReload] Error de conexión:', error);
				attemptReconnect();
			};
			
			socket.onclose = function() {
				console.log('[LiveReload] Conexión cerrada');
				attemptReconnect();
			};
		} catch (err) {
			console.error('[LiveReload] Error al conectar:', err);
			attemptReconnect();
		}
	}
	
	function attemptReconnect() {
		if (reconnectAttempts < MAX_RECONNECT_ATTEMPTS) {
			reconnectAttempts++;
			console.log('[LiveReload] Intentando reconectar en ' + (RECONNECT_DELAY / 1000) + 's (' + reconnectAttempts + '/' + MAX_RECONNECT_ATTEMPTS + ')');
			
			setTimeout(function() {
				connect();
			}, RECONNECT_DELAY);
		}
	}
	
	// Esperar a que el DOM esté listo
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', function() {
			connect();
		});
	} else {
		connect();
	}
})();
