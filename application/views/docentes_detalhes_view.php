<h1>Detalhes do docente '<?php echo $docente->nome  ?>'</h1>
<br /><br />
<p><img src="<?php echo base_url($foto_docente) ?>" alt="..." class="img-thumbnail"></p>
<p><strong>Nome: </strong><?php echo $docente->nome ?></p>
<p><strong>Email: </strong><?php echo $docente->email ?></p>
<p><strong>Página: </strong><a href="<?php echo "http://www.ifspcapivari.com.br/corpo-docente/" . $docente->slug ?>" target="blank" title="Ir para página do docente"><?php echo "http://www.ifspcapivari.com.br/corpo-docente/" . $docente->slug ?></a></p>
<p><strong>Regime de Trabalho: </strong><?php echo $docente->regime ?></p>
<p><strong>Currículo Lattes: </strong><?php echo $docente->curriculo ?></p>
<p><strong>Titulação: </strong><?php echo $docente->titulacao ?></p>
<p><strong>Descrição: </strong></p>
<p style="padding-left: 50px;"><?php echo $docente->descricao ?></p>
<p><strong>Disciplinas: </strong></p>
    
    

