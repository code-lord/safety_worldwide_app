<?php

namespace frontend\controllers\api;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * LocationController implements the CRUD actions for Location model.
 */
class MobileController extends Controller {

    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'SAFETY_APP';

    private $format = 'json';

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionGetprojectdata() {
        $representative = $this->_checkAuth();

        $contracts = [];
        $location_for_contract = [];
        $projects = \app\models\RepresentativeContract::findAll(["representative_master" => $representative->id]);

        for ($index = 0; $index < count($projects); $index++) {

            $contract_raw = [];
            $inspection_category = [];
            $location = \app\models\Location::findAll(["location_contract_master" => $projects[$index]->contractMaster->id]);

            $data = [];
            for ($index1 = 0; $index1 < count($location); $index1++) {
                $location_for_contract[] = $location[$index1]->name;
            }

            $inspection1 = \app\models\ContractWork::findAll(["work_contract_type" => $projects[$index]->contractMaster->contract_type]);
//            echo json_encode($inspection);
            for ($index1 = 0; $index1 < count($inspection1); $index1++) {
                $inspection = [];
                $inspection["id"] = $inspection1[$index1]->id;
                $inspection["name"] = $inspection1[$index1]->name;
                $inspection["inspection_type"] = [];
                $inspection_type = \app\models\InspectionType::findAll(["contract_work" => $inspection1[$index1]->id]);
                for ($index2 = 0; $index2 < count($inspection_type); $index2++) {
                    $inspection_type1 = [];
                    $inspection_type1["id"] = $inspection_type[$index2]->id;
                    $inspection_type1["name"] = $inspection_type[$index2]->name;
                    $inspection["inspection_type"] = $inspection_type1;
                }
                $inspection_category[] = $inspection;
            }
            $contract_raw["contract_id"] = $projects[$index]->id;
            $contract_raw["inspection_work"] = $inspection_category;
            $contracts[] = $contract_raw;
        }
        $Responce = [
            'Status_code' => '200',
            'Success' => 'True',
            'Message' => 'Authentication Successful !',
            'locations' => $location_for_contract,
            'contracts' => $contracts,
        ];
        $this->_sendResponse(200, $Responce);
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionAuth() {
        $representative = $this->_checkAuth();

        $data = [];
        foreach ($representative->attributes as $name => $value) {
            if ($name == "password") {
                continue;
            }
            $touple = [];
            $touple["attribute"] = $name;
            $touple["value"] = $value;
            $data[] = $touple;
        }
        $Responce = [
            'Status_code' => '200',
            'Success' => 'True',
            'Message' => 'Authentication Successful !',
            'representative' => $data,
            'projects' => $this->getProjectsForRepresentative($representative->id)
        ];
        $this->_sendResponse(200, $Responce);
    }

    public function getProjectsForRepresentative($representative_id) {

        $projects = \app\models\RepresentativeContract::findAll(["representative_master" => $representative_id]);
        $projects_array = [];
        for ($index = 0; $index < count($projects); $index++) {
            $project = [];
            $project["project_name"] = $projects[$index]->contractMaster->name;
            $project["project_id"] = $projects[$index]->contract_master;
            $projects_array[] = $project;
        }
        return $projects_array;
    }

    /**
     * Lists all Location models.
     * @return mixed
     */
    public function actionIndex() {
        $representative = $this->_checkAuth();
        $Responce = [
            'Status_code' => '401',
            'Success' => 'False',
            'Message' => 'Authentication Fail !',
            'Error' => 'Branch is inactive.'
        ];
        $this->_sendResponse(401, $Responce);
    }

    /**
     * Checks if a request is authorized
     * 
     * @access private
     * @return void
     */
    private function _checkAuth() {

        date_default_timezone_set("Asia/Kolkata");
        /**
         * This Header is used for getting data for authentication
         */
//        $headers = $_SERVER;
//
//        foreach ($headers as $header => $value) {
//            echo "$header: $value <br />\n";
//        }
//        echo json_encode($_SERVER);
//        Yii::app()->end();
// Check if we have the USERNAME and PASSWORD HTTP headers set?
        if (!(isset($_SERVER['HTTP_API_' . self::APPLICATION_ID . '_USERNAME']) and isset($_SERVER['HTTP_API_' . self::APPLICATION_ID . '_PASSWORD']))) {
// Error: Unauthorized
            $this->_sendResponse(403);
        }
        $username = $_SERVER['HTTP_API_' . self:: APPLICATION_ID . '_USERNAME'];
        $password = $_SERVER['HTTP_API_' . self::APPLICATION_ID . '_PASSWORD'];
// Find the user
        $representative = \app\models\RepresentativeMaster::findOne(["username" => $username]);

        if ($representative === null) {
// Error: Unauthorized
            $Responce = [
                'Status_code' => '401',
                'Success' => 'False',
                'Message' => 'Authentication Fail !',
                'Error' => 'Username is invalid.'
            ];
            $this->_sendResponse(401, $Responce);
        } else if ($representative->password != sha1($password)) {
// Error: Unauthorized
            $Responce = [
                'Status_code' => '401',
                'Success' => 'False',
                'Message' => 'Authentication Fail !',
                'Error' => 'Password is invalid.'
            ];
            $this->_sendResponse(401, $Responce);
        }
        return $representative;
    }

    /**
     * Sends the API response 
     * 
     * @param int $status 
     * @param string $body 
     * @param string $content_type 
     * @access private
     * @return void
     */
    private function _sendResponse($status = 200, $body = '', $content_type = 'application/json') {
// set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
// and the content type
        header('Content-type: ' . $content_type);
// pages with body are easy
        if ($body != '') {
// send the body
            echo json_encode($body);
        } else {
// create some body messages
            $message = '';
// this is purely optional, but makes the pages a little nicer to read
// for your users.  Since you won't likely send a lot of different status codes,
// this also shouldn't be too ponderous to maintain
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to use this service.';
                    break;
                case 403:
                    $message = 'Forbidden to use this service.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }
            $body = [
                'Status_code' => $status,
                'Success' => 'False',
                'Message' => $message,
            ];
            echo json_encode($body);
        }
        Yii::$app->end();
    }

    /**
     * Gets the message for a status code
     * 
     * @param mixed $status 
     * @access private
     * @return string
     */
    private function _getStatusCodeMessage($status) {
// these could be stored in a .ini file and loaded
// via parse_ini_file()... however, this will suffice
// for an example
        $codes = Array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

}
