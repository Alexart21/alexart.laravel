<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Call;
use App\Models\Post;

// Зделал только для админки
// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('admin.index'));
});

// Posts
Breadcrumbs::for('posts', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Входящие сообщения', route('post.index'));
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

// Home > calls > [call]
Breadcrumbs::for('call', function (BreadcrumbTrail $trail, Call $call) {
    $trail->parent('calls');
    $trail->push('Заказ от ' . $call->name, route('call.show', $call));
});
