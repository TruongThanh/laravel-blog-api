<?php

namespace App\Services\Api;

use App\Models\Api\Post;
use Illuminate\Http\Request;

class PostService
{
    /**
     * @param Request $request
     * Get Post List filter, search, sort, paginate
     */
    public function getPosts(Request $request)
    {
        $query = Post::with(['author', 'category', 'tags']);

        $search     = $request->input('search');
        $status     = $request->input('status'); // draft|published|archived
        $categoryId = $request->input('category_id');
        $tagId      = $request->input('tag_id');
        $tagSlug    = $request->input('tag_slug');
        $sort       = $request->input('sort', 'desc');
        $perPage    = min((int) $request->input('per_page', 10), 100);

        /**
         * Search
         */
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhereHas('author', function ($authorQuery) use ($search) {
                        $authorQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        /**
         * Filter: status
         */
        if ($status) {
            $query->where('status', $status);
        }

        /**
         * Filter: category_id
         */
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        /**
         * Filter: tag_id
         */
        if ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tags.id', $tagId);
            });
        }

        /**
         * Filter: tag_slug
         */
        if ($tagSlug) {
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('tags.slug', $tagSlug);
            });
        }

        /**
         * Sorting
         * - sort = acs -> created_at ASC
         * - sort = desc -> created_at DESC (default)
         */
        $query->orderBy('created_at', $sort);

        return $query->paginate($perPage);
    }

    /**
     * @param string $id
     * Get a single post by id
     */
    public function getPostById(string $id)
    {
        return Post::with(['author', 'category', 'tags'])
            ->findOrFail($id);
    }

    /**
     * @param array $data
     * Get Post List filter, search, sort, paginate
     */
    public function createPost(array $data): Post
    {
        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $post = Post::create($data);
        if (!empty($tags)) {
            $post->tags()->sync($tags);
        }

        return $post->load(['author', 'category', 'tags']);
    }

    /**
     * @param string $id
     * @param array $data
     * Update a post by id
     */
    public function updatePost(string $id, array $data)
    {
        $post = Post::findOrFail($id);
        $post->update($data);

        // reload with relationships
        return $post->load(['author', 'category', 'tags']);
    }

    /**
     * @param string $id
     * Delete a post by id
     */
    public function deletePost(string $id): bool
    {
        $post = Post::findOrFail($id);
        return (bool) $post->delete();
    }
}
