<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

/**
 * Class StoreUserRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class CreateUserRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'email' => 'unique:users|email|required',
            'role_id' => 'integer|required|exists:roles,id',
            'password' => 'required|string'
        ];
    }

    public function getData()
    {
        return Arr::only($this->all(), [
            'name',
            'email',
            'role_id',
            'password'
        ]);
    }
}
