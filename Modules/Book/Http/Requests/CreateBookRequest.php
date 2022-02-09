<?php

namespace Modules\Book\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'isbn' => 'required|digits:13|integer|unique:books,isbn',
            'name' => 'required|min:3',
            'year' => 'required|integer|digits:4',
            'page' => 'required|integer',
            'category_id' => 'exists:categories,id',
            'publisher_id' => 'exists:publishers,id',
            'authors' => 'array',
            'authors.*' => 'exists:authors,id'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
