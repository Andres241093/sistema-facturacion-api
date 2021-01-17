<?php

namespace App\Traits;

trait CheckElement
{
	public static function checkIfExist($element,$fail_mssg)
	{
		if($element === NULL)
		{
			return response()->json(['message' => $fail_mssg],404);
		}
	    return response()->json($element);
	}

	public static function checkIfExistOrUpdate($element,$fail_mssg,$success_mssg)
	{
		if($element === 0)
		{
			return response()->json(['message' => $fail_mssg],404);
		}
		return response()->json(['message' => $success_mssg],201);
	}

	public static function checkIfExistOrDelete($element,$fail_mssg,$success_mssg)
	{
		if($element === NULL)
		{
			return response()->json(['message' => $fail_mssg],404);
		}
		$element->delete();
		return response()->json(['message' => $success_mssg],201);
	}
}