<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Pagrindinis', route('home'));
});

// Home > Groups
Breadcrumbs::for('signups', function ($trail) {
    $trail->parent('home');
    $trail->push('Registracijos', route('viewSignups'));
});

// Home > Members
Breadcrumbs::for('members', function ($trail) {
    $trail->parent('home');
    $trail->push('Nariai', route('members.index'));
});

// Home > current member
Breadcrumbs::for('member', function ($trail, $id) {
    $trail->parent('home');
    $trail->push('Nariai', route('members.index'));
    $trail->push($id, route('members.edit', $id));
});

// Home > Groups
Breadcrumbs::for('groups', function ($trail) {
    $trail->parent('home');
    $trail->push('Grupes', route('groups.index'));
});

// Home > search
Breadcrumbs::for('search', function ($trail) {
    $trail->parent('home');
    $trail->push('paieska', route('search.form'));
});
