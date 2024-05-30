<?php

namespace App\Controllers;

use App\Helpers\Helpers;
use App\Models\Santri_model;
use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
	protected $helpers = ['form'];
	protected $transaksi;
	protected $santri;
	protected $validation;
	protected $db;
	public function __construct()
	{
		$this->transaksi = new TransaksiModel();
		$this->santri = new Santri_model();
		$this->validation = \Config\Services::validation();
		$this->db = \Config\Database::connect();

		if (!session()->get("user_id")) {
			redirect('/');
		}
	}

	public function replaceRupiah($rupiah)
	{
		$nominal = str_replace(['Rp.', '.', ' '], '', $rupiah);
		return $nominal;
	}

	public function kode_transaksi()
	{
		$this->transaksi->generateKode();
	}

	public function index()
	{
		$data["tittle"] = "Pemasukan";
		$data["curennt_page"] = "Pendaftaran";
		$data["data"] = $this->transaksi->getPendaftaran()->getResultArray();
		return view("backoffice/pendaftaran/index", $data);
	}
	public function create()
	{
		$status_santri = 'belum_registrasi';
		$countsantri = $this->santri->countSantri($status_santri);
		if ($countsantri == 0) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Tidak ada santri yang belum membayar registrasi, Silahkan tambahkan santri terlebih dahulu.');
			return redirect()->to('dashboard/pendaftaran');
		}

		$data["title"] = "Pemasukan";
		$data["current_page"] = "Pendaftaran";
		$data["santri"] = $this->santri->getSantriRegistrasi()->getResultArray();


		return view("backoffice/pendaftaran/create", $data);
	}

	public function store()
	{
		$santri_id = $this->request->getPost("santri");
		$tanggal_bayar = $this->request->getPost("tanggal_bayar");

		$nominal = $this->replaceRupiah($this->request->getPost("nominal"));

		$userId = session()->get("user_id");
		$userId = 1;

		$valid = $this->validateData([
			"santri" => $santri_id,
			"tanggal_bayar" => $tanggal_bayar,
			"nominal" => $nominal
		], $this->transaksi->rulesPendaftaran());
		if (!$valid) {
			return redirect()->back()->withInput()->with("validation", $this->validator->getErrors());
		}

		$this->db->transBegin();
		try {
			$data = [
				"kategori" => "pemasukan",
				"santri_id" => $santri_id,
				"nominal" => $nominal,
				"no_transaksi" => $this->transaksi->generateKode(),
				"jenis_id" => 1,
				"tanggal_bayar" => $tanggal_bayar,
				"user_id" => $userId,
			];

			$status_santri = 'belum_registrasi_ulang';

			$this->santri->updateStatus($santri_id, $status_santri);
			$this->db->transCommit();

			$this->transaksi->storePendaftaran($data);
			$this->db->transCommit();

			session()->setFlashdata("status_success", true);
			session()->setFlashdata('message', 'Pendaftaran santri berhasil.');
			return redirect()->to('dashboard/pendaftaran');
		} catch (\Throwable $th) {
			$this->db->transRollback();
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Pendaftaran gagal, <br>' . $th->getMessage());
			return redirect()->to('dashboard/pendaftaran');
		} catch (\Exception $e) {
			$this->db->transRollback();
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Pendaftaran gagal, <br>' . $e->getMessage());
			return redirect()->to('dashboard/pendaftaran');
		}
	}

	public function pendaftaranUlang()
	{
		$data["tittle"] = "Pemasukan";
		$data["curennt_page"] = "Pendaftaran Ulang";
		$data["data"] = $this->transaksi->getPendaftaranUlang()->getResultArray();
		return view("backoffice/pendaftaran-ulang/index", $data);
	}
	public function pendaftaranUlangCreate()
	{
		$status_santri = 'belum_registrasi_ulang';
		$countsantri = $this->santri->countSantri($status_santri);
		if ($countsantri == 0) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Tidak ada santri yang belum membayar registrasi ulang, Silahkan tambahkan santri terlebih dahulu.');
			return redirect()->to('dashboard/pendaftaran-ulang');
		}
		$data["title"] = "Pemasukan";
		$data["current_page"] = "Pendaftaran Ulang";
		$data["santri"] = $this->santri->getSantriRegistrasiUlang()->getResultArray();

		return view("backoffice/pendaftaran-ulang/create", $data);
	}

	public function pendaftaranUlangStore()
	{
		$santri_id = $this->request->getPost("santri");
		$tanggal_bayar = $this->request->getPost("tanggal_bayar");

		$nominal = $this->replaceRupiah($this->request->getPost("nominal"));

		$userId = session()->get("user_id");
		$userId = 1;

		$valid = $this->validateData([
			"santri" => $santri_id,
			"tanggal_bayar" => $tanggal_bayar,
			"nominal" => $nominal
		], $this->transaksi->rulesPendaftaran());
		if (!$valid) {
			return redirect()->back()->withInput()->with("validation", $this->validator->getErrors());
		}

		$this->db->transBegin();
		try {
			$data = [
				"kategori" => "pemasukan",
				"santri_id" => $santri_id,
				"nominal" => $nominal,
				"no_transaksi" => $this->transaksi->generateKode(),
				"jenis_id" => 2,
				"tanggal_bayar" => $tanggal_bayar,
				"user_id" => $userId,
			];
			$status_santri = 'aktif';

			$this->santri->updateStatus($santri_id, $status_santri);
			$this->db->transCommit();

			$this->transaksi->storePendaftaran($data);
			$this->db->transCommit();

			session()->setFlashdata("status_success", true);
			session()->setFlashdata('message', 'Pendaftaran ulang santri berhasil.');
			return redirect()->to('dashboard/pendaftaran-ulang');
		} catch (\Throwable $th) {
			$this->db->transRollback();
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Pendaftaran ulang gagal, <br>' . $th->getMessage());
			return redirect()->to('dashboard/pendaftaran-ulang');
		} catch (\Exception $e) {
			$this->db->transRollback();
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Pendaftaran ulang gagal, <br>' . $e->getMessage());
			return redirect()->to('dashboard/pendaftaran-ulang');
		}
	}



	//method transaksi bulanan
	public function indexBulanan()
	{
		$data["tittle"] = "Pemasukan";
		$data["curennt_page"] = "Bulanan";
		$data["data"] = $this->transaksi->getBulanan()->getResultArray();
		return view("backoffice/bulanan/index", $data);
	}
	public function createBulanan()
	{
		$data["title"] = "Tambah Bulanan";
		$data["current_page"] = "Bulanan";
		$data["santri"] = $this->santri->getSantriAktifAlumni()->getResultArray();
		return view("backoffice/bulanan/create", $data);
	}

	public function storeBulanan()
	{
		$santriId = $this->request->getPost('santri');
		$nominal = $this->replaceRupiah($this->request->getPost("nominal"));
		$bulan = $this->request->getPost("bulan");
		$tahun = $this->request->getPost("tahun");
		$userId = session()->get("user_id");
		$userId = 1;
		$validasi = [
			"santri" => $santriId,
			"bulan" => $bulan,
			"tahun" => $tahun,
			"nominal" => $nominal,
		];
		$valid = $this->validateData($validasi, $this->transaksi->rulesBulanan());
		if (!$valid) {
			return redirect()->back()->withInput()->with("validation", $this->validator->getErrors());
		}


		//kondisi duplikat data transaksi
		$santri = $this->transaksi
			->join("santri", "transaksi.santri_id = santri.id")
			->where("bulan", $bulan)
			->where("tahun", $tahun)
			->where("santri_id", $santriId)
			->first();
		if ($santri) {
			$namaSantri = $santri["nama"];
			session()->setFlashdata("status_error", true);
			$bulan = Helpers::getMontName($bulan - 1);
			session()->setFlashdata('error', "Transaksi bulanan pada bulan $bulan  dan tahun $tahun untuk santri $namaSantri sudah ada");
			return redirect()->back()->withInput();
		}

		//kondisi tanggal keluar alumni
		$santri = $this->santri->select("month(tanggal_keluar) as bulan,year(tanggal_keluar) as tahun,nama")
			->where("status_santri", "alumni")
			->where("id", $santriId)
			->first();
		if ($santri) {
			if (
				$santri["tahun"] < $tahun || ($santri["tahun"] == $tahun && $santri["bulan"] < $bulan)
			) {
				$namaSantri = $santri["nama"];
				session()->setFlashdata("status_error", true);
				$bulan = Helpers::getMontName($santri["bulan"] - 1);
				$tahun = $santri["tahun"];
				session()->setFlashdata('error', "Transaksi bulanan  untuk santri $namaSantri tidak boleh lebih dari  bulan $bulan   $tahun");
				return redirect()->back()->withInput();
			}
		}

		try {
			$this->db->transBegin();
			$data = [
				"kategori" => "pemasukan",
				"santri_id" => $santriId,
				"nominal" => $nominal,
				"no_transaksi" => $this->transaksi->generateKode(),
				"jenis_id" => 3,
				"tanggal_bayar" => date("Y-m-d H:i"),
				"bulan" => $bulan,
				"tahun" => $tahun,
				"user_id" => $userId,
			];

			if ($this->transaksi->storeBulanan($data)) {
				session()->setFlashdata("status_success", true);
				$this->db->transCommit();
				session()->setFlashdata('message', 'Transaksi berhasil ditambahkan');
				return redirect()->to('dashboard/bulanan');
			} else {
				session()->setFlashdata("status_error", true);
				$this->db->transRollback();
				session()->setFlashdata('error', 'Transaksi gagal ditambahkan');
				return redirect()->back()->withInput();
			}
		} catch (\Throwable $th) {
			session()->setFlashdata("status_error", true);
			$this->db->transRollback();
			session()->setFlashdata('error', 'Transaksi gagal ditambahkan');
			return redirect()->back()->withInput();
		}
	}
}
