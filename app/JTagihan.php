<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JTagihan extends Model
{
    use \Sushi\Sushi;

    protected $rows = [
        ['id' => 0, 'alias' => 'pengembangan', 'name' => 'Dana Pengembangan'],
        ['id' => 1, 'alias' => 'pendidikan', 'name' => 'Dana Pendidikan'],
        ['id' => 2, 'alias' => 'komite', 'name' => 'Iuran Komite Sekolah / tahun'],
        ['id' => 3, 'alias' => 'seragam', 'name' => 'Seragam']
    ];
}
