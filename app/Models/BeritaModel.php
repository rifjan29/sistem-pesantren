<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
	protected $table = "berita_acara";
	protected $primaryKey = "id";
	protected $useAutoIncrement = true;
	protected $allowedFields = ["judul", "kategori_id", "keterangan", "image"];


	public function rules()
	{
		return [
			'judul' => 'required',
			'kategori' => 'required',
			'keterangan' => 'required',
			'gambar' => 'required',
		];
	}


	public function getAll()
	{
		return  $this->orderBy("id", "desc")->findAll();
	}
	public function getById($id)
	{
		return  $this->where("id", $id)->first();
	}

	public function store($data)
	{
		$data["kategori_id"] = $data["kategori"];
		$data["image"] = $data["gambar"];
		unset($data["kategori"]);
		unset($data["image"]);
		try {
			return  $this->insert($data);
			return true;
		} catch (\Throwable $th) {
			return false;
		}
	}
	public function updateData($id, $data)
	{
		$data["kategori_id"] = $data["kategori"];
		$data["image"] = $data["gambar"];
		unset($data["kategori"]);
		unset($data["image"]);
		try {
			return  $this->where("id", $id)->update($data);
			return true;
		} catch (\Throwable $th) {
			return false;
		}
	}

	public function deleteData($id)
	{
		try {
			return  $this->where("id", $id)->delete();
			return true;
		} catch (\Throwable $th) {
			return false;
		}
	}
}
