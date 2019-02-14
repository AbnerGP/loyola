<?php

namespace App\Objects;

namespace App\Objects;

use App\Models\Page;

class CMSRepository {



    public function getPageLinks() {
        return Page::select('titulo', 'slug', 'status')->where('status', 1)->get();
    }

    public function getPage($identifier) {
        if(is_string($identifier)) {
            $page = Page::where('slug', $identifier);
        } else {
            $page = Page::find($identifier);
        }

        $page = $page->where('status', 1);

        if($page->count() == 0 ){
            abort(404);
        }

        return $page->first();
    }
    

}