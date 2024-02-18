<?php

include 'config.php';
include 'navbar.php';

function editarSucess($mensagem)
{
    echo '<div class="alert alert-success" role="alert">' . $mensagem . '</div>';
}

?>

<div class="container d-flex justify-content-center" style="margin-top: 130px;">

    <form method="POST" action="">
        <?php
        // Verifique se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recupere os dados do formulário
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];

            // Consulta SQL para atualizar os detalhes da tarefa no banco de dados
            $sql = "UPDATE clientes SET nome=:nome, email=:email, telefone=:telefone WHERE id=:id";

            // Preparar e executar a consulta SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                editarSucess('Editado com sucesso!');
            } else {
                echo "Erro ao atualizar a tarefa: " . $stmt->errorInfo()[2];
            }
        }

        // Verifique se foi fornecido um ID válido na URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Consulta SQL para obter os detalhes da tarefa com base no ID
            $sql = "SELECT * FROM clientes WHERE id = :id";
            // Preparar e executar a consulta SQL
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Exibir o formulário preenchido com os detalhes da tarefa

?>
            <div class="card" style="width: 22rem;">
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        <strong>Cuidado ao editar o cadastro</strong>
                    </div>
                    <!-- Campo oculto para armazenar o ID da tarefa -->
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" name="nome" value="<?php echo $row['nome']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputNumber1" class="form-label">Telefone</label>
                        <input type="number" class="form-control" id="exampleInputNumber1" name="telefone" value="<?php echo $row['telefone']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Editar cadastro</button>
                </div>
            </div>
        <?php
        }
        ?>
    </form>
</div>
