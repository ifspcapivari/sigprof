<li>
    <a href="<?php echo base_url('home') ?>" <?php echo (!$active || $active == 'home' ? 'class="active"' : '') ?>>Dados Pessoais</a>
</li>
<li>
    <a href="<?php echo base_url('home/complementar') ?>" <?php echo ($active == 'complementar' ? 'class="active"' : '') ?>>Informações Complementares</a>
</li>