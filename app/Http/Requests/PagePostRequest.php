<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'site_image' => [
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ],
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }

    public function messages()
    {
        return [
            'site_image.image'  => '画像形式のファイルをアップロードしてください。',
            'site_image.mimes'  => 'jpgかpngの画像形式をアップロードしてください。',
        ];
    }
}
