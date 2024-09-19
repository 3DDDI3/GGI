<?php

namespace App\Helpers\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchCheckboxes
{
    public $items;
    public $data;
    public $class;
    public $title;
    public $title2;
    public $search;
    public $textboxes;

    public function __construct(Collection $items = null, Request $request)
    {
        $this->items = $items;

        $this->data = $request->data;
        $this->class = $request->class;
        $this->search = isset($request->search) ? $request->search : false;
    }

    public function view($textboxes = false)
    {
        $this->textboxes = $textboxes;

        if ($this->items) {

            if ($this->search !== false) {
                $this->search();
                $this->setCheckedItems();

                return view('admin.includes.search_checkboxes_items', ['objects'=>$this->items, 'textboxes' => $textboxes]);
            }
            else{
                $this->setCheckedItems();

                return view('admin.dialogs.search_checkboxes', [
                    'title' => $this->title,
                    'title2' => $this->title2,
                    'class' => $this->class,
                    'objects' => $this->items,
                    'textboxes' => $textboxes
                ]);
            }

        }
    }

    public function setTitles($title, $title2)
    {
        $this->title = $title;
        $this->title2 = $title2;

        return $this;
    }

   private function setCheckedItems()
    {
        $data = $this->textboxes ? json_decode($this->data, true) : explode('|', $this->data);

        if (!empty($data) && !empty($this->items)) {
            foreach ($this->items as $value) {
                if ($this->textboxes){
                    foreach ($data as $value2){
                        if ($value->id == $value2['id']){
                            $value->checked = $value2['checked'];
                            $value->text = $value2['text'];
                        }
                    }
                }
                else{
                    if (in_array($value->id, $data))
                        $value->checked = 1;
                }
            }
        }
    }

    private function search()
    {
       $this->items = $this->items->filter(fn($item) => stripos($item->name, $this->search) !== false);
    }

    public static function init($items, $request, $title1=null, $title2=null, $textboxes=false)
    {
        $search_checkboxes = new self($items, $request);

        if ($title1 && $title2)
            $search_checkboxes->setTitles($title1 , $title2);

        return $search_checkboxes->view($textboxes);
    }


}
