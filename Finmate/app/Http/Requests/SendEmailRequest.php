<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'email:filter,rfc,dns|exists:users,useremail'
        ];
    }

    /**
     * 밸리데이션 메세지
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => ':attribute을 입력해주세요.',
            'email.email' => '올바른 이메일 형식으로 입력해주세요.',
            'email.exists' => '가입되어있는 :attribute을 입력해주세요.'
        ];
    }

    /**
     * attribute명
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => '이메일',
        ];
    }
}
