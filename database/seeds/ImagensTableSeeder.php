<?php

use Illuminate\Database\Seeder;
use App\Imagem;

class ImagensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [
            0 => [
                'caminho' => 'produto_imagens/acucareiro.jpg',
                'descricao' => 'Imagem açucareiro'
            ], 
            1 => [
                'caminho' => 'produto_imagens/cabide.jpeg',
                'descricao' => 'Imagem cabide'
            ],
            2 => [
                'caminho' => 'produto_imagens/cadeira_branca.jpg',
                'descricao' => 'Imagem cadeira branca'
            ],
            3 => [
                'caminho' => 'produto_imagens/discman_sony.jpeg',
                'descricao' => 'Imagem discman marca Sony'
            ],
            4 => [
                'caminho' => 'produto_imagens/mesa_jantar_marrom.jpeg',
                'descricao' => 'Imagem mesa de jantar marrom'
            ],
            5 => [
                'caminho' => 'produto_imagens/tv_antiga.jpg',
                'descricao' => 'Imagem televisão antiga'
            ],
            6 => [
                'caminho' => 'produto_imagens/videocassete_jvc.jpg',
                'descricao' => 'Imagem videocassete JVC'
            ]
        ];

        foreach($itens as $item) {
            $objeto = new Imagem;
            $objeto->caminho = $item['caminho'];
            $objeto->descricao = $item['descricao'];
            $objeto->created_at = now();
            $objeto->updated_at = now();        
            $objeto->save();
        }
    }
}
