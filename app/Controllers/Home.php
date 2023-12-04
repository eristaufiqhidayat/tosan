<?php

namespace App\Controllers;

use App\Models\MMenu;

class Home extends BaseController
{
    public function index($menuAktip = '', $moduleAktip = '')
    {
        if (isset(user()->username)) {
            helper('text');
            $json_berita = file_get_contents('http://restapi.lembaharafah.com/public/index.php/BERITA/553da6a93aa6c69f0363048aa677efee');
            $json_kalender = file_get_contents('http://restapi.lembaharafah.com/public/index.php/KALENDER/553da6a93aa6c69f0363048aa677efee');
            $dataBerita = json_decode($json_berita, true);
            $dataKalender = json_decode($json_kalender, true);
            $menu = new MMenu();
            $datamenu = $menu->listing();

            $data = array(
                'title'        => '',
                'content'    => 'home/index',
                'menu'   =>  $datamenu,
                'dataBerita' => $dataBerita,
                'dataKalender' => $dataKalender,
                'menuAktip' => $menuAktip,
                'moduleAktip' => $moduleAktip
            );
        } else {
            return redirect()->to(site_url('/login'));
        }

        return view('Home/V_Dasboard', $data);
    }
    public function login2()
    {
        helper('text');

        //return view('Home/V_Login');
        return redirect()->to(site_url('C_Home/index'));
    }
}
