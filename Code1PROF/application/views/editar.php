<?php $this->load->view('comuns/header'); ?>
    <body>
        <div id="container">
            <div class="inner">
                <h1 class="menu">Menu</h1>
                <nav>
                    <?php $this->load->view('comuns/menu'); ?>
                </nav>
            </div>
            
            
            <div>
                <h1>Lista de Contatos</h1>
<?php if ($this->session->flashdata('error') == TRUE): ?>
<p><?php echo $this->session->flashdata('error'); ?></p>
<?php endif; ?>
<?php if ($this->session->flashdata('success') == TRUE): ?>
    <p><?php echo $this->session->flashdata('success'); ?></p>
<?php endif; ?>

<form method="post" action="<?=base_url('update')?>" enctype="multipart/form-data">
    <div>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?=$contato['nome']?>" />
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" value="<?=$contato['nome']?>" />
    </div>
    <div>
        <label><em>Todos os campos são obrigatórios.</em></label>
        <input type="hidden" name="id" value=<?=$contato['id']?>/>
        <input type="submit" value="save"/>
    </div>
</form>
            </div>
            <div>
            <table>
                <caption>Contatos</caption>
                <thead>
                    <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ação</th></tr>
                </thead>
                <tbody>
<?php if ($contatos == FALSE): ?>
    <tr><td colspan="2">Nenhum contato encontrado</td></tr> 
<?php else: ?>  
<?php foreach ($contatos as $row): ?>
<tr>
    <td><?=$row['nome'] ?></td>
    <td><?=$row['email'] ?></td>
    <td>
        <a href="<?= $row['edit_url'] ?>">[Edit]</a>
        <a href="<?= $row['del_url'] ?>">[Del]</a></td>
    </td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
                </tbody>
            </table>
            </div>
            
            
            
        </div>  
<?php $this->load->view('comuns/footer'); ?>