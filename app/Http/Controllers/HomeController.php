<?php

namespace App\Http\Controllers;

use App\Attitude;
use App\Author;
use App\Book;
use App\Character;
use App\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function books(){
        $books = Book::with('author')->withCount('comment')->oldest()->get();
        return response()->json($books, 200);
    }

    public function storebooks(Request $request)
    {
        $books = get_curl("https://anapioficeandfire.com/api/books/");
        foreach ($books as $key => $b) {

            $book = new Book();
            $book->name = $b['name'];
            $book->url = $b['url'];
            $book->isbn = $b['isbn'];
            $book->numberOfPages = $b['numberOfPages'];
            $book->publisher = $b['publisher'];
            $book->country = $b['country'];
            $book->mediaType = $b['mediaType'];
            $book->released = $b['released'];

            $book->save();

            for ($i=0; $i < count($b['authors']); $i++) {
                Author::create([
                    'book_id' => $book->id,
                    'author' => $b['authors'][$i]
                ]);
            }

            for ($i=0; $i < count($b['characters']) ; $i++) {
                Character::create([
                    'book_id' => $book->id,
                    'character' => $b['characters'][$i]
                ]);
            }
        }
        return response()->json(['success' => true, 'msg' => 'Data saved'], 201);
    }

    public function add_comment(Request $request)
    {
        try {

        $this->validate($request, [
            'book_id' => 'required',
            'comment' => 'required|max:500|string'
        ]);
            $comment = new Comment();
            $comment->book_id = $request->book_id;
            $comment->comment = $request->comment;
            $comment->ipAddress = $request->ip();

            $comment->save();
            return response()->json(['success' => true, 'msg' => 'comment added'], 201);
       } catch (\Throwable $th) {
           return response()->json(['success' => false, 'msg' => $th->getMessage()], 500);
       }
    }

    public function book_comment($book_id = null){
        if ($book_id != null) {
            $comment = Comment::where('book_id', $book_id)->get();
            if (count($comment) > 0) {
                return response()->json(['success' => true, 'data' => $comment], 200);
            }else{
                return response()->json(['success' => false, 'msg' => 'No data'], 400);
            }
        }else{
            return response()->json(['success' => false, 'msg' => 'Internal server error'], 405);
        }
    }

    public function book_character($book_id = null)
    {
        if ($book_id != null) {
            $character = Character::where('book_id', $book_id)->get();
            if (count($character) > 0) {
                return response()->json(['success' => true, 'data' => $character], 200);
            } else {
                return response()->json(['success' => false, 'msg' => 'No data'], 400);
            }
        }else{
            return response()->json(['success' => false, 'msg' => 'Internal server error'], 405);
        }
    }

    public function storecharacter(Request $request)
    {
        $characters = get_curl("https://anapioficeandfire.com/api/characters/");
        foreach ($characters as $key => $b) {

            $character = new Attitude();
            $character->name = $b['name'];
            $character->url = $b['url'];
            $character->gender = $b['gender'];
            $character->culture = $b['culture'];
            $character->born = $b['born'];
            $character->died = $b['died'];
            $character->father = $b['father'];
            $character->mother = $b['mother'];
            $character->spouse = $b['spouse'];

            $character->save();
        }
        return response()->json(['success' => true, 'msg' => 'Data saved'], 201);
    }

    public function character($param = null)
    {
        if ($param != null) {
            $character = Attitude::where('gender', $param)->orWhere('name', $param)->oldest()->get();
            if (count($character) > 0) {
                return response()->json(['success' => true, 'data' => $character, 'total' => $character->count()], 200);
            } else {
                return response()->json(['success' => false, 'msg' => 'No data'], 400);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Internal server error'], 405);
        }
    }

    public function comment()
    {
        $comment = Comment::latest()->get();
        if (count($comment) > 0) {
            return response()->json(['success' => true, 'data' => $comment], 200);
        } else {
            return response()->json(['success' => false, 'msg' => 'No data'], 400);
        }
    }
}
