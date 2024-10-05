<div class="container-fluid d-flex align-items-center justify-content-center flex-wrap p-2 login-cadastro-view">
    <div class="p-2 banner">
        <p class="fs-2" id="brand">TECH FINANCE</p>
        <h1>Bem-vindo!</h1>
        <p class="fs-3" style="font-weight: 500;">Ainda não possui uma conta? <a href="../src/views/cadastro.php" class="cadastro-go">Cadastrar</a></p>
        <div class="line-style"></div>
        <p class="p-banner">Bem-vindo! Acompanhe suas finanças, mantenha o controle dos seus gastos e continue atingindo suas metas financeiras com facilidade</p>
        <button type="button" class="btn">Leia mais</button>
    </div>
    <div class="form">
        <h1>Login</h1>
        <form action="../src/controllers/controle_login.php"method="POST">
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label" name="email">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text" maxlength="100">Não compartilhe o seu e-mail com ninguém.</div>
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" id="exampleInputPassword1" maxlength="30" required >
            </div>
            <button type="submit" class="btn" style="margin: auto; margin-top: 40px;">Entrar</button>
        </form>
        
    </div>

</div>