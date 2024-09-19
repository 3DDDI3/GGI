<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEO extends Model
{
    use HasFactory;

    protected $table = 'seo';

    public $fillable = [
        'url' ,
        'title',
        'description',
        'canonical',
        'keywords',
        'og_title',
        'og_description',
        'og_url',
        'twitter_title',
        'twitter_site',
        'jsonld_title',
        'jsonld_description',
        'jsonld_type',
    ];


}
