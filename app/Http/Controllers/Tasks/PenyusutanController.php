<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Tasks\WebBasedController;
use App\Model\Users;
use App\Model\Units;
use \App\Model\Tarifs;
use App\Model\Penyusutan;
use Auth;
use Excel;
use DB;

class PenyusutanController extends WebBasedController
{
    private $user;
    private $maximum_upload_file;

    public function __construct()
    {
        parent::__construct();
        $this->maximum_upload_file = 10485760; //10 MB;
        $user = Auth::user();
        $this->user = $user;
    }

    public function index(Request $req)
    {
        try
        {
            $input = $req->all();

//            $search = !$req->input('search') ? null : $req->input('search');
//            $pageNo = !$req->input('page') ? 1 : $req->input('page');


            $salesAddCust = Penyusutan::where('UNIT_CODE', $this->user->unit_code)
                ->where('YEAR', date('Y'));

            if ($salesAddCust->count() < 1)
            {
                $this->doInitial();
            }


            $param = [
                'search_term' => [
                    'uploadby_id' => @$input['uploadby_id'],
                    'unit_code' => @$input['unit_code'],
                    'tarif_code' => @$input['tarif_code'],
                    'year' => @$input['year']
                ],
                'order_by' => ['created_at' => 'desc'],
                'cur_page' => @$input['page'],
                'total_per_page' => 100
            ];
//            if ($req->input('unit_code'))
//                $param['search_term']['unit_code'] = $req->input('unit_code');

            $resp = Penyusutan::doGet($param);

//            echo '<pre>';
//            print_r($resp['data']);
//            exit;

            $data = [
                'mode' => $req->input('mode'),
                'users' => Users::all(),
                'list' => $resp['data'],
                'units' => Units::all(),
                'tarifs' => Tarifs::all(),
                'paging' => [
                    'pageNo' => (@$resp['meta']['curPage']) ? @$resp['meta']['curPage'] : 1,
                    'totalPage' => @$resp['meta']['totalPage'],
                    'totalPerPage' => 100,
                    'totalRec' => @$resp['meta']['totalRec'],
                ],
                /* set persistent search form value here */
                'search' => $param['search_term'],
            ];


            $this->theme->asset()->cook('penyusutan', function($asset) {
                $asset->container('footer')->usePath()->add('penyusutan_js', 'js/task/penyusutan.js');
            });

            $this->theme->asset()->serve('penyusutan');
            return $this->theme->scope('tasks.penyusutan', $data)->render();
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function doInitial()
    {
        $rsInsert = false;

        try
        {
            $file = public_path('files/penyusutan.xlsx');

            config(['excel.import.startRow' => 5]);
            $reader = Excel::load($file, function($reader) {
                    
                })->get();
            $ins = [];
            $results = $reader->toArray();


            foreach ($results as $val)
            {

                if (is_numeric($val['a']))
                {
                    $ins[] = [
                        'UNIT_CODE' => trim($this->user->unit_code),
                        'YEAR' => date('Y'),
                        'NO' => trim($val['a']),
                        'FUNGSI' => $val['b'],
                        'BIAYA' => $val['c'],
                        'UPLOADBY_ID' => $this->user->id,
                        'UPLOADBY_NAME' => $this->user->name,
                        'CREATED_AT' => date('Y-m-d G:i:s')
                    ];
                }
            }

            $rsInsert = Penyusutan::insert($ins);

            return array(
                "code" => "200",
                "status" => ($rsInsert ? "success" : "fail" )
            );
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function doAdd(Request $req)
    {
        $rsInsert = false;

        try
        {
            if ($req->hasFile('fileToUpload'))
            {
                $file = $req->file('fileToUpload');

                if ($file->getClientSize() > $this->maximum_upload_file)
                {
                    return array(
                        "code" => "200",
                        "status" => "fail",
                        "message" => "File too big. Maximum upload only 10MB"
                    );
                }

                $salesAddCust = Penyusutan::where('UNIT_CODE', $this->user->unit_code)
                    ->where('YEAR', date('Y'));

                if ($salesAddCust->count() > 0)
                {
//                    $salesAddCust->delete();
                    return array(
                        "code" => "200",
                        "status" => "fail",
                        "message" => "Data is exist"
                    );
                }

                config(['excel.import.startRow' => 3]);
                $reader = Excel::load($file, function($reader) {
                        
                    })->get();
                $ins = [];
                $results = $reader->toArray();


                foreach ($results as $val)
                {

                    if (is_numeric($val['a']))
                    {
                        $ins[] = [
                            'UNIT_CODE' => trim($this->user->unit_code),
                            'YEAR' => date('Y'),
                            'NO' => trim($val['a']),
                            'FUNGSI' => $val['b'],
                            'BIAYA' => $val['c'],
                            'UPLOADBY_ID' => $this->user->id,
                            'UPLOADBY_NAME' => $this->user->name,
                            'CREATED_AT' => date('Y-m-d G:i:s')
                        ];
                    }
                }

                $rsInsert = Penyusutan::insert($ins);

                return array(
                    "code" => "200",
                    "status" => ($rsInsert ? "success" : "fail" )
                );
            }
            else
            {
                return array(
                    "code" => "200",
                    "status" => "fail",
                    "message" => "Please select a file"
                );
            }
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function doSave(Request $req)
    {
        DB::beginTransaction();

        try
        {
            $input = $req->all();
            if ($input)
            {
                //dd($input);

                for ($i = 0; $i < count($input['id']); $i++)
                {
                    $salcus = Penyusutan::find($input['id'][$i]);

                    $salcus->BIAYA = floatval($input['biaya'][$i]);

                    $salcus->UPLOADBY_ID = $this->user->id;
                    $salcus->UPLOADBY_NAME = $this->user->name;

                    $salcus->save();
                }
                DB::commit();

                return array(
                    "code" => "200",
                    "status" => "success"
                );
            }
            else
            {
                return array(
                    "code" => "200",
                    "status" => "fail",
                    "message" => "Please select a file"
                );
            }
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/files/penyusutan.xlsx";

//        $headers = array(
//            'Content-Type: application/octet-stream',
//        );

        return Response()->download($file, 'penyusutan.xlsx');
    }

    public function detailById(Request $req)
    {
        try
        {
            $search = !$req->input('search') ? null : $req->input('search');
            $pageNo = !$req->input('page') ? 1 : $req->input('page');

            $param = [
                'order_by' => ['created_at' => 'desc'],
                'cur_page' => $pageNo,
                'total_per_page' => 1000 //env('TOTAL_REC_PAGE', 10000)
            ];
            $resp = Penyusutan::doGet($param);
            echo '<pre>';
            print_r($resp['data']);
            exit;
            $data = [
                'id' => 665,
                'mode' => $req->input('mode') == 'grid' ? 'grid' : 'edit',
                'user' => $this->user,
                'list' => $resp['data'],
                'paging' => [
                    'pageNo' => (@$resp['meta']['curPage']) ? @$resp['meta']['curPage'] : 1,
                    'totalPage' => @$resp['meta']['totalPage'],
                    'totalPerPage' => env('TOTAL_REC_PAGE', 10),
                    'totalRec' => @$resp['meta']['totalRec'],
                ],
                /* set persistent search form value here */
                'persist' => $search,
            ];


            $this->theme->asset()->cook('penyusutan', function($asset) {
                $asset->container('footer')->usePath()->add('penyusutan_js', 'js/task/penyusutan.js');
            });

            $this->theme->asset()->serve('penyusutan');
            return $this->theme->scope('tasks.penyusutan', $data)->render();
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

}
