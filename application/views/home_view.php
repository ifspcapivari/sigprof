<h1>Dados Pessoais</h1>
<form>
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" placeholder="Nome" value="<?php echo $docente->nome ?>" readonly>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $docente->email ?>">
    </div>
    <div class="form-group">
        <label for="perfil">Perfil:</label>
        <select class="form-control">
            <option value="Docente">Docente</option>
            <option value="Administrador">Administrador</option>
            <option value="Sóciopedagógico">Sóciopedagógico</option>
        </select>
    </div>
    <div class="form-group">
        <label for="usuario">Usuário:</label>
        <input type="text" class="form-control" id="usuario" value="<?php echo $docente->usuario ?>" readonly>
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" class="form-control" id="senha">
    </div>
  <button type="submit" class="btn btn-success">Salvar Dados</button>
</form>