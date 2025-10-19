<div class="modal fade" id="modalMashup" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title">Mashup Rápido (Mock)</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p class="muted">Selecione dois trechos e clique em 'Gerar mashup' — operação simulatória apenas front-end.</p>
        <div class="row">
          <div class="col-md-6">
            <label>Trecho A</label>
            <select class="form-control mb-2" id="mashup-a"></select>
          </div>
          <div class="col-md-6">
            <label>Trecho B</label>
            <select class="form-control mb-2" id="mashup-b"></select>
          </div>
          <div class="col-12 mt-2" id="mashup-result" style="display:none;">
            <div class="alert alert-success">Mashup gerado (simulado). Pode salvar como demo.</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="generate-mashup">Gerar mashup</button>
        <button class="btn btn-outline-light" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
