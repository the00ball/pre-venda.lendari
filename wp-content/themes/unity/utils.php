<?php

// For 4.3.0 <= PHP <= 5.4.0
if (!function_exists('http_response_code'))
{
    function http_response_code($newcode = NULL)
    {
        static $code = 200;
        if($newcode !== NULL)
        {
            header('X-PHP-Response-Code: '.$newcode, true, $newcode);
            if(!headers_sent())
                $code = $newcode;
        }
        return $code;
    }
}

// Get Status Image

function get_image_status_associado($status) {
  $image = get_template_directory_uri();
  switch ($status) {
    case ST_PENDENTE:
    case ST_AGUARDANDO:
      $image .= "/images/pag_status_aguardando.png";
      break;
    case ST_EM_ANALISE:
      $image .= "/images/pag_status_em_analise.png";
      break;
    case ST_PAGA:
    case ST_DISPONIVEL:
      $image .= "/images/pag_status_ok.png";
      break;
    case ST_EM_DISPUTA:
    case ST_DEVOLVIDA:
      $image .= "/images/pag_status_devolvida.png";
      break;
    case ST_CANCELADA:
      $image .= "/images/pag_status_cancel.png";
      break;
    default:
      $image .= "none.png";
      break;
  }
  return $image;
}

function fmt_img_path($img_file_name) {
  $home = get_template_directory_uri();
  return "$home/images/$img_file_name";
}

?>
