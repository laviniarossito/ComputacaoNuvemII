<?php
        /*Resumo geral:
        1. Captura os dados do formulário ($_POST).
        2. Verifica se todos os campos estão preenchidos.
        3. Conecta ao banco MySQL usando mysqli.
        4. Cria e executa uma query SQL (INSERT INTO) para cadastrar os dados na tabela alunos.
        5. Mostra a mensagem de sucesso "Cadastro realizado!" ou uma mensagem de erro se houver algum problema na execução da query.*/


        /*Verifica se o campo foi enviado pelo formulário; se sim, guarda o valor, se não, define o campo como null*/
        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];
        } else {
            $nome = null;
        }

        if (isset($_POST["doc"])) {
            $doc = $_POST["doc"];
        } else {
            $doc = null;
        }

        if (isset($_POST["telefone"])) {
            $telefone = $_POST["telefone"];
        } else {
            $telefone = null;
        }

        if (isset($_POST["curso"])) {
            $curso = $_POST["curso"];
        } else {
            $curso = null;
        }

        if (isset($_POST["turma"])) {
            $turma = $_POST["turma"];
        } else {
            $turma = null;
        }

        /*Verifica se todos os campos necessários foram preenchidos*/
        if ($nome != null and $doc != null and $telefone != null and $curso != null and $turma != null) {

            /*Define os parâmetros para conectar ao banco de dados MySQL: 
            host (servidor), 
            user (usuário do BD), 
            password (senha, aqui vazia), 
            banco (nome do banco).*/
            $host = "localhost";
            $user = "root";
            $password = "";
            $banco = "escola";

            /*Instancia um objeto mysqli e tenta conectar ao MySQL com os parâmetros acima. 
            $conn é o objeto de conexão que você vai usar para executar queries.*/
            $conn = new mysqli($host, $user, $password, $banco);

            /*$conn->connect_errno retorna um código de erro se a conexão falhou.
            Se houver erro, o código imprime uma mensagem e termina o script com exit().*/
            if ($conn->connect_errno) {
                print("Connect failed: %s\n" . $conn->connect_errno);
                /*echo "Connect failed: " . $conn->connect_error;*/
                exit();
            }

            /*Cria a string SQL para inserir um registro na tabela alunos.
            Campos listados: matricula, nome, doc, tel, curso, turma.
            Para matricula está sendo passado '' (string vazia) por ser AUTO_INCREMENT na tabela.*/
            $sql = "INSERT INTO alunos (matricula, nome, doc, tel, curso, turma) VALUES('', '$nome', '$doc', '$telefone','$curso', '$turma')";

            /*$conn->query($sql) executa a query. Em caso de sucesso retorna TRUE para queries sem resultado (como INSERT).
            Se deu certo, mostra Cadastro realizado!. Se deu erro, exibe a query e a mensagem de erro MySQL ($conn->error). */
            if ($conn->query($sql) === TRUE) {
                echo "Cadastro realizado!";
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<p>Preencha todos os campos para cadastrar!</p>";
        }
?>
