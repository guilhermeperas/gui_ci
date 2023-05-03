<body>
    <div id="container1">
        <h3>{h3_string}</h3>
        <p>{p_string}</p>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>email</th>
                </tr>
            </thead>
            <tbody>
                {list_clients}
                <!-- ASSIM SABE QUE É UMA LISTA -->
                <tr>
                    <td>{id}</td>
                    <td>{nome}</td>
                    <td>{email}</td>
                </tr>
                {/list_clients}
            </tbody>
        </table>
        <a href="<?=base_url('/pseudovariables/exemplo1')?>">Lista Db</a>
    </div>
</body>