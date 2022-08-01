<?php /*if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

$header_align = '';

class Pdf extends TCPDF
{
	function __construct()
	{
		parent::__construct();
	}
}*/


if (!defined('BASEPATH'))
  exit('No direct script access allowed'); 
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

//echo phpinfo();
class Pdf extends Dompdf { 
    public function __construct() { 
        parent::__construct();
    } 
} 
		
?>