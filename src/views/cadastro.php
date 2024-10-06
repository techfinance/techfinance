<div class="container-fluid d-flex align-items-center justify-content-center flex-wrap p-2 login-cadastro-view">
    <div class="p-2 banner">
        <p class="fs-2" id="brand">TECH FINANCE</p>
        <h1>Comece agora</h1>
        <p class="fs-3" style="font-weight: 500;">Já possui uma conta? <a href="#" class="cadastro-go" onclick="getPage('login')">Login</a></p>
        <div class="line-style"></div>
        <p class="p-banner" >Tenha o controle total do seu dinheiro de maneira simples e prática. Registre suas despesas, acompanhe seus objetivos e tome decisões financeiras mais inteligentes. Comece agora!</p>
        <button type="button" class="btn">Leia mais</button>
    </div>
    <div class="form">
        <h1>Cadastro</h1>
        <form action="../../src/controllers/controle_cadastro.php" method="POST">
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Nome</label>
                <input type="text" class="form-control" maxlength="100" name="nome" required>
            </div>
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" aria-describedby="emailHelp" name="email" maxlength="100" required>
                <div class="form-text">Não compartilhe o seu e-mail com ninguém.</div>
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Senha</label>
                <input type="password" class="form-control" maxlength="30" name="senha" required>
                <div class="form-text">Informe uma senha forte.</div>
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label" maxlength="30">Confirmar senha</label>
                <input type="password" class="form-control" name="confSenha" required>
            </div>
            <div class="incorreto" id="notEqual" hidden>As senhas estão diferentes!</div>
            <div class="incorreto" id="notEmail" hidden>E-mail já cadastrado</div>
            <div class="correto" id="cadastro-ok" hidden>Cadastrado com sucesso! <br> Faça <a href="#" onclick="getPage('login')">login</a> para acessar</div>
            <button type="submit" class="btn" style="margin: auto; margin-top: 40px;">Cadastrar</button>
        </form>
        
    </div>

</div>