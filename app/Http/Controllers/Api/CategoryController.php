<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Category;

class CategoryController extends Controller
{
    // Parent
    public function createParent(Request $request) {
        $result = Category::createParent($request);

        return $result;
    }

    public function updateParent($id, Request $request) {
        $result = Category::updateParent($id, $request);

        return $result;
    }

    public function deleteParent($parent_id) {
        $result = Category::deleteParent($parent_id);

        return $result;
    }

    // Child
    public function createChild($parent_id, Request $request) {
        $result = Category::createChild($parent_id, $request);

        return $result;
    }

    public function updateChild($id, Request $request) {
        $result = Category::updateChild($id, $request);

        return $result;
    }

    public function deleteChild($id) {
        $result = Category::deleteChild($id);

        return $result;
    }


    // Get The Tree
    public function get() {
        $result = Category::get();

        return $result;
    }
}
