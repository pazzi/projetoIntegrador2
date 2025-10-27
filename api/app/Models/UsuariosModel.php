<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'email',
        'senha_hash',
        'nome_completo',
        'perfil',
        'ativo',
        'created_at',
        'updated_at'
    ];
    protected $validationRules = [
        'username' => 'required|min_length[3]|is_unique[usuarios.username]',
        'email' => 'required|valid_email|is_unique[usuarios.email]',
        'senha_hash' => 'required|min_length[8]',
        'nome_completo' => 'required|min_length[3]',
        'perfil' => 'required|in_list[ADMIN,USER]',
        'ativo' => 'required|in_list[0,1]'
    ];
}
