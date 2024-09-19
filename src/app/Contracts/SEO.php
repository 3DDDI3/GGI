<?php

namespace App\Contracts;

interface SEO
{
    public function buildSets():void;
    public function buildGenerates():string;

    public function setMeta():void;
    public function setOpenGraph():void;
    public function setTwitterCard():void;
    public function setJsonLd():void;

    public function generateMeta():string;
    public function generateOpenGraph():string;
    public function generateTwitterCard():string;
    public function generateJsonLd():string;
}
