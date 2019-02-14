<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 21/12/2018
 * Time: 10:11 AM
 */

namespace App\Objects;

use setasign\Fpdi\FpdfTplTrait;
use Codedge\Fpdf\Fpdf\Fpdf;

class PDFSplit extends Fpdf {
    use FpdfTplTrait;

}