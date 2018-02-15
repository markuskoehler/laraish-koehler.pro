<?php

/*
|---------------------------------------------------------------------------
| Specific Page Routes
|---------------------------------------------------------------------------
|
| Create routes for specific pages.
|
| page:               page.<sub-page-slug>.[...]
| category:           category.<sub-category-slug>.[...]
| tag:                tag.<tag-slug>
| single:             single.<slug>
| singular:           singular.<post_type>
| post_type_archive:  post_type_archive.<post_type>
| taxonomy:           taxonomy.<term>.[...]
| author:             author.<nickname>
*/

//Route::any('page.about', 'Page\About@index');


/*
|---------------------------------------------------------------------------
| Generic Page Routes
|---------------------------------------------------------------------------
|
| Create routes for generic pages.
| Note that generic page routes must be placed after specific ones.
|
| front_page
| home
| archive
| attachment
| date
| comments_popup
| paged
| page
| category
| tag
| single
| singular
| post_type_archive
| taxonomy
| author
| search
| 404
*/

// home page
Route::any('front_page', 'Generic\Home@index');
// blog page
Route::any('home', 'Generic\Blog@index');
// blog post
Route::any('single', 'Generic\Single@index');
// page
Route::any('page', 'Generic\Page@index');
// 404 page
Route::any('404', 'Generic\NotFound@index');