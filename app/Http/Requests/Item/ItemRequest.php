<?php

namespace App\Http\Requests\Item;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (Route::current()->uri == 'api/staff') {
            if (Route::current()->methods[0] == 'GET') {
                return [
                ];
            }
            if (Route::current()->methods[0] == 'POST') {
                return [
                    'Code'=> 'required',
                    'Name'=> 'required',
                    'NickName'=> 'required',
                    'SerialNumber'=> 'required',
                    'AccessLevelId'=> 'required',
                    'Phone'=> 'required',
                    'Birthday'=> 'required',
                    'ContactAddress' => 'required',
                    'ResidenceAddress' => 'required',
                    'Note' => 'required',
                    'IsActive'=> 'required',
                    'ArrivedDate' => 'required',
                    'LeavedDate' => 'present'
                ];
            }
            if (Route::current()->methods[0] == 'PUT') {
                return [
                    'Id' => 'required',
                    'Code'=> 'required',
                    'Name'=> 'required',
                    'NickName'=> 'required',
                    'SerialNumber'=> 'required',
                    'AccessLevelId'=> 'required',
                    'Phone'=> 'required',
                    'Birthday'=> 'required',
                    'ContactAddress' => 'required',
                    'ResidenceAddress' => 'required',
                    'Note' => 'required',
                    'IsActive'=> 'required',
                    'ArrivedDate' => 'required',
                    'LeavedDate' => 'required'
                ];
            }
            if (Route::current()->methods[0] == 'DELETE') {
                return [
                    'Id' => 'required'
                ];
            }
        }

        if (Route::current()->uri == 'api/staffAccessLevel') {
            return [
            ];
        }

        //default
        return [

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'status' => "fail",
            'code' => "-1",
            'data' => $errors,
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

    /**
     * get parameters from url
     *
     * @return array
     */
    protected function validationData()
    {   
        return array_merge(
            $this->all(),
            $this->route()->parameters()
        );
    }
}
