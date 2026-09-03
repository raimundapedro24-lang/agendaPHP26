<?php
// 1. Inclui o cabeçalho do layout
include_once('../includes/header.php');

// 2. Sanitização do parâmetro recebido via URL
$acao = filter_var(isset($_GET['acao']) ? $_GET['acao'] : 'bemvindo', FILTER_SANITIZE_STRING);

// 3. Mapeamento das rotas permitidas
$paginas = [
    'bemvindo'  => '../paginas/conteudo/cadastro_contato.php',
    'editar'    => '../paginas/conteudo/update_contato.php',
    'perfil'    => '../paginas/conteudo/perfil.php',
    'relatorio' => '../paginas/conteudo/relatorio.php'
];

// 4. Validação da rota ou definição do padrão
$pagina_incluir = isset($paginas[$acao]) ? $paginas[$acao] : $paginas['bemvindo'];

// 5. Inclusão da página de conteúdo correspondente
include_once($pagina_incluir);

// 6. Inclui o rodapé do layout
include_once('../includes/footer.php');
?>
