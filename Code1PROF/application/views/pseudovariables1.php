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
                    <th>morada</th>
                    <th>email</th>
                    <th>username</th>
                    <th>password</th>
                    <th>fullname</th>
                </tr>
            </thead>
            <tbody>
                {list_users}
                <!-- ASSIM SABE QUE É UMA LISTA -->
                <tr>
                    <td>{id}</td>
                    <td>{nome}</td>
                    <td>{morada}</td>
                    <th>{email}</th>
                    <th>{username}</th>
                    <th>{password}</th>
                    <th>{fullname}</th>
                </tr>
                {/list_users}
            </tbody>
        </table>
    </div>
    <a href="<?=base_url('/pseudovariables/exemplo2')?>">Exemplo 2</a>
</body>