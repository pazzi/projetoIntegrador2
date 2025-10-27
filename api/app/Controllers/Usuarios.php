<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Usuarios extends ResourceController
{

	private $usuarioModel;

	public function __construct()
	{

		$this->usuarioModel = new \App\Models\UsuariosModel();
	}

	//servico para listar todos os registros
	public function list()
	{
		$data = $this->usuarioModel->findAll();
		return $this->response->setJSON($data);
	}

	public function detalhes($id)
	{
		$data = $this->usuarioModel->find($id);
		if ($data) {
			return $this->response->setJSON($data);
		} else {
			return $this->response->setStatusCode(404, 'Usuário não encontrado');
		}
	}

	public function update($id = null)
	{
		$input = $this->request->getJSON();

		$usuario = $this->usuarioModel->find($id);
		if (!$usuario) {
			return $this->response->setStatusCode(404, 'Usuário não encontrado');
		}
		$this->usuarioModel->update($id, $input);
		return $this->response->setJSON(['message' => 'Usuário atualizado com sucesso']);
	}

	public function delete($id = null)
	{
		$usuario = $this->usuarioModel->find($id);
		if (!$usuario) {
			return $this->response->setStatusCode(404, 'Usuário não encontrado');
		}

		$this->usuarioModel->delete($id);
		return $this->response->setJSON(['message' => 'Usuário deletado com sucesso']);
	}

	public function create()
	{
		$input = $this->request->getJSON();

		$id = $this->usuarioModel->insert($input);
		if ($id) {
			return $this->response->setStatusCode(201)->setJSON(['message' => 'Usuário criado com sucesso', 'id' => $id]);
		} else {
			return $this->response->setStatusCode(400, 'Erro ao criar usuário');
		}
	}
	public function listByUsername($username)
    {
        $data = $this->usuarioModel->where('username', $username)->findAll();
        return $this->response->setJSON($data);
    }
	
}
