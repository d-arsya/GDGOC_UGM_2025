<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\ResetToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('limit', 2);
        $order = $request->get('order', 'asc');
        $orderBy = $request->get('sort', 'id');

        if ($request->has('limit')) {
            $books = Book::orderBy($orderBy, $order)->paginate($perPage);
        } else {
            $books = Book::orderBy($orderBy, $order)->get();
        }

        $response = [
            'data' => $books instanceof \Illuminate\Pagination\LengthAwarePaginator
                ? $books->items()
                : $books,
            'pagination' => $books instanceof \Illuminate\Pagination\LengthAwarePaginator
                ? [
                    'current_page' => $books->currentPage(),
                    'total_pages' => $books->lastPage(),
                    'per_page' => $books->perPage(),
                    'total_items' => $books->total(),
                ]
                : null,
            'links' => $books instanceof \Illuminate\Pagination\LengthAwarePaginator
                ? [
                    'next' => $books->nextPageUrl() ? $books->nextPageUrl() . "&sort=" . $orderBy . "&order=" . $order . "&limit=" . $perPage : null,
                    'prev' => $books->previousPageUrl() ? $books->previousPageUrl() . "&sort=" . $orderBy . "&order=" . $order . "&limit=" . $perPage : null,
                ]
                : null,
        ];

        return response()->json($response, 200);
    }
    public function store(Request $request)
    {
        if ($request->has('bulk')) {
            $books = [];
            foreach ($request->data as $item) {
                $book = Book::create($item);
                $books[] = $book;
            }
            return response()->json(['message' => "All books created successfully", 'data' => $books], 201);
        }
        $book = Book::create($request->all());
        return response()->json(['message' => "Book created successfully", 'data' => $book], 201);
    }
    public function show(Request $request, string $book)
    {
        if ($book == 'bulk') {
            $books = [];
            $status = true;
            foreach ($request->data as $item) {
                $get = Book::find($item);
                if ($get) {
                    $books[] = ["id" => $item, "success" => true, "data" => $get];
                } else {
                    $status = false;
                    $books[] = ["id" => $item, "success" => false, "data" => null];
                }
            }
            if ($status) {
                return response()->json(['message' => "All books received successfully", 'data' => $books], 200);
            }
            return response()->json(['message' => "Some of books not received successfully", 'data' => $books], 200);
        }
        $book = Book::find($book);
        if ($book) {
            return response()->json(['data' => $book], 200);
        }
        return response()->json(['message' => "Book not found"], 404);
    }
    public function update(Request $request, string $book)
    {
        if ($book == "bulk") {
            $updated = [];
            $status = true;
            foreach ($request->data as $item) {
                $update = Book::find($item["id"]);
                if ($update) {
                    $before = $update->toArray();
                    $update->update($item);
                    $updated[] = ["id" => $item["id"], "success" => true, "data" => $update, "original" => $before];
                } else {
                    $status = false;
                    $updated[] = ["id" => $item["id"], "success" => false, "data" => null];
                }
            }
            usort($updated, function ($a, $b) {
                return $a['id'] <=> $b['id'];
            });
            if ($status) {
                return response()->json(['message' => "All books updated successfully", 'data' => $updated], 200);
            }
            return response()->json(['message' => "Some of books not updated successfully", 'data' => $updated], 200);
        }
        $update = Book::find($book);
        if ($update) {
            $original = $update->toArray();
            $update->update($request->all());
            return response()->json(['message' => "Book updated successfully", 'data' => $update, 'original' => $original], 200);
        }
        return response()->json(['message' => "Book not found"], 404);
    }
    public function destroy(Request $request, string $book)
    {
        if ($book == 'bulk') {
            $books = [];
            $status = true;
            foreach ($request->data as $item) {
                $book = Book::find($item);
                if ($book) {
                    $book->delete();
                    $books[] = ["id" => $item, "success" => true];
                } else {
                    $status = false;
                    $books[] = ["id" => $item, "success" => false];
                }
            }
            if ($status) {
                return response()->json(['message' => "All books deleted successfully", 'data' => $books], 200);
            }
            return response()->json(['message' => "Some of books not deleted successfully", 'data' => $books], 200);
        }
        $book = Book::find($book);
        if ($book) {
            $book->delete();
            return response()->json(['message' => "Book deleted successfully"], 200);
        }
        return response()->json(['message' => "Book not deleted successfully"], 404);
    }

    public function generate(Request $request)
    {
        if ($request->has('count')) {
            $generated = Book::factory($request->count)->create();
            return response()->json(['message' => "generate $request->count books successfully", 'data' => $generated], 201);
        }
        return response()->json(['message' => "Your request is require a count parameter"], 404);
    }
    public function reset(Request $request)
    {
        if ($request->isMethod('GET')) {
            $timeToExpire = 20;
            $token = Str::random(60);
            $expiresAt = Carbon::now()->addSeconds($timeToExpire);
            ResetToken::create([
                'token' => $token,
                'expires_at' => $expiresAt,
            ]);

            return response()->json([
                'message' => 'Token generated successfully.',
                'token' => $token,
                'expired_at' => $expiresAt. "($timeToExpire seconds later)",
            ], 200);
        } elseif ($request->isMethod('POST')) {
            $token = $request->token;
            $resetToken = ResetToken::where('token', $token)->first();
            if (!$resetToken) {
                return response()->json([
                    'message' => 'Invalid token.',
                ], 400);
            }
            if ($resetToken->expires_at < Carbon::now()) {
                $resetToken->delete();
                return response()->json([
                    'message' => 'Token has expired.',
                ], 400);
            }

            // Reset database menggunakan Artisan
            try {
                Artisan::call('migrate:fresh --seed');
                // Menghapus token setelah digunakan
                $resetToken->delete();

                return response()->json([
                    'message' => 'Database has been reset successfully.',
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Error resetting database.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
    }
}
