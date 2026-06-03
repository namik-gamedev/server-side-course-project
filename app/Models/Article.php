<?php
require_once __DIR__ . '/../../core/Model.php';

class Article extends Model
{
    protected $table = 'articles';

    public function __construct($db)
    {
        parent::__construct($db);
    }
}