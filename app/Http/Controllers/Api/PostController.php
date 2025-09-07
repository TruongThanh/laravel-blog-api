<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreatePostRequest;
use App\Http\Requests\Api\StorePostRequest;
use App\Http\Requests\Api\UpdatePostRequest;
use App\Http\Resources\Api\PostResource;
use App\Models\Api\Post;
use App\Services\Api\PostService;
use Exception;
use Illuminate\Http\Request;

class PostController extends BaseApiController
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = $this->postService->getPosts($request);
    
        return $this->paginatedResponse(
            PostResource::collection($posts),
            'Posts retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
            $post = $this->postService->createPost([
                ...$request->validated(),
                'author_id' => $request->user()->id(),
            ]);

            return $this->successResponse(new PostResource($post), 'Post created successfully', 201);
        } catch (Exception $e) {

            return $this->errorResponse('Failed to create post', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->getPostById($id);

        return $this->successResponse(
            new PostResource($post),
            'Post retrieved successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = $this->postService->updatePost($id, $request->validated());

        return $this->successResponse(
            new PostResource($post),
            'Post updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->postService->deletePost($id);

        return $this->successResponse(
            null,
            'Post deleted successfully'
        );
    }
}
