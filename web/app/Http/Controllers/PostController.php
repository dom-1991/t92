<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;

class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface|\App\Repositories\Repository
     */
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function chart(){
        return view('chart');
    }

    public function welcome(){
        return view('welcome');
    }


    public function home(){
        $data = $this->postRepository->home();
        return view('app', compact('data'));
    }

    /**
     * Show all post
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {

        $this->postRepository->create([
            'title' => 'title test 2',
            'content' => 'content test 2'
        ]);

        // $posts = $this->postRepository->getAll();
        $posts = $this->postRepository->getPostHost();

        return view('home.posts', compact('posts'));
    }

    /**
     * Show single post
     *
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        return view('home.post', compact('post'));
    }

    /**
     * Create single post
     *
     * @param $request \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //... Validation here

        $post = $this->postRepository->create($data);

        return view('home.post', compact('post'));
    }

    /**
     * Update single post
     *
     * @param $request \Illuminate\Http\Request
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        //... Validation here

        $post = $this->postRepository->update($id, $data);

        return view('home.post', compact('post'));
    }

    /**
     * Delete single post
     *
     * @param $id int Post ID
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postRepository->delete($id);
        return view('home.post');
    }
}
