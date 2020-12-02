<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowComments extends Controller
{
    /**
     * @param Request $request
     * @param integer $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, $user_id)
    {

        $dbQuery = DB::table('comments')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->join('images', 'posts.image_id', '=', 'images.id')
            ->where('commentator_id', $user_id)
            ->where('images.url', '!=', null)
            ->get()
            ->sortByDesc('created_at');

        //dd($dbQuery);

        $comments = Comment::where('commentator_id', $user_id)->with(['post' => function ($post) {
            $post->with(['image' => function ($image) {
                $image->where('url', '!=', null);
            }]);
        }])->get();

        $mappedComments = $comments->map(function ($item) {
            return [
                'id' => $item->id,
                'content' => $item->content,
                'post' => [
                    'content' => $item->post->content,
                    'image' => $item->post->image,
                    'author' => $item->post->user->active ? $item->post->user->name : null
                ]
            ];
        })->sortByDesc('created_at');
        //->toJson()

        return response()->json(['data' => $mappedComments]);
    }
}
