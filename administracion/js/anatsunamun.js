	$(document).ready(function () {
		$("#sidebar").mCustomScrollbar({
			theme: "minimal-dark",
			mouseWheelPixels: 200
		});

		$('#dismiss, .overlay').on('click', function () {
			ocultarPanel()
		});
					$('.sidebar-header').click(function(){
						ocultarPanel();
					});
					$('#btnBrand').click(function(){
						mostrarPanel();
					});
				
				function ocultarPanel(){
					$('#sidebar').removeClass('active');
		$('.overlay').removeClass('active');
					$('#sidebarCollapse').toggleClass('tieneMostrar');
				}
				function mostrarPanel(){
					$('#sidebar').addClass('active');
		$('.overlay').addClass('active');
		$('.collapse.in').toggleClass('in');
		$('a[aria-expanded=true]').attr('aria-expanded', 'false');
					$('#sidebarCollapse').toggleClass('tieneMostrar');
				}

		$('#sidebarCollapse').on('click', function () {
			if($(this).hasClass('tieneMostrar')){
								mostrarPanel();
							}else{
								ocultarPanel();
							}
						
		});
	});

	function mostrarError( titulo, mensaje ){
		$('#toastAdverTitle').text(titulo); $('#toastError').text(mensaje); $('#tostadaError').toast('show');
	}
	function mostrarInfo( titulo, mensaje ){
		$('#toastInfoTitle').text(`¡${titulo}!`); $('#toastInfo').text(mensaje); $('#tostadaInfo').toast('show');
	} 

	function pantallaOver(tipo) {
		if(tipo){$('#overlay').css('display', 'initial');}
		else{ $('#overlay').css('display', 'none'); }
	}