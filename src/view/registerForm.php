<?php
include_once 'header.php';
?>
<form action="../controller/registerController.php" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>
    <button type="submit">Cadastrar</button>
</form>
<?php
include_once 'footer.php';
