<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ListItem;

class TodoListController extends Controller
{
    public function index() {
        return view('welcome', ['listItems' => ListItem::where('is_complete', 0)->limit(5)->get()], ['completeList' => ListItem::where('is_complete', 1)->latest()->limit(10)->get()]);  
    }

    public function markComplete($id) {
        // \Log::info($id);
        //fetch from database
        $listItem = ListItem::find($id);
        //display fetched data
        // \Log::info($listItem);

        $listItem->is_complete = 1;
        $listItem->save();

        return redirect('/');  
    }

    public function saveItem(Request $request){
        // \Log::info(json_encode($request->all()));
        $newListItem = new ListItem;
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = 0;
        $newListItem->save();

        return redirect('/');
    }
}
