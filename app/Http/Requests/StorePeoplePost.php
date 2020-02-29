<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StorePeoplePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *是否授权
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
            'username' => 'required|unique:people|max:12|min:2',
           'username' => [
                    'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
                    Rule::unique('people')->ignore(request()->id,'p_id'),
                ],
            'age' => 'required|integer|between:1,130',
        ];
    }

    public function messages(){
        return [
            'username.unique'=>'名字已存在',
            'username.regex'=>'名字需由中文组成长度为2-12位',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须为数字',
            'age.between'=>'年龄数据不合法',
         ];
    }

}
