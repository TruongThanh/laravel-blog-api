<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        $postId = $this->route('post')->id ?? null; // lấy id từ route model binding
        return [
            'title'       => 'sometimes|required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:posts,slug,' . $postId,
            'excerpt'     => 'nullable|string',
            'content'     => 'nullable|string',
            'thumbnail'   => 'nullable|string|max:255',
            'status'      => 'nullable|in:draft,published,archived',
            'likes'       => 'nullable|integer|min:0',
            'comments'    => 'nullable|integer|min:0',
            'read_time'   => 'nullable|integer|min:0',
            'publish_at'  => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'integer|exists:tags,id',
        ];
    }
}
