<?php namespace Vis\Builder\Helpers\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

trait TranslateTrait
{
    public function t($ident)
    {
        $ident = $this->t_fild($ident);

        return $this->$ident;
    }

    public function t_fild($ident)
    {
        $lang = App::getLocale();

        $defaultLocale = Config::get('translations.config.def_locale');

        if ($lang != $defaultLocale) {
            $ident = $ident."_".$lang;
        }

        return $ident;
    }
}
