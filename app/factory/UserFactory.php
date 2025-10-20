<?php
class UserFactory {
    public static function create($nome, $email, $senha) {
        return [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha
        ];
    }
}
?>
