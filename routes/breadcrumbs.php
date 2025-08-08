<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('index'));
});

// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > News
Breadcrumbs::for('news', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Tin tức', route('page', 'tin-tuc'));
});


// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});

// Home > News > [Category]
Breadcrumbs::for('news-category', function (BreadcrumbTrail $trail, $category) {

    // dd($category);
    $trail->parent('news');
    if ($category->parent()->exists()) {
        $parent = $category->parent()->first();
        $trail->push($parent->name, route('news.category', $parent->slug));
    }
    $trail->push($category->name, route('news.category', $category->slug));
});

// Home > News > [Category] > Detail
// Breadcrumbs::for('news-detail', function (BreadcrumbTrail $trail, $category, $news) {
//     $trail->parent('news');
//     if ($category->parent()->exists()) {
//         $parent = $category->parent()->first();
//         $trail->push($parent->name, route('news.category', $parent->slug));
//     }
//     $trail->push($category->name, route('news.category', $category->slug));
//     $trail->push($news->name);
// });
