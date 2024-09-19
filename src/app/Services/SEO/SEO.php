<?php

namespace App\Services\SEO;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class SEO implements \App\Contracts\SEO
{
    public $object;
    public $page;

    public $meta;
    public $opengraph;
    public $twitter_card;
    public $json_ld;

    function __construct(
       \App\Models\SEO $object = null,
       $page=null,
        SEOMeta $meta,
        OpenGraph $opengraph,
        TwitterCard $twitter_card,
        JsonLd $json_ld
    )
    {
        $this->object = $object;
        $this->page = $page;
        $this->meta = $meta;
        $this->opengraph = $opengraph;
        $this->twitter_card = $twitter_card;
        $this->json_ld = $json_ld;
    }

    public function buildSets(): void
    {
        if ($this->object) {
            $this->setMeta();
            $this->setOpenGraph();
            $this->setTwitterCard();
            $this->setJsonLd();
        }
    }

    public function buildGenerates(): string
    {
        $result = $this->generateMeta();
        $result .= $this->generateOpenGraph();
        $result .= $this->generateTwitterCard();
        $result .= $this->generateJsonLd();

        return $result;
    }

    public function setMeta(): void
    {

        if ($title=$this->object->title){
            $this->meta::setTitle($title);
            if ($this->page) {
                $this->meta::setTitle($this->page->name .' | ' .$title);
            }
        }

        if ($description=$this->object->description)
            $this->meta::setDescription($description);

        if ($keywords=$this->object->keywords)
            $this->meta::setKeywords($keywords);

        if ($canonical=$this->object->canonical)
            $this->meta::setCanonical($canonical);
    }

    public function setOpenGraph(): void
    {
        if ($title=$this->object->og_title)
            $this->opengraph::setTitle($title);

        if ($description=$this->object->og_description)
            $this->opengraph::setDescription($description);

        if ($url=$this->object->og_url)
            $this->opengraph::setUrl($url);
    }

    public function setTwitterCard(): void
    {
        if ($title=$this->object->twitter_title)
            $this->twitter_card::setTitle($title);

        if ($site=$this->object->twitter_site)
            $this->twitter_card::setSite($site);
    }

    public function setJsonLd(): void
    {
        if ($title=$this->object->jsonld_title)
            $this->json_ld::setTitle($title);

        if ($site=$this->object->jsonld_site)
            $this->json_ld::setDescription($site);

        if ($type=$this->object->jsonld_type)
            $this->json_ld::setType($type);
    }

    public function generateMeta(): string
    {
        return $this->meta::generate();
    }

    public function generateOpenGraph(): string
    {
        return $this->opengraph::generate();
    }

    public function generateTwitterCard(): string
    {
        return $this->twitter_card::generate();
    }

    public function generateJsonLd(): string
    {
        return $this->json_ld::generate();
    }


}
