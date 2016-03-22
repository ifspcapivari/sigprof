<h1>Gerenciar Semestres</h1>
<br />
<?php if($msg) : ?>
<div class="alert alert-danger"><?php echo $msg ?></div>
<?php endif; ?>
<br />
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalFormSemestre" title="Clique para adicionar um novo semestre">
            + Semestre
</button>
<br /><br />
    <?php echo $tabela ?>

<!-- Modal Form Semestres -->
<div class="modal fade" id="modalFormSemestre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Novo semestre</h4>
      </div>
        <form method="post" action="<?php echo base_url('semestres/adicionar') ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label for="descricao">Semestre:</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Ex: 2016/1">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" name="status" id="status">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                 <button type="submit" class="btn btn-success">Salvar</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
  </div>
</div>