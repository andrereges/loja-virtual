<?php

use Illuminate\Database\Seeder;
use App\Produto;
use App\Categoria;
use App\Imagem;
use App\Caracteristica;
use App\ProdutoCategoria;
use App\ProdutoCaracteristica;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produtos = [
            0 => [
                'nome' => 'Açucareiro',
                'descricao' => 'Açucareiro com design moderno.',
                'preco' => 9.99,
                'categorias' => [
                    ['id' => 3],
                ],
                'imagens' => [
                    ['id' => 1],
                ],
                'caracteristicas' => [
                    ['id' => 1, 'valor' => 'Açúcar Brasil'],
                    ['id' => 2, 'valor' => 'Prateado'],
                    ['id' => 5, 'valor' => '200 gramas'],
                ],
            ],
            1 => [
                'nome' => 'Cabide',
                'descricao' => 'Cabide de plástico resistente.',
                'preco' => 1.99,
                'categorias' => [
                    ['id' => 3],
                ],
                'imagens' => [
                    ['id' => 2],
                ],
                'caracteristicas' => [
                    ['id' => 1, 'valor' => 'Conde Plus'],
                    ['id' => 2, 'valor' => 'Preto'],
                    ['id' => 5, 'valor' => '150 gramas'],
                ],
            ],
            2 => [
                'nome' => 'Cadeira Branca',
                'descricao' => 'Cadeira de Luxo.',
                'preco' => 1599.99,
                'categorias' => [
                    ['id' => 2],
                ],
                'imagens' => [
                    ['id' => 3],
                ],
                'caracteristicas' => [
                    ['id' => 1, 'valor' => 'Presidente'],
                    ['id' => 2, 'valor' => 'Branca'],
                    ['id' => 5, 'valor' => '5 Kilos'],
                ],
            ],
            3 => [
                'nome' => 'Discman',
                'descricao' => 'Discman top de linha.',
                'preco' => 1599.99,
                'categorias' => [
                    ['id' => 1],
                ],
                'imagens' => [
                    ['id' => 4],
                ],
                'caracteristicas' => [
                    ['id' => 1, 'valor' => 'Sony'],
                    ['id' => 2, 'valor' => 'Prata'],
                    ['id' => 5, 'valor' => '700 gramas'],
                ],
            ],
            4 => [
                'nome' => 'Mesa de Jantar',
                'descricao' => 'Mesa especial para sua cozinha.',
                'preco' => 459.99,
                'categorias' => [
                    ['id' => 2],
                ],
                'imagens' => [
                    ['id' => 5],
                ],
                'caracteristicas' => [
                    ['id' => 1, 'valor' => 'Itatiaya'],
                    ['id' => 2, 'valor' => 'Marrom'],
                    ['id' => 5, 'valor' => '6 Kilos'],
                ],
            ],
            5 => [
                'nome' => 'Televisão Antiga',
                'descricao' => 'Televisão raridade para colecionadores.',
                'preco' => 4678.99,
                'categorias' => [
                    ['id' => 1],
                ],
                'imagens' => [
                    ['id' => 6],
                ],
                'caracteristicas' => [
                    ['id' => 1, 'valor' => 'Sony'],
                    ['id' => 2, 'valor' => 'Marrom claro'],
                    ['id' => 5, 'valor' => '15 Kilos'],
                ],
            ],
            6 => [
                'nome' => 'Videocassete',
                'descricao' => 'Videocassete raridade para colecionadores.',
                'preco' => 2699.99,
                'categorias' => [
                    ['id' => 1],
                ],
                'imagens' => [
                    ['id' => 7],
                ],
                'caracteristicas' => [
                    ['id' => 1, 'valor' => 'JVC'],
                    ['id' => 2, 'valor' => 'Preto'],
                    ['id' => 5, 'valor' => '2 Kilos'],
                ],
            ],
        ];

        foreach($produtos as $produto) {
            $produto_obj = new Produto;
            $produto_obj->nome = $produto['nome'];
            $produto_obj->descricao = $produto['descricao'];
            $produto_obj->preco = $produto['preco'];
            $produto_obj->created_at = now();
            $produto_obj->updated_at = now();    

            $produto_obj->save();
        
            foreach($produto['categorias'] as $categoria) {                
                $categoria_obj = Categoria::find($categoria['id']);

                $produto_categoria = new ProdutoCategoria;
                $produto_categoria->produto_id = $produto_obj->id;
                $produto_categoria->categoria_id = $categoria_obj->id;

                $produto_categoria->save(); 
            }

            foreach($produto['caracteristicas'] as $caracteristica) {
                $caracteristica_obj = Caracteristica::find($caracteristica['id']);
                
                $produto_caracteristica = new ProdutoCaracteristica;
                $produto_caracteristica->produto_id = $produto_obj->id;
                $produto_caracteristica->caracteristica_id = $caracteristica_obj->id;
                $produto_caracteristica->valor = $caracteristica['valor'];

                $produto_caracteristica->save();  
            }

            foreach($produto['imagens'] as $imagem) {
                $imagem_obj = Imagem::find($imagem['id']);

                $produto_obj->imagens()->saveMany([$imagem_obj]);  
            }            
        }
    }
}
