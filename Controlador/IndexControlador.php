<?php
require_once './Modelo/Metodos/BannerM.php';

class IndexControlador
{
    function Index()
    {
        $bannerM = new BannerM();
        $url = $bannerM->BuscarBannerActivo();
        require_once './Web/index.php';
    }
}
