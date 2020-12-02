<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ActiveUsers extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {

        $userData = User::where('active', 1)->with(['posts' => function ($post) {
            $post->where('deleted_at', null);
        }])->get();

        $mappedUserData = $userData->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'posts'  => $item->posts->map(function ($inner) {
                    return [
                        'id'   => $inner->id,
                        'content'   => $inner->content,
                        'created_at_ts'   => $inner->created_at,
                        'image_url'   => $inner->image->url,
                        'count_of_comments' => $inner->comments->count()
                    ];
                })->sortByDesc('count_of_comments')
            ];
        });

          return response()->json(['data'=>$mappedUserData]);
    }
}
