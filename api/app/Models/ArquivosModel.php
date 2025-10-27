<?php

namespace App\Models;

use CodeIgniter\Model;

class ArquivosModel extends Model
{
    protected $table = 'arquivos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nome_original',
        'nome_armazenamento',
        'mime_type',
        'checksum_sha256',
        'descricao',
        'publico',
        'created_at',
        'updated_at',
        'usuario_upload_id'
    ];
    protected $validationRules = [
        'nome_original' => 'required|min_length[3]|is_unique[usuarios.username]',
        'myme_type' => 'required|valid_mime_type',
        'descricao' => 'required|min_length[8]',
        'publico' => 'required'
    ];
}
