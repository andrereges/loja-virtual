<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomes = ['Eletroeletrônicos', 'Móveis', 'Utilidades Domésticas'];

        foreach($nomes as $nome) {
            $objeto = new Categoria;
            $objeto->nome = $nome;
            $objeto->created_at = now();
            $objeto->updated_at = now();        
            $objeto->save();
        }
    }
}
