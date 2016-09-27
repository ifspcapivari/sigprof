<h1>Docentes</h1>
<br />
<?php if($msg) : ?>
<div class="alert alert-danger"><?php echo $msg ?></div>
<?php endif; ?>
<br />
<?php if($msg_cache) : ?>
<p>Essa lista foi gerada a partir de uma lista em cache e pode não estar atualizada. <a href="<?php echo base_url('docentes/?cache=n') ?>">Clique aqui</a> para processar uma nova lista.</p>
<?php endif; ?>
<form name="formFiltroDocente" method="get" class="form-inline">
    <div class="form-group">
        <label>Nome: </label>
        <input type="text" class="form-control" id="d" name="d" value="<?php echo "" ?>" placeholder="Filtrar pelo nome" >
    </div>       
    <button type="submit" class="btn btn-primary">
        Filtrar
    </button>
</form>
<br />
<?php echo $tabela ?>