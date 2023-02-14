<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
	public function index()
	{
		$berita = Berita::all();
		$tampung = [];
		$file_path = 'https://dapurkoding.my.id/';
		foreach ($berita as $p) {
			$row['id'] = $p['id'];
			$row['image'] = $file_path . 'berita/' . $p['image'];
			$row['url'] = $p['url'];
			$row['title'] = $p['judul'];
			$row['subtitle'] = $p['tanggal'];

			array_push($tampung, $row);
		}

		return response()->json(
			['caraousel' => $tampung]
		);
	}
}
