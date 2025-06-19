<?php

namespace App\Http\Middleware;

use Spatie\Csp\AddCspHeaders as BaseMiddleware;
use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;

class AddCspHeaders extends BaseMiddleware
{
    public function configure()
    {
        $this->addPolicy()
            ->addDirective(Directive::SCRIPT_SRC, [Keyword::SELF])
            ->addDirective(Directive::STYLE_SRC, [Keyword::SELF])
            ->addDirective(Directive::IMG_SRC, [Keyword::SELF, 'data:']);
    }
}
