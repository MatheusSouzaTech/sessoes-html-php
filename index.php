<?php

session_start();


if (!isset($_SESSION["usuarios"])){ //Verificação se o array de usuarios foi criado

    $_SESSION['usuarios'] = [ //Criação de um usuario teste para validar o array associativo de usuarios 
        [
        'id'=> 1,
        'nome'=> 'teste',
        'email'=> 'teste@gmail.com',
        'senha'=>'1234',
        'endereco' => 'rua teste',
        'uf' => 'MG',
        'doc' => '11111',
        'sexo' => 'feminino'
        ]

        ];
    }




// Cadastro de novos usuarios

function cadastro($nome, $email, $senha, $endereco, $uf, $doc, $sexo){

    foreach ($_SESSION['usuarios'] as $usuario){

        if ($usuario['email'] === $email || $usuario['doc'] === $doc){ // verificação se o email e o documento já existem
        
        return false;  // se o retorno for false siginifica que já existe  

        }
    }

    //Caso ele não exista sera criado um novo usuario

    $novo = [

        //incerção dos novos dados dos usuarios 

        'id' => count($_SESSION['usuarios']) + 1, //Adicionando um contador e atribuindo mais um para sempre que for feito um novo cadastro ele gerar um id
        'nome'=> $nome,
        'email' => $email,
        'senha' => $senha,
        'endereco' => $endereco,
        'uf' => $uf,
        'documento' => $doc,
        'sexo' => $sexo

    ];

    //Atribuição do novo usuario ao array associativo usuarios(array inicial)
    $_SESSION['usuarios'][] = $novo;

    return true; //Se o cadastro foi efetuado com sucesso ele retornar true ou verdadeiro

}

function fazerLogin($email,$senha)
{
    foreach($_SESSION['usuarios'] as $usuario)// verificar se o email e a senha estão corretos
    {
    if($usuario['email'] === $email && $usuario['senha'] === $senha)
    {
        //caso ele encontre o usuário com a as informações corretas na sessão
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        return true; // retorna true indicando o login foi efetuado com sucesso
    }
 
    }
    return false; // se não encontrar o usuário
}


// verificar se o usuário já está logado
if(isset($_SESSION['usuario_id']))
{
    header('Location: exclusivo.php');
    exit();//interrompe a execução do código
}

//processar o formulário login
 
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']))
{
    $email = $_POST['email']; // pegar o email do formulário
    $senha = $_POST['senha'];
 
    //efetuar o login com os dados cadastrados
    if(fazerLogin($email,$senha))
    {
        header('Location: exclusivo.php');
        exit();
    }else
 
    {
        $erro_login = 'Email ou senha incorretos';
    }
}

//cadastrar o formulario de cadastro

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastro'])){

    $nome =$_POST['nome'];
    $email = $_POST['email']; // pegar o email do formulário
    $senha = $_POST['senha'];
    $endereco = $_POST['endereco'];
    $uf = $_POST['uf'];
    $doc = $_POST['doc'];
    $sexo = $_POST['sexo'];
 
    //tentar cadastrar o novo usuário
    if(cadastro($nome, $email, $senha, $endereco, $uf, $doc, $sexo))
    {
        $sucesso_cadastro = 'Cadastro realizado com sucesso! Faça o Login';
    }else{
        $erro_cadastro = 'Erro ao cadastrar. Usuario já existe';
    }

}







?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tela Cadastro</title>
</head>
<body>

    

    <div class="cadastro-container">

    <div class="caixa-formulario">
    <h1>Cadastro de Usuarios</h1>

        <?php if (isset($erro_cadastro)): ?> 
            <p class="erro"><?php echo $erro_cadastro; ?></p>
        <?php endif; ?>
        <?php if (isset($sucesso_cadastro)): ?> 
            <p class="sucesso"><?php echo $sucesso_cadastro; ?></p>
        <?php endif; ?>

    <form method="post">
        <div class="text-container">


        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Nome">

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="E-mail">


        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Senha">


        <label for="endereco">Endereço</label>
        <input type="text" id="endereco" name="endereco" placeholder="Endereço">

        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone">

        <label for="uf">UF:</label>
        <select name="uf" id="uf" required>

                <option value="acre">AC</option>
                <option value="alagoas">AL</option>
                <option value="amapa">AP</option>
                <option value="amazonas">AM</option>
                <option value="bahia">BA</option>
                <option value="ceara">CE</option>
                <option value="distrito">DF</option>
                <option value="espiritoSanto">ES</option>
                <option value="goias">GO</option>
                <option value="maranhao">MA</option>
                <option value="matoGrosso">MT</option>
                <option value="matoGossoSul">MS</option>
                <option value="Minas">MG</option>
                <option value="para">PA</option>
                <option value="paraiba">PB</option>
                <option value="parana">PR</option>
                <option value="pernambuco">PE</option>
                <option value="piaui">PI</option>
                <option value="rio">RJ</option>
                <option value="rioNorte">RN</option>
                <option value="rioSul">RS</option>
                <option value="rondonia">RO</option>
                <option value="roraima">RR</option>
                <option value="santaCatarina">SC</option>
                <option value="saoPaulo">SP</option>
                <option value="sergipe">SE</option>
                <option value="tocantins">TO</option>

        </select>
        
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>

            <option value="selecao">Selecione</option>
            <option value="masc">Masculino</option>
            <option value="fem">Feminino</option>
            <option value="outro">Outro</option>

        </select>

        <label for="doc">Documento:</label>
        <select name="doc" id="doc" required>

            <option value="selecione">Selecione</option>
            <option value="rg">RG</option>
            <option value="cpf">CPF</option>
            <option value="cnpj">CNPJ</option>

        </select>

        <input type="text" id="doc" name="Documento" placeholder="Nº Documento" required>
        
        

        <button type="submit" name="cadastro">Cadastrar</button>

        </div>

    </form>
    
    <h1>Login</h1>


        <?php if (isset($erro_login)): ?>
            <p class="erro"><?php echo $erro_login; ?></p>
        <?php endif; ?>

    <form method="post">

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="E-mail">


        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Senha">

        <button type="submit" name="login">Entrar</button>


    </form>
    </div>

    </div>
    
</body>
</html>