<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;

class SalesAddCustomer extends Model
{
    protected $table = 'F_SALES_ADD_CUST_INPUT';

//    const CREATED_AT = 'post_date';
//    const UPDATED_AT = 'post_modified';

    public function scopeUserFilter($query, $param)
    {
        if (isset($param['search_term']) && !empty($param['search_term']))
        {
            foreach ($param['search_term'] as $key => $val)
            {
                if ($key == 'name')
                {
                    if ($val != "")
                    {
                        $query->where('name', 'like', '%' . $val . '%');
                    }
                }
                else if ($key == 'date')
                {
                    if (count($val) == 1)
                    {
                        $query->whereDate('created_at', '=', $val['start_date']);
                    }
                    else if (count($val) == 2)
                    {
                        $query->whereDate('created_at', '>=', $val['start_date']);
                        $query->whereDate('created_at', '<=', $val['end_date']);
                    }
                }
                else if ($key == 'status')
                {
                    if ($val != "")
                    {
                        $query->where('status', '=', $val);
                    }
                }
            }
        }

        if (isset($param['order_by']) && !empty($param['order_by']))
        {
            foreach ($param['order_by'] as $key => $val)
            {
                $query->orderBy($key, $val);
            }
        }
        else
        {
            $query->orderBy('created_at', 'desc');
        }

//        $query->whereNull('deleted_at');

        return $query;
    }

    public static function doGet($param)
    {
        $paramBt = self::UserFilter($param);

        $totalRecord = $paramBt->count();

        if ($totalRecord > 0)
        {
            $totalPage = ceil($totalRecord / $param['total_per_page']);

            if ($param['cur_page'] < $totalPage)
            {
                $nextPage = $param['cur_page'] + 1;
            }
            else
            {
                $nextPage = 1;
            }
            if ($param['cur_page'] > 1)
            {
                $start = $param['total_per_page'] * ($param['cur_page'] - 1);
            }
            else
            {
                $start = 0;
            }

            $result = $paramBt->skip($start)->take($param['total_per_page'])->get()->toArray();

            $dataResult['meta'] = array(
                "code" => "200",
                "internalMessage" => "Success",
                "totalRec" => $totalRecord,
                "totalPage" => $totalPage,
                "totalPerPage" => $param['total_per_page'],
                "curPage" => $param['cur_page'],
                "nextPage" => $nextPage
            );
            if (array_key_exists("search_term", $param))
            {
                $paramResult['meta']['search_term'] = $param['search_term'];
            }
            $dataResult['data'] = $result;
        }
        else
        {
            $dataResult['meta'] = array(
                "code" => "200",
                "internalMessage" => "Success"
            );
            if (array_key_exists("search_term", $param))
            {
                $paramResult['meta']['search_term'] = $param['search_term'];
            }
            $dataResult['data'] = array();
        }

        return $dataResult;
    }

    public static function getColumns()
    {
        $self = new self;
        return \DB::connection()->getSchemaBuilder()->getColumnListing($self->getTable());
    }

    public static function doAdd($param)
    {
        $me = new self;

        $me->name = $param['name'];
        $me->email = $param['email'];
        $me->password = bcrypt($param['password']);

        $doit = $me->save();

        if ($doit)
        {
            $id = DB::getPdo()->lastInsertId();

            return [
                'id' => $id
            ];
        }
        else
        {
            return false;
        }
    }

    public static function doUpdate($id, $input)
    {
        $ignores = ["id", "password"];
        $me = self::find($id);

        if ($me)
        {
            foreach (self::getColumns() as $col)
            {
                $column = strtolower($col->column_name);

                if (isset($input[$column]) == true && in_array($column, $ignores) == false)
                {
                    if ($column == "birth_date")
                    {
//                        $me->$column = date('d-M-Y', strtotime($input[$column]));
                        $me->$column = date_format(date_create($input[$column]), 'Y-m-d');
//                        echo date_format(date_create($input[$column]),'d-M-Y');exit;
                    }
                    else
                    {

                        $me->$column = $input[$column];
                    }
                }
            }

            $me->save();

            return $me;
        }
        return false;
    }

    public static function doDelete($ids)
    {
        $me = self::whereIn('id', $ids);

        if ($me->count())
        {
            $me->delete();

            return true;
        }
        else
        {
            return false;
        }
    }

}
