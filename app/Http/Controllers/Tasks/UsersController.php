<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Tasks\WebBasedController;
//use Auth;
use App\Model\Users;

class UsersController extends WebBasedController
{
    protected $user;

    public function __construct()
    {
        parent::__construct();

//      $user = Auth::user();
//      $this->user = $user;
    }

    public function index(Request $req)
    {
        try
        {
            $search = !$req->input('search') ? null : $req->input('search');
            $pageNo = !$req->input('page') ? 1 : $req->input('page');

            $param = [
//            'search_term' => ['name' => 'asd'],
                'order_by' => ['created_at' => 'desc'],
                'cur_page' => $pageNo,
                'total_per_page' => env('TOTAL_REC_PAGE', 10)
            ];
            $resp = Users::doGet($param);



            $data = [
                'Request' => $req,
                'user' => $this->user,
                'list' => $resp['data'],
                'form' => [
                    'main_action' => route('user_page'),
                ],
                'paging' => [
                    'pageNo' => (@$resp['meta']['curPage']) ? @$resp['meta']['curPage'] : 1,
                    'totalPage' => @$resp['meta']['totalPage'],
                    'totalPerPage' => env('TOTAL_REC_PAGE', 10),
                    'totalRec' => @$resp['meta']['totalRec'],
                ],
                /* set persistent search form value here */
                'persist' => $search,
            ];


            $this->theme->asset()->cook('company_user_list', function($asset) {
                $asset->container('footer')->usePath()->add('comp_user_list_js', 'js/task/user_list.js');
            });

            $this->theme->asset()->serve('company_user_list');
            return $this->theme->scope('tasks.users', $data)->render();
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function doAdd(Request $req)
    {
        try
        {
            $rs = Users::doAdd($req->all());

            return array(
                "code" => "200",
                "status" => ($rs ? "success" : "fail" )
            );
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function doEdit(Request $req)
    {
        try
        {
            $rs = Users::doUpdate($req->input('id'), $req->all());

            return array(
                "code" => "200",
                "status" => ($rs ? "success" : "fail" )
            );
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function doDelete(Request $req)
    {
        try
        {
            $ids = explode(",", rtrim($req->input('ids'), ','));

            $rs = Users::doDelete($ids);

            return array(
                "code" => "200",
                "status" => ($rs ? "success" : "fail" )
            );
        } catch (Exception $ex)
        {
            return json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

}
