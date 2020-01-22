<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Al requerir el autoload, cargamos todo lo necesario para trabajar
require_once APPPATH . "/third_party/dompdf/autoload.inc.php";
use Dompdf\Dompdf;

class Pdf extends Dompdf
{
	function __construct()
	{
		parent::__construct();
	}

	// por defecto, usaremos papel A4 en vertical, salvo que digamos otra cosa al momento de generar un PDF
	public function generate(
		$html,
		$filename = '',
		$stream = true,
		$paper = 'A4',
		$orientation = "portrait"
	) {
		$dompdf = new DOMPDF();
		$dompdf->loadHtml($html);
		$dompdf->setPaper($paper, $orientation);
		$dompdf->render();
		if ($stream) {
			// "Attachment" => 1 hará que por defecto los PDF se descarguen en lugar de presentarse en pantalla.
			$dompdf->stream($filename . ".pdf", array("Attachment" => 1));
		} else {
			return $dompdf->output();
		}
	}
}
?>
