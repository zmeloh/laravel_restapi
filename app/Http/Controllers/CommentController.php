<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * Retrieve all comments for a specific post.
     */
    public function index($postId)
    {
        // Récupérer tous les commentaires liés à un post
        $comments = Comment::where('post_id', $postId)->get();
        return response()->json($comments, 200);
    }

    /**
     * Store a newly created resource in storage.
     * Create a new comment for a specific post.
     */
    public function store(Request $request, $postId)
    {
        // Valider la requête
        $validatedData = $request->validate([
            'body' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        // Créer le commentaire
        $comment = Comment::create([
            'body' => $validatedData['body'],
            'user_id' => $validatedData['user_id'],
            'post_id' => $postId,  // Lier le commentaire au post
        ]);

        return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     * Retrieve a single comment by its ID.
     */
    public function show($postId, $id)
    {
        // Récupérer un commentaire spécifique
        $comment = Comment::where('post_id', $postId)->where('id', $id)->first();

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json($comment, 200);
    }

    /**
     * Update the specified resource in storage.
     * Update a comment.
     */
    public function update(Request $request, $postId, $id)
    {
        // Valider la requête
        $validatedData = $request->validate([
            'body' => 'required|string',
        ]);

        // Trouver le commentaire
        $comment = Comment::where('post_id', $postId)->where('id', $id)->first();

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        // Mettre à jour le commentaire
        $comment->update($validatedData);

        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     * Delete a comment by its ID.
     */
    public function destroy($postId, $id)
    {
        // Trouver le commentaire
        $comment = Comment::where('post_id', $postId)->where('id', $id)->first();

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        // Supprimer le commentaire
        $comment->delete();

        return response()->json(null, 204);
    }
}
