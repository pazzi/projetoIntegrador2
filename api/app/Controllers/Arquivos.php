<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Arquivos extends ResourceController
{
    private $arquivoModel;

    public function __construct()
    {

        $this->arquivoModel = new \App\Models\ArquivosModel();
    }


    public function upload()
    {
        $file = $this->request->getFile('arquivo');
        $descricao = $this->request->getPost('descricao');
        $publico = $this->request->getPost('publico');
        $usuarioUploadId = $this->request->getPost('usuario_upload_id');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $nomeArmazenamento = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $nomeArmazenamento);

            $checksumSha256 = hash_file('sha256', WRITEPATH . 'uploads/' . $nomeArmazenamento);

            $data = [
                'nome_original' => $file->getClientName(),
                'nome_armazenamento' => $nomeArmazenamento,
                'mime_type' => $file->getClientMimeType(),
                'checksum_sha256' => $checksumSha256,
                'descricao' => $descricao,
                'publico' => $publico,
                'usuario_upload_id' => $usuarioUploadId
            ];

            $this->arquivoModel->insert($data);

            return $this->response->setJSON(['message' => 'Arquivo enviado com sucesso']);
        } else {
            return $this->response->setStatusCode(400, 'Erro no upload do arquivo');
        }
    }

    public function list()
    {
        $data = $this->arquivoModel->findAll();
        return $this->response->setJSON($data);
    }

    public function detalhes($id)
    {
        $data = $this->arquivoModel->find($id);
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setStatusCode(404, 'Arquivo não encontrado');
        }
    }

    public function delete($id = null)
    {
        $arquivo = $this->arquivoModel->find($id);
        if (!$arquivo) {
            return $this->response->setStatusCode(404, 'Arquivo não encontrado');
        }

        // Deleta o arquivo do sistema de arquivos
        unlink(WRITEPATH . 'uploads/' . $arquivo['nome_armazenamento']);

        $this->arquivoModel->delete($id);
        return $this->response->setJSON(['message' => 'Arquivo deletado com sucesso']);
    }

    public function update($id = null)
    {
        $input = $this->request->getJSON();

        $arquivo = $this->arquivoModel->find($id);
        if (!$arquivo) {
            return $this->response->setStatusCode(404, 'Arquivo não encontrado');
        }

        $this->arquivoModel->update($id, $input);
        return $this->response->setJSON(['message' => 'Arquivo atualizado com sucesso']);
    }

    public function listByUser($usuarioId)
    {
        $data = $this->arquivoModel->where('usuario_upload_id', $usuarioId)->findAll();
        return $this->response->setJSON($data);
    }
}
