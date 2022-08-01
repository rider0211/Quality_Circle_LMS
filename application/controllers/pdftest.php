<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '/libraries/FPDI/fpdi.php';
require APPPATH . '/libraries/tcpdf/tcpdf.php';
require APPPATH . '/libraries/tcpdf/examples/example_039.php';
require APPPATH . '/libraries/fpdf/fpdf.php';
require APPPATH . '/libraries/fpdf/tutorial/tuto2.php';
require APPPATH . '/third_party/TCPDF-master/tcpdf.php';
require APPPATH . '/third_party/TCPDF-master/examples/example_001.php';
/**
 * Class : Certification (CertificationController)
 * Certification Class to control all certification related operations.
 * @author : ping
 * @version : 1.0
 * @since : 11 July 2018
 */
class pdftest extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
       
    }
}