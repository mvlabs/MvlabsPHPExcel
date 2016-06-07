<?php

namespace MvlabsPHPExcel\Service;

use Zend\Http\Headers;
use Zend\Http\Response;


/**
 * PhpExcelService for PHPExcel objects, StreamedResponse, and PHPExcel_Writer_IWriter.
 *
 * @package MvlabsPHPExcel
 */
class PhpExcelService
{
    private $phpExcelIO;

    public function __construct($phpExcelIO = '\PHPExcel_IOFactory')
    {
        $this->phpExcelIO = $phpExcelIO;
    }

    /**
     * Creates an empty PHPExcel Object if the filename is empty, otherwise loads the file into the object.
     *
     * @param string $filename
     *
     * @return \PHPExcel
     */
    public function createPHPExcelObject($filename = null)
    {
        return (null === $filename) ? new \PHPExcel() : call_user_func(array($this->phpExcelIO, 'load'), $filename);
    }

    /**
     * Create a worksheet drawing
     * @return \PHPExcel_Worksheet_Drawing
     */
    public function createPHPExcelWorksheetDrawing()
    {
        return new \PHPExcel_Worksheet_Drawing();
    }

    /**
     * Create a writer given the PHPExcelObject and the type,
     *   the type could be one of PHPExcel_IOFactory::$_autoResolveClasses
     *
     * @param \PHPExcel $phpExcelObject
     * @param string    $type
     *
     *
     * @return \PHPExcel_Writer_IWriter
     */
    public function createWriter(\PHPExcel $phpExcelObject, $type = 'Excel5')
    {
        return call_user_func(array($this->phpExcelIO, 'createWriter'), $phpExcelObject, $type);
    }

    /**
     * addWorkSheet: add a new worksheet to the PHPExcel object
     *
     * @param \PHPExcel $phpExcelObject
     * @param string $name
     * @return PHPExcel
     */
    public function addWorkSheet(\PHPExcel $phpExcelObject, $name)
    {
        // Create a new worksheet called "My Data"
        $myWorkSheet = new \PHPExcel_Worksheet($phpExcelObject, $name);

        // Attach the $name worksheet in the PHPExcel object
        $phpExcelObject->addSheet($myWorkSheet);

        return $phpExcelObject;
    }

    /**
     * Stream the file as Response.
     *
     * @param \PHPExcel_Writer_IWriter $writer
     * @param int                      $status
     * @param array                    $headers
     *
     * @return Zend\Http\Response
     */
    public function createHttpResponse(\PHPExcel_Writer_IWriter $writer, $status = 200, $headers = [])
    {
        ob_start();
        $writer->save('php://output');
        $content = ob_get_clean();

        $response = new Response();
        $response->setContent($content);
        $response->setStatusCode($status);

        $responseHeaders = new Headers();
        $responseHeaders->addHeaders($headers);
        $response->setHeaders($responseHeaders);

        return $response;
    }

    /**
     * Create a PHPExcel Helper HTML Object
     *
     * @return \PHPExcel_Helper_HTML
     */
    public function createHelperHTML()
    {
        return new \PHPExcel_Helper_HTML();
    }
}