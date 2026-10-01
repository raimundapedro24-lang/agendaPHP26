<?php
// Conexão com o banco de dados
include('../../config/conexao.php');

// 1. Verificação do parâmetro enviado na URL
if (isset($_GET['idDelete'])) {
    $id = $_GET['idDelete'];

    // 2. Consulta para recuperar o nome da imagem cadastrada
    $select = "SELECT foto_contatos FROM tb_contatos WHERE id_contatos=:id";
    try {
        $result = $conect->prepare($select);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();
        
        $contar = $result->rowCount();
        if ($contar > 0) {
            $show = $result->fetch(PDO::FETCH_OBJ);
            $foto = $show->foto_contatos;
            
            // 3. Validação e remoção da imagem física do servidor
            if ($foto != 'avatar-padrao.png') {
                $filePath = "../../img/cont/" . $foto;
                
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // 4. Exclusão do registro na tabela
            $delete = "DELETE FROM tb_contatos WHERE id_contatos=:id";
            try {
                $result = $conect->prepare($delete);
                $result->bindValue(':id', $id, PDO::PARAM_INT);
                $result->execute();

                // 5. Redirecionamento após o sucesso
                header("Location: perfil.php");

            } catch (PDOException $e) {
                echo "<strong>ERRO DE DELETE: </strong>" . $e->getMessage();
            }
        } else {
            header("Location: ../home.php");
        }
    } catch (PDOException $e) {
        echo "<strong>ERRO DE SELECT: </strong>" . $e->getMessage();
    }
}
?>