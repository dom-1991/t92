<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    public $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {

        $this->categoryRepository->create([
            'title' => 'cate title test 1',
            'description' => 'description default value'
        ]);

        $categories = $this->categoryRepository->getCategoryHost();

        return view('home.posts', compact('categories'));
    }
}
