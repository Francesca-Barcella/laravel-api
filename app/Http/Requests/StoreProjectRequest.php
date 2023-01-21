<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|unique:projects,title|max:100',
            //la mettiamo nullable perchè stiamo integrando e altrimenti romperebbe tutto quello fatto prima - max:250 sono i max mb consentiti
            'cover_image' => 'nullable|image|max:350',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',
            'description' => 'nullable|max:300',
        ];
    }
}
