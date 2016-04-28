<h1>Query Builder</h1>
<form method="post" action="">
    <div class="form-group">
        <label for="query">Query:</label>
        <textarea class="form-control" id="query" name="query" rows="7" placeholder="Construa sua instrução SQL aqui"><?php echo $this->input->post('query') ?></textarea>
    </div>
    <button type="submit" class="btn btn-success" id="btnAtualizar" name="btnAtualizar">
        Executar
    </button>
</form>
<br />
<?php echo (isset($resp) ? $resp : ''); ?>