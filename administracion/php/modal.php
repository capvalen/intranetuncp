<?php
$nomArchivo = basename($_SERVER['PHP_SELF']); 
$noVerEn = ['matricula.php'];
if( !in_array($nomArchivo, $noVerEn) ): ?>


  <div class="toast ml-auto mr-3 mt-3" role="alert" id="tostadaError" data-delay="700" data-autohide="false">
      <div class="toast-header">
      <strong class="mr-auto text-danger" ><i class="icofont-warning-alt"></i> <span id="toastAdverTitle"></span></strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body" id="toastError">
      </div>
  </div>
  
  <div class="toast ml-auto mr-3 mt-3" role="alert" id="tostadaInfo" data-delay="700" data-autohide="false">
      <div class="toast-header">
        <strong class="mr-auto text-primary" ><i class="icofont-warning-alt"></i> <span id="toastInfoTitle"></span></strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body" id="toastInfo">
      </div>
  </div>


<?php endif; ?>

<!-- Modal para decir que todo guardo bien  -->
<div class="modal fade" id="modalGuardadoCorrecto" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Datos guardados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="images/path4585.png?ver=1.1" class="img-fluid" alt=""><br>
		  	<div class="d-flex justify-content-center">
          <h5 class="text-center text-primary d-block" id="h1Bien"></h5>
        </div>
        <div class="row d-flex justify-content-center">
          <button class="btn btn-outline-primary" data-dismiss="modal" ><i class="icofont-check-alt"></i> Bien</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal para decir que todo guardo bien  -->
<div class="modal fade" id="modalAdvertencia" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aviso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="images/penuse.png?ver=1.1" class="img-fluid" alt=""><br>
		  	<div class="d-flex justify-content-center">
          <h5 class="text-center text-muted d-block" id="h1Advertencia"></h5>
        </div>
        <div class="row d-flex justify-content-center">
          <button class="btn btn-outline-primary" data-dismiss="modal" ><i class="icofont-check-alt"></i> Ok</button>
        </div>
      </div>
      
    </div>
  </div>
</div>