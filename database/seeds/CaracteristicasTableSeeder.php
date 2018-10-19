<?php

use Illuminate\Database\Seeder;
use App\Caracteristica;
class CaracteristicasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomes = ['Marca', 'Cor', 'Tamanho', 'Largura', 'Peso'];

        foreach($nomes as $nome) {
            $objeto = new Caracteristica;
            $objeto->nome = $nome;
            $objeto->created_at = now();
            $objeto->updated_at = now();        
            $objeto->save();
        }
    }
}
