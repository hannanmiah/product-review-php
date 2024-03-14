<?php

test('example', function () {
    // home endpoint test
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertJson(['hello' => 'world']);
});
