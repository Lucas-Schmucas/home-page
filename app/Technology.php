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

    public function color(): string
    {
        return match ($this) {
            self::Php => '#777BB4',            // PHP official purple-blue
            self::Laravel => '#FF2D20',        // Laravel red
            self::Mysql => '#00758F',          // MySQL blue
            self::Git => '#F05032',            // Git orange
            self::ElasticSearch => '#005571',  // Elasticsearch dark teal
            self::Datadog => '#632CA6',        // Datadog purple
            self::Tailwind => '#38BDF8',       // Tailwind cyan
            self::Vue => '#41B883',            // Vue green
            self::Livewire => '#FB70A9',       // Livewire pinkish magenta
            self::Coolify => '#8B5CF6',        // Coolify purple-violet
            self::LaravelNova => '#3C4858',    // Nova slate gray
        };
    }
}
