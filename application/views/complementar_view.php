<h1>Informações Complementares</h1>
<form method="post" action="">
    <div class="form-group">
        <img src="<?php echo base_url('assets/img/profile-default.png') ?>" alt="..." class="img-thumbnail">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFotoPerfil">
            Alterar imagem
        </button>
    </div>
    <div class="form-group">
        <label for="curriculo_lattes">Currículo Lattes:</label>
        <input type="text" class="form-control" id="curriculo_lattes" value="<?php echo "" ?>" placeholder="Insira aqui o link do seu currículo lattes" >
    </div>
    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="7" placeholder="Coloque aqui uma breve descrição sobre você"></textarea>
    </div>
<button type="submit" class="btn btn-success" id="btnAtualizar" name="btnAtualizar">
    Atualizar Dados
</button>
</form>
<!-- Modal Senha -->
<div class="modal fade" id="modalFotoPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alterar Foto do Perfil</h4>
      </div>
        <form method="post" action="">
            <div class="modal-body">
                <div class="form-group">
                    <label for="foto">Escolha uma foto no tamanho 128 x 128 pixels:</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-success">Concluído</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
  </div>
</div>    