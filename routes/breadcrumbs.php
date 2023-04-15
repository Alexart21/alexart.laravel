<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Call;
use App\Models\Post;
use App\Models\Content;

// Зделал только для админки
// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('admin.index'));
});

// Contents
Breadcrumbs::for('contents', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Основные страницы', route('content.index'));
});

Breadcrumbs::for('contents_trashed', function (BreadcrumbTrail $trail) {
    $trail->parent('contents');
    $trail->push('Корзина', route('content.trash'));
});

Breadcrumbs::for('content_show', function (BreadcrumbTrail $trail, Content $content) {
    $trail->parent('contents');
    $trail->push('Страница "' . $content->page . '"', route('content.show', $content));
});

Breadcrumbs::for('content_edit', function (BreadcrumbTrail $trail, Content $content) {
    $trail->parent('contents');
    $trail->push('Страница "' . $content->page . '" редактирование', route('content.edit', $content));
});

Breadcrumbs::for('contenteditable', function (BreadcrumbTrail $trail, Content $content) {
    $trail->parent('contents');
    $trail->push('Страница "' . $content->page . '" редактирование в режиме contenteditable', route('contenteditable', $content));
});

Breadcrumbs::for('content_create', function (BreadcrumbTrail $trail) {
    $trail->parent('contents');
    $trail->push('Создание', route('content.create'));
});

// Posts
Breadcrumbs::for('posts', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Входящие сообщения', route('post.index'));
});

Breadcrumbs::for('posts_trashed', function (BreadcrumbTrail $trail) {
    $trail->parent('posts');
    $trail->push('Корзина', route('post.trash'));
});

// Home > posts > [post]
Breadcrumbs::for('post', function (BreadcrumbTrail $trail, Post $post) {
    $trail->parent('posts');
    $trail->push('Сообщение от ' . $post->name, route('post.show', $post));
});

// Calls
Breadcrumbs::for('calls', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Заказы обратных звонков', route('call.index'));
});

Breadcrumbs::for('calls_trashed', function (BreadcrumbTrail $trail) {
    $trail->parent('calls');
    $trail->push('Корзина', route('call.trash'));
});

// Home > calls > [call]
Breadcrumbs::for('call', function (BreadcrumbTrail $trail, Call $call) {
    $trail->parent('calls');
    $trail->push('Заказ от ' . $call->name, route('call.show', $call));
});
