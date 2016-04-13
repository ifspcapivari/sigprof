<h1>Ferramentas</h1>
<br />
<?php if($msg) : ?>
    <div class="alert alert-danger"><?php echo $msg ?></div>
<?php endif; ?>
<br />
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalImportarLista" title="Clique para importar uma lista de Docentes">
            Importar Lista de Docentes
</button>
<br /><br />
<?php if($importados) : ?>
<h2><?php echo count($importados) ?> Contato(s) importado(s)</h2>
<ul>
    <?php foreach ($importados as $imp) : ?>
    <li><?php echo $imp['usuario'] . ' - ' . $imp['nome'] ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<?php if($duplicados) : ?>
<h2><?php echo count($duplicados) ?> Contato(s) duplicado(s) não foram importado(s)</h2>
<ul>
    <?php foreach ($duplicados as $dup) : ?>
    <li><?php echo $dup['usuario'] . ' - ' . $dup['nome'] ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<!-- Modal Importar Lista -->
<div class="modal fade" id="modalImportarLista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Importar Lista de Docentes</h4>
      </div>
        <form method="post" action="<?php echo base_url('ferramentas/importar_lista') ?>" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="foto">Escolha um arquivo no formato CSV:</label>
                    <input type="file" class="form-control" id="arquivo" name="arquivo">
                </div>
            </div>
            <div class="modal-footer">
                 <button type="submit" class="btn btn-success">Enviar</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
  </div>
</div>