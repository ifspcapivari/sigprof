<?php $this->load->view('menu_docente'); ?>
<li>
    <a href="<?php echo base_url('semestres') ?>" <?php echo ($active == 'semestres' ? 'class="active"' : '') ?>>Semestres</a>
    <a href="<?php echo base_url('ferramentas') ?>" <?php echo ($active == 'ferramentas' ? 'class="active"' : '') ?>>Ferramentas</a>
</li>