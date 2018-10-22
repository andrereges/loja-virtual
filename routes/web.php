<?php
Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/produto/{id}', 'HomeController@produto')->name('produto');

Route::get('/carrinho/adicionar', function() {
    return redirect()->route('index');
});
Route::get('/carrinho/remover', function() {
    return redirect()->route('index');
});

Route::get('/carrinho', 'CarrinhoController@index')->name('carrinho.index');
Route::post('/carrinho/adicionar', 'CarrinhoController@adicionar')->name('carrinho.adicionar');
Route::delete('/carrinho/remover', 'CarrinhoController@remover')->name('carrinho.remover');
Route::post('/carrinho/concluir', 'CarrinhoController@concluir')->name('carrinho.concluir');
Route::get('/carrinho/pedidos', 'CarrinhoController@pedidos')->name('carrinho.pedidos');
