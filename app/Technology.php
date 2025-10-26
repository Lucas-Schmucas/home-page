<?php

namespace App;

enum Technology: string
{
    case Php = 'PHP';
    case Laravel = 'Laravel';
    case Mysql = 'MySQL';
    case Git = 'Git';
    case ElasticSearch = 'Elasticsearch';
    case Datadog = 'Datadog';
    case Tailwind = 'Tailwind CSS';
    case Vue = 'Vue.js';
    case Livewire = 'Livewire';
    case Coolify = 'Coolify';
    case LaravelNova = 'Laravel Nova';
}
