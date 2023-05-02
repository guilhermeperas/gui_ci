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
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>first</th>
                            <th>last</th>
                            <th>email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?foreach($clientes as $cliente):?>
                            <tr>
                                <td><?=$cliente->id?></td>
                                <td><?=$cliente->first_name?></td>
                                <td><?=$cliente->last_name?></td>
                                <td><?=$cliente->email?></td>
                            </tr>
                        <?endforeach;?>
                    </tbody>
                </table>
                <p><?=$links?></p>

		    </div>	
<?php $this->load->view('comuns/footer'); ?>