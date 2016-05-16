<?php

$leftMenu = Menu::instance('admin-menu');

$rightMenu = Menu::instance('admin-menu-right');

/**
 * @see https://github.com/pingpong-labs/menus
 * 
 * @example adding additional menu.
 *
 * $leftMenu->url('your-url', 'The Title');
 * 
 * $leftMenu->route('your-route', 'The Title');
 */






Menu::create('admin-menu', function ($menu) {
	$menu->enableOrdering();
	$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
	$menu->route('admin.home', trans('admin.menus.dashboard'), [], 0, ['icon' => 'fa fa-dashboard']);

	/*
	$menu->dropdown(trans('admin.menus.articles.title'), function ($sub) {
		$sub->route('admin.articles.index', trans('admin.menus.articles.all'), [], 1);
		$sub->route('admin.articles.create', trans('admin.menus.articles.create'), [], 2);
		$sub->divider(3);
		$sub->route('admin.categories.index', trans('admin.menus.categories'), [], 4);
	}, 1, ['icon' => 'fa fa-book']);
	*/

	$menu->dropdown(trans('admin.menus.pages.title'), function ($sub) {
		$sub->route('admin.pages.index', trans('admin.menus.pages.all'), [], 1);
		$sub->route('admin.pages.create', trans('admin.menus.pages.create'), [], 2);
	}, 2, ['icon' => 'fa fa-flag']);
	$menu->dropdown(trans('admin.menus.users.title'), function ($sub) {
		$sub->route('admin.users.index', trans('admin.menus.users.all'), [], 1);
		$sub->route('admin.users.create', trans('admin.menus.users.create'), [], 2);
		$sub->divider(3);
		$sub->route('admin.roles.index', trans('admin.menus.roles'), [], 4);
		$sub->route('admin.permissions.index', trans('admin.menus.permissions'), [], 5);
	}, 3, ['icon' => 'fa fa-users']);
});

$leftMenu = Menu::instance('admin-menu');

$rightMenu = Menu::instance('admin-menu-right');


$leftMenu->dropdown('Categories', function ($sub) {
	$sub->route('admin.categories.index', 'All Categories', [], 1);
	$sub->route('admin.categories.create', 'Add New', [], 2);
}, 5, ['icon' => 'fa fa-bars']);

$leftMenu->route('admin.projects.index', 'Projects', [], 7, ['icon' => 'fa fa-rocket']);

$leftMenu->dropdown('Email templates', function ($sub) {
	$sub->route('admin.letters.index', 'All templates', [], 1);
	$sub->route('admin.letters.create', 'Add New', [], 2);
}, 9, ['icon' => 'fa fa-envelope']);