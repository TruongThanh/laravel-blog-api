<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:posts,slug',
            'excerpt'     => 'nullable|string|max:500',
            'content'     => 'nullable|string',
            'thumbnail'   => 'nullable|string|max:255',
            'status'      => 'required|in:draft,published',
            'likes'       => 'nullable|integer|min:0',
            'comments'    => 'nullable|integer|min:0',
            'read_time'   => 'nullable|integer|min:0',
            'publish_at'  => 'nullable|date',
            'author_id'   => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
