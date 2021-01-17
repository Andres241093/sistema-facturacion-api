<?php

namespace App\Traits;

use Illuminate\Pagination\Paginator;

trait PaginationResponse
{
	public static function paginate($query)
	{
		$per_page = request()->query('per_page');
		if($per_page === NULL)
		{
			$per_page = 10;//default value
		}
	    return $query->paginate($per_page);
	}
	public static function response($model_query,$params = [])
	{
		$filters = collect(request()->query())->only($params);
		if(count($filters)>0)
		{
			foreach ($filters as $key => $value) {
				$query = $model_query->where($key,'LIKE',$value.'%');
			}
		}else{
			$query = $model_query;
		}
		$response_data = self::paginate($query);
		return [
			"page" => $response_data->currentPage(),
			"per_page" => $response_data->perPage(),
			"total" => $response_data->total(),
			"data" => $response_data->getCollection()
		];
	}
}