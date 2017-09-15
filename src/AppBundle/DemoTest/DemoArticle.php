<?php
use AppBundle\Entity\Article;
final class DemoArticle
{
    private $article;

    private function __construct()
    {
        $this->article = new Article();
    }

    public static function fromAmount()
    {
        return new self();
    }
    
    public static function validVAT1($amount)
    {
        $a = new self();
        $a->article->setAmountHT($amount);
        return $a->article->getAmountVAT1();
    }
    
    public static function validVAT2($amount)
    {
        $a = new self();
        $a->article->setAmountHT($amount);
        return $a->article->getAmountVAT2();
    }
}