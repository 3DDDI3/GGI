<?php

use App\Models\Pages\Pages;

Breadcrumbs::for('page', function ($trail, $page) {
  function makeChain(&$chain, $page ) {
    $parentPage = Pages::where('id', '=', $page->parent_id)->first();
    if ($parentPage) {
      $chain[] = $parentPage;
      if ($parentPage->parent_id) {
        $chain = makeChain($chain, $parentPage);
      }
    }
    return $chain;
  }
  $chain = [$page];
  $chain = array_reverse(makeChain($chain, $page));

  foreach ($chain as $page) {
    $trail->push($page->name, '/' . $page->url);
  }
});

Breadcrumbs::for('news', function ($trail, $news, $page) {
  try {
    $trail->parent('page' , $page);
    $trail->push($news->name, route('news.single', ['link' => $news->link]));
  } catch (\Throwable $th) {
    \Illuminate\Support\Facades\Log::info('error routes/breadcrumbs.php');
  }

});

Breadcrumbs::for('services', function ($trail, $service, $page) {
    $trail->parent('page' , $page);
    $trail->push($service->name, route('services.single', ['link' => $service->link]));
});

Breadcrumbs::for('courses', function ($trail, $course, $page) {
    $trail->parent('page' , $page);
    $trail->push($course->name, route('courses.single', ['link' => $course->link]));
});

Breadcrumbs::for('publications2', function ($trail, $publication, $page) {
    $trail->parent('page' , $page);
    $trail->push($publication->name, route('publications2.single', ['publication' => $publication->link]));
});

Breadcrumbs::for('structure', function ($trail, $department, $page) {
    $trail->parent('page' , $page);
    $trail->push($department->name, route('publications2.single', ['publication' => $department->link]));
});